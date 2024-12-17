<?php

namespace App\Http\Controllers;
use App\Models\Clase;
use App\Models\User;
use App\Models\ClassRegistration;

use Illuminate\Http\Request;

class ClassController extends Controller {
    //

    public function addMember( $classId, $memberId ) {
        $class = Clase::findOrFail( $classId );
        $member = User::findOrFail( $memberId );

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
            //$member->decrement( 'credits', $class->creditos_requeridos );

            return redirect()->back()->with( 'success', 'Socio inscrito exitosamente.' );
        }

        return redirect()->back()->with( 'error', 'No se pudo inscribir al socio.' );
    }

    public function removeMember( $classId, $memberId ) {

        $registration = ClassRegistration::where( 'clase_id', $classId )
        ->where( 'socio_id', $memberId )
        ->firstOrFail();

        $registration->delete();

        return redirect()->back()->with( 'success', 'El socio ha sido quitado de la clase.' );
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

}
