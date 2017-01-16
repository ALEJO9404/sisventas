<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'persona_id', 'user_id', 'tipo_comprobante', 'serie_comprobante', 'impuesto', 'total_venta', 'estado',
    ];

    public function detalleventa()
    {
        return $this->hasMany('Sisventas\DetalleVenta');
    }

    public function persona()
    {
        return $this->belongsTo('Sisventas\Persona');
    }
    
    public function user()
    {
        return $this->belongsTo('Sisventas\User');
    }
}
