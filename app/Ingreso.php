<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'persona_id', 'tipo_comprobante', 'serie_comprobante', 'num_comprobante', 'impuesto', 'estado',
    ];

    public function detalleingreso()
    {
        return $this->hasMany('Sisventas\DetalleIngreso');
    }

    public function persona()
    {
        return $this->belongsTo('Sisventas\Persona');
    }

}
