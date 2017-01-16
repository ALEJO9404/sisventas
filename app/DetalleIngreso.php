<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;
use Sisventas\Events\IngresoInventario;

class DetalleIngreso extends Model
{
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public static function boot(){
        parent::boot();
        static::created(function($DetalleIngreso){
            event(new IngresoInventario($DetalleIngreso));
        });
    }

    protected $fillable = [
        'ingreso_id', 'articulo_id', 'cantidad', 'precio_compra', 'precio_venta', 
    ];

    public function ingreso()
    {
        return $this->belongsTo('Sisventas\Ingreso');
    }

    public function articulo()
    {
        return $this->belongsTo('Sisventas\Articulo');
    }
}
