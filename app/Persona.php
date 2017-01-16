<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_persona', 'nombre', 'tipo_documento', 'numero_documento', 'direccion', 'telefono', 'email',
    ];

    public function ingresos()
    {
        return $this->hasMany('Sisventas\Ingreso');
    }
}
