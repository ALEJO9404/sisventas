<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'categoria_id', 'codigo', 'nombre', 'stock', 'descripcion', 'imagen', 'estado',
    ];

    public function categoria()
    {
        return $this->belongsTo('Sisventas\Categoria');
    }

    public function detalleingreso()
    {
        return $this->hasMany('Sisventas\DetalleIngreso');
    }

    public function detalleventa()
    {
        return $this->hasMany('Sisventas\DetalleVenta');
    }
}
