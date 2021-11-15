<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;


class Pedido extends Model
{
    protected $table = "pedidos";


    protected $fillable = [
      'cliente_id','usuario_id','num_comprobante','fecha','total', 'estado','formadePago','envio','direccion','observaciones'
    ];

    public function detalle_pedido()
    {
        return $this->hasMany(Detalle_Pedido::class,'pedido_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class,'deposito_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getFromhora($value) {
        return \Carbon\Carbon::parse($value)->format('H:i:s');
    }

    public function calcular($value,$id) {
        
        $mytime = \Carbon\Carbon::now('America/Argentina/Tucuman');
        
        $fecha1 = new DateTime($mytime->toDateTimeString());

        $fecha2 = new DateTime($value);
        
        $resultado = $fecha2->diff($fecha1);
        
        return $resultado->format('%d');

    }

    public function getTotalPrice() {
        return $this->detalle_pedido()->sum(DB::raw('quantity * price'));
      }

}
