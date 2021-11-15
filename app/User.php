<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Unidad_Negocio;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellido', 'imagen_perfil', 'username', 'password', 'email', 'telefono_celular', 'telefono_fijo', 'domicilio', 'pagina_principal', 'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeBuscarUser($query,$id){
        if (trim($id)!= "") {
            $query->where('name', 'LIKE', $id.'%');
        }
    }

    public function unidades_negocios()
    {
        return $this->belongsToMany(Unidad_Negocio::class,'unidad_negocio_usuario','usuario_id','unidadnegocio_id');
    }


    // Relacion con Movimientos de Tareas

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento_Tarea');
    }

    public function caja()
    {
        return $this->hasOne(Cajas::class,'id','caja_id');
    }

    public function getCliente()
    {
        return $this->hasOne(Cliente::class,'id','cliente_id');
    }

}
