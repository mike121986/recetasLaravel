<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'name',
        'email',
        'password',
        'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // evento que se ejecuta cuando el usuario es creado
    protected static function boot()
    {
        parent::boot();
        // asignar perfil una vez que se halla creado un nuevo usuario
        static::created(function($user){
            $user->perfil()->create();
        });
    }
    //relacion de uno a muchos de usaurios a Recetas
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    // relacion de uno a uno de usuario a perfil

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }
}
