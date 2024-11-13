<?php

namespace App\Http\Controllers;
use App\Models\Clase;
use App\Models\User;

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

}
