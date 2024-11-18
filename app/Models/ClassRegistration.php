<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRegistration extends Model {
    use HasFactory;
    protected $table = 'class_registrations';

    protected $fillable = [
        'socio_id',
        'clase_id',
        'estado_inscripcion',
        'fecha_inscripcion',
        'presencia_confirmada',
    ];

    // Relación con el modelo Socio/Usuario

    public function socio() {
        return $this->belongsTo( User::class, 'socio_id' );
    }

    // Relación con el modelo Clase

    public function clase() {
        return $this->belongsTo( Clase::class, 'clase_id' );
    }
}
