<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;
use Sisventas\Events\RegistroVenta;

class DetalleVenta extends Model
{
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public static function boot(){
        parent::boot();
        static::created(function($DetalleVenta){
            event(new RegistroVenta($DetalleVenta));
        });
    }

    protected $fillable = [
        'venta_id', 'articulo_id', 'cantidad', 'precio_venta', 'descuento', 
    ];

    public function venta()
    {
        return $this->belongsTo('Sisventas\Venta');
    }

    public function articulo()
    {
        return $this->belongsTo('Sisventas\Articulo');
    }

}
