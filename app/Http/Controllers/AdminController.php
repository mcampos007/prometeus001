<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Clase;
use App\Models\WorkDay;
use App\Models\ClassRegistration;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller {
    //

    public function addCredits( Request $request ) {
        $request->validate( [
            'user_id' => 'required|exists:users,id',
            'credits' => 'required|integer|min:1',
        ] );

        $user = User::find( $request->user_id );

        if ( $user->role !== 'socio' ) {
            return redirect()->back()->withErrors( [ 'error' => 'Solo los usuarios con rol de socio pueden recibir créditos.' ] );
        }

        $user->increment( 'credits', $request->credits );

        return redirect()->route( 'admin.show-add-credits-form' )->with( 'success', 'Créditos asignados exitosamente.' );

    }

    public function showAddCreditsForm() {

        $select_socio_id = 0;

        // Obtener todos los usuarios con rol de 'socio'
        $socios = User::where( 'role', 'socio' )->get();

        return view( 'admin.add-credits', compact( 'socios', 'select_socio_id' ) );
    }

    public function showAddCreditssocioForm( $id ) {
        if ( $id ) {
            $socio = User::findOrFail( $id );
            if ( $socio ) {
                $select_socio_id = $id;
            } else {
                $select_socio_id = 0;
            }
        }
        // Obtener todos los usuarios con rol de 'socio'
        $socios = User::where( 'role', 'socio' )->get();

        return view( 'admin.add-credits', compact( 'socios', 'select_socio_id' ) );
    }

    // Mostrar lista de socios

    public function listSocios() {
        $socios = User::where( 'role', 'socio' )->orderBy( 'name' )->get();

        // // Asegúrate de convertir credit_vto a un objeto Carbon
        // foreach ( $socios as $socio ) {
        //     if ( $socio->credit_vto ) {
        //         $socio->credit_vto = \Carbon\Carbon::parse( $socio->credit_vto );
        //     }
        // }
        // Ordenar alfabéticamente por nombre
        return view( 'admin.socios', compact( 'socios' ) );
    }

    //Mostrar Lista de Profesora

    public function listProfes() {
        $profes = User::where( 'role', 'profesor' )->orderBy( 'name' )->get();
        return view( 'admin.profes', compact( 'profes' ) );
    }

    //Add Profe

    public function addProfes() {
        return view( 'admin.add-profes' );
    }

    public function addNewProfe( Request $request ) {

        // Validación de los datos del formulario
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed', // Si tienes campo de confirmación
        ] );

        // Crear el usuario con los datos validados
        $user = User::create( [
            'name' => $validatedData[ 'name' ],
            'email' => $validatedData[ 'email' ],
            'password' => Hash::make( 'password' ),
            'role' => 'profesor', // Rol predeterminado
            'credits' => 0, // Opcional: inicializar en 0 u otro valor si es necesario
            'credit_vto' => now()->addMonths( 1 ), // Ejemplo de vencimiento de crédito en 1 mes
        ] );

        // Redirigir o devolver respuesta
        return redirect()->route( 'list-profes' )->with( 'success', 'El profesor ha sido creado con éxito.' );

    }

    public function editProfes( $id ) {
        // Encuentra el usuario por su ID
        $user = User::findOrFail( $id );

        // Retorna la vista 'edit-profes' con los datos del usuario
        return view( 'admin.edit-profes', compact( 'user' ) );
    }

    public function updateProfe( Request $request, $id ) {
        // Validación de los datos
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ] );

        // Obtener el profesor y actualizar sus datos
        $profesor = User::findOrFail( $id );
        $profesor->update( [
            'name' => $request->input( 'name' ),
            'email' => $request->input( 'email' ),
        ] );

        // Redirigir con un mensaje de éxito
        return redirect()->route( 'list-profes' )->with( 'success', 'Profesor actualizado exitosamente' );
    }

    // Mostrar lista de Clases

    public function listClases() {
        // Obtener la fecha actual
        $today = now()->format( 'Y-m-d' );

        // Obtener las clases del día de hoy y ordenarlas por el horario
        // $clases = Clase::with( 'profesor' )
        // ->whereDate( 'horario', $today )
        // ->orderBy( 'horario', 'asc' ) // Ordenar por horario en orden ascendente
        // ->get();

        // Obtener las clases del día de hoy, incluir el profesor y contar los socios inscritos
        $clases = Clase::with(['profesor'])
            ->withCount('class_Registrations') // Contar la cantidad de inscripciones para cada clase
            ->whereDate('horario', $today)
            ->orderBy('horario', 'asc') // Ordenar por horario en orden ascendente
            ->get();
        //dd($clases);
        // Retornar la vista con la lista de clases
        return view( 'admin.list-clases', compact( 'clases' ) );
    }

    //Método para llamar a la vista para el alta de una clase

    public function addClases() {

        // Obtener usuarios con rol de 'profesor'
        $profesores = User::where( 'role', 'profesor' )->get();

        // Retornar la vista para crear una clase
        return view( 'admin.add-clases', compact( 'profesores' ) );
    }

    //Método para Almacenar la clase

    public function storeClase( Request $request ) {
        // Validación de los datos recibidos
        $request->validate( [
            'nombre' => 'required|string|max:255',
            'profesor_id' => 'required|exists:users,id',
            'horario' => 'required|date',
            'capacidad_maxima' => 'required|integer|min:1',
            'creditos_requeridos' => 'required|integer|min:0',
            'estado' => 'required|in:activa,inactiva',
        ] );

        // Creación de la nueva clase
        Clase::create( [
            'nombre' => $request->nombre,
            'profesor_id' => $request->profesor_id,
            'horario' => $request->horario,
            'capacidad_maxima' => $request->capacidad_maxima,
            'creditos_requeridos' => $request->creditos_requeridos,
            'estado' => $request->estado,
        ] );

        // Redirigir con un mensaje de éxito
        return redirect()->route( 'admin.list-clases' )->with( 'success', 'Clase creada exitosamente.' );
    }

    // Llamada a la vista para generar las clases

    public function generateClasseslist() {
        return view ( 'admin.generate-classes' );
    }

    //Generacion mensual de clases

    public function generateClasses( Request $request ) {
        // Traducción de días de inglés a español
        $daysInSpanish = [
            'monday' => 'lunes',
            'tuesday' => 'martes',
            'wednesday' => 'miercoles',
            'thursday' => 'jueves',
            'friday' => 'viernes',
            'saturday' => 'sabado',
            'sunday' => 'domingo',
        ];

        // Validación del request
        $request->validate( [
            'month' => 'required|date_format:Y-m',
            'duration' => 'required|integer|min:30',
            'credits' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
        ] );

        $month = $request->input( 'month' );
        $duration = $request->input( 'duration' );
        $credits = $request->input( 'credits' );
        $capacity = $request->input( 'capacity' );

        $workdays = WorkDay::where( 'active', 1 )->get();

        foreach ( $workdays as $workday ) {
            $date = new \DateTime( $month . '-01' );

            while ( $date->format( 'Y-m' ) == $month ) {
                $dayInSpanish = $daysInSpanish[ strtolower( $date->format( 'l' ) ) ] ?? '';

                if ( $dayInSpanish === strtolower( $workday->day ) ) {
                    // Horarios de la mañana
                    $start = new \DateTime( $date->format( 'Y-m-d' ) . ' ' . $workday->morning_start );
                    $end = new \DateTime( $date->format( 'Y-m-d' ) . ' ' . $workday->morning_end );

                    while ( $start < $end ) {
                        $this->upsertClase( $workday, $start, $capacity, $credits, $duration );
                        $start->modify( "+{$duration} minutes" );
                    }

                    // Horarios de la tarde
                    $start = new \DateTime( $date->format( 'Y-m-d' ) . ' ' . $workday->afternoon_start );
                    $end = new \DateTime( $date->format( 'Y-m-d' ) . ' ' . $workday->afternoon_end );

                    while ( $start < $end ) {
                        $this->upsertClase( $workday, $start, $capacity, $credits, $duration );
                        $start->modify( "+{$duration} minutes" );
                    }
                }
                $date->modify( '+1 day' );
            }
        }

        return redirect()->route( 'admin.list-clases' )->with( 'success', 'Las clases fueron generadas o actualizadas exitosamente.' );
    }

    private function upsertClase( $workday, $start, $capacity, $credits, $duration ) {
        // Busca una clase existente con el mismo profesor, horario y día
        $existingClass = Clase::where( 'profesor_id', $workday->user_id )
        ->where( 'horario', $start->format( 'Y-m-d H:i:s' ) )
        ->first();

        if ( $existingClass ) {
            // Si la clase existe, actualiza los datos necesarios
            $existingClass->update( [
                'capacidad_maxima' => $capacity,
                'creditos_requeridos' => $credits,
                'estado' => 'pendiente',
                'updated_at' => now(),
            ] );
        } else {
            // Si la clase no existe, crea una nueva
            Clase::create( [
                'nombre' => 'Clase de ' . ucfirst( $workday->day ),
                'profesor_id' => $workday->user_id,
                'horario' => $start->format( 'Y-m-d H:i:s' ),
                'capacidad_maxima' => $capacity,
                'creditos_requeridos' => $credits,
                'estado' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ] );
        }
    }

    public function sociosEnClase( $id ) {
        $class = Clase::with('class_Registrations')->findOrFail($id);
        $maxCapacity = $class->capacidad_maxima;
       // $socios = User::where('role', 'socio')->get();
       $availableMembers = User::where('role', 'socio')
    ->where('credits', '>=', $class->creditos_requeridos)  // Verificar si el socio tiene suficientes créditos
    ->whereDoesntHave('class_registrations', function ($query) use ($id) {
        $query->where('clase_id', $id);  // Excluir socios ya registrados en la clase
    })
    ->get();

    return view('classes.manage-members', compact('class', 'availableMembers'));


    }

}