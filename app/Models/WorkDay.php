<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class WorkDay extends Model {
    use HasFactory;
    // Campos permitidos para asignación masiva
    protected $fillable = [
        'day',
        'active',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'user_id',
    ];

    /**
    * Relación con el modelo User
    * Un día de trabajo pertenece a un usuario
    */

    public function user() {
        return $this->belongsTo( User::class );
    }

    // Accesores para formatear las horas

    public function getMorningStartAttribute( $value ) {
        return Carbon::parse( $value )->format( 'H:i' );
    }

    public function getMorningEndAttribute( $value ) {
        return Carbon::parse( $value )->format( 'H:i' );
    }

    public function getAfternoonStartAttribute( $value ) {
        return Carbon::parse( $value )->format( 'H:i' );
    }

    public function getAfternoonEndAttribute( $value ) {
        return Carbon::parse( $value )->format( 'H:i' );
    }
}
