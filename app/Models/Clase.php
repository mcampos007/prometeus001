<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model {
    use HasFactory;

    protected $fillable = [
        'nombre',
        'profesor_id',
        'horario',
        'capacidad_maxima',
        'creditos_requeridos',
        'estado',
    ];

    // Relación con el modelo User

    public function profesor() {
        return $this->belongsTo( User::class, 'profesor_id' );
    }

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'horario' => 'datetime',

    ];

    // Relación con ClassRegistration

    public function class_Registrations() {
        return $this->hasMany( ClassRegistration::class, 'clase_id' );
    }

    public function getHorarioFormattedAttribute() {
        return \Carbon\Carbon::parse( $this->horario )->format( 'H:i' );
    }
}
