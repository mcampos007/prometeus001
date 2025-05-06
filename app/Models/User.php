<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'dni',
        'email',
        'password',
        'role',
        'credit',
        'credit_vto'
    ];

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'credit_vto' => 'datetime', // Esto convierte credit_vto automáticamente en un objeto Carbon

    ];

    public function class_registrations() {
        return $this->hasMany( ClassRegistration::class, 'socio_id' );
    }

    // Nuevo método para verificar roles

    public function hasRole( $role ) {
        return $this->role === $role;
    }

    public function payments() {
        return $this->hasMany( Payment::class );
    }
}
