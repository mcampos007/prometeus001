<?php

namespace App\Http\Controllers;
use App\Models\Clase;
use App\Models\User;
use App\Models\ClassRegistration;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ClassController extends Controller {
    //

    public function addMember( $classId, $memberId ) {
        $class = Clase::findOrFail( $classId );
        $member = User::findOrFail( $memberId );

        // Obtener la fecha de la clase
        // Extraer solo la fecha del campo horario
        $fechaClase = \Carbon\Carbon::parse( $class->horario )->toDateString();
        // Formato: YYYY-MM-DD

        // Asegúrate de que este campo exista en la tabla clases
        //dd( $fechaClase );
        // Verificar si el socio ya está inscrito en otra clase en esa misma fecha
        $inscriptoHoy = ClassRegistration::where('socio_id', $memberId)
        ->whereHas('clase', function ($query) use ($fechaClase) {
            $query->whereDate('horario', $fechaClase);
        })
        ->exists();

        if ( $inscriptoHoy ) {

            return redirect()->back()->with( 'error', 'El socio ya está inscrito en una clase en esta fecha.' );
        }

        // Verificar capacidad y créditos
        if ( $class->class_Registrations()->count() < $class->capacidad_maxima && $member->credits >= $class->creditos_requeridos ) {
            // $class->class_Registrations()->attach( $memberId, [ 'status' => 'pendiente' ] );
            // $member->decrement( 'credits', $class->creditos_requeridos );

            // Crear un nuevo registro en la tabla de inscripciones
            $class->class_Registrations()->create( [
                'socio_id' => $memberId,
                'estado_inscripcion' => 'pendiente',
                'fecha_inscripcion' => now(),
                'presencia_confirmada' => false
            ] );

            // Decrementar los créditos del socio
            //Deshabilitado  Hasta que se confirme la clase
            $member->decrement( 'credits', $class->creditos_requeridos );

            return redirect()->back()->with( 'success', 'Socio inscripto exitosamente.' );
        }

        return redirect()->back()->with( 'error', 'No se pudo inscribir al socio.' );
    }

    public function removeMember( $classId, $memberId ) {

         // Asegurar que $memberId sea un entero
        $memberId = (int) $memberId;

         // Obtener el usuario autenticado
        $authUser = auth()->user();

        // Buscar la inscripción del socio en la clase
        $registration = ClassRegistration::where( 'clase_id', $classId )
        ->where( 'socio_id', $memberId )
        ->firstOrFail();

        // Restablecer el crédito del socio
        $user = User::findOrFail( $memberId );
        $class = Clase::findOrFail( $classId );

        // Verificar si el usuario tiene permiso para eliminar la inscripción

        $puedeEliminar = $authUser->role === 'administrador' || ($authUser->id === $memberId && now()->addMinutes(30)->lte($class->horario));



        if (!$puedeEliminar) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta inscripción o el tiempo permitido ha expirado.');
        }
        // Si necesitas obtener los créditos requeridos desde la clase

        // Sumar el crédito restado al inscribirse
        $user->credits += $class->creditos_requeridos;
        $user->save();

        // Eliminar el registro de la inscripción
        $registration->delete();

        return redirect()->back()->with( 'success', 'El socio ha sido quitado de la clase y su crédito ha sido restituido.' );
    }

    // Iniciar la clase

    public function start( $classId ) {
        $class = Clase::findOrFail( $classId );

        if ( $class->estado === 'pendiente' ) {
            $class->estado = 'iniciada';
            $class->save();

            return redirect()->back()->with( 'success', 'La clase ha sido iniciada.' );
        }

        return redirect()->back()->with( 'error', 'No se puede iniciar la clase. Verifique el estado actual.' );
    }

    public function end( $classId ) {
        $class = Clase::findOrFail( $classId );

        if ( $class->estado === 'iniciada' ) {
            $class->estado = 'finalizada';
            $class->save();

            return redirect()->back()->with( 'success', 'La clase ha sido fnalizada.' );
        }

        return redirect()->back()->with( 'error', 'No se puede finalizar la clase. Verifique el estado actual.' );
    }

    //Marcar soio como presenta

    public function setPresent( $classId, $memberId ) {
        try {
            // Encuentra la inscripción del socio a la clase
            $registration = ClassRegistration::where( 'clase_id', $classId )
            ->where( 'socio_id', $memberId )
            ->firstOrFail();

            // Verifica si ya está presente
            if ( $registration->estado_inscripcion === 'presente' ) {
                return redirect()->back()->with( 'info', 'El socio ya está marcado como presente.' );
            }

            // Actualiza el estado a presente
            $registration->update( [ 'estado_inscripcion' => 'presente' ] );

            return redirect()->back()->with( 'success', 'El socio se registró como presente.' );

        } catch ( \Exception $e ) {
            // Manejo de errores
            return redirect()->back()->with( 'error', 'Ocurrió un problema al registrar el socio como presente.' );
        }
    }

    public function destroy( $id ) {
        $clase = Clase::findOrFail( $id );
        $clase->delete();

        return redirect()->route( 'admin.list-clases' )->with( 'success', 'Clase eliminada correctamente.' );
    }

    //Show clases

    public function showClases( Request $request ) {

        //REcuperar datos del socio
        $socio = User::findOrFail( auth()->user()->id );

        // Obtener la fecha seleccionada o, en caso de no existir, asignar el día actual.
        $fechaSeleccionada = $request->input( 'fecha', now()->format( 'Y-m-d' ) );

        // Definir la fecha de hoy y el límite ( 7 días a partir de hoy )
        $hoy = Carbon::today();
        $limite = Carbon::today()->addDays( 7 );


        // Validar que la fecha seleccionada sea igual o posterior a hoy y menor o igual a 30 días a partir de hoy.
        if ( Carbon::parse( $fechaSeleccionada )->lt( $hoy ) || Carbon::parse( $fechaSeleccionada )->gt( $limite ) ) {
            return redirect()->back()->withErrors( 'La fecha debe ser igual o posterior al día actual y menor o igual a 30 días.' );
        }

        // Construir la consulta básica para las clases del día seleccionado.
        $query = Clase::with( [ 'profesor' ] )
        ->withCount( 'class_Registrations' )
        ->whereDate( 'horario', $fechaSeleccionada )
        ->orderBy( 'horario', 'asc' );

        // Si la fecha seleccionada es hoy, agregar condición para mostrar solo clases desde la hora actual en adelante.

        if ( $fechaSeleccionada === $hoy->format( 'Y-m-d' ) ) {
            $query->where( 'horario', '>=', now()->toDateTimeString() );
        }

        // Ejecutar la consulta.
        $clases = $query->get();

        // Obtener la clase en la que el socio está inscripto en la fecha seleccionada
        $inscripciones = ClassRegistration::with(['clase.profesor']) // Cargar clase y profesor
        ->where('socio_id', $socio->id)
        ->whereHas('clase', function ($query) use ($fechaSeleccionada) {
            $query->whereDate('horario', $fechaSeleccionada);
        })
        ->get();

        return view('socio.show-clases', compact('clases', 'fechaSeleccionada', 'socio', 'inscripciones'));

    }

}
