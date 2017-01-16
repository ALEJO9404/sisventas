<?php

namespace Sisventas;

use Illuminate\Database\Eloquent\Model;
class Categoria extends Model
{
  //protected $table = 'categorias';
    public $timestamps=false;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'descripcion', 'condicion',
    ];

    public function articulo()
    {
        return $this->hasMany('Sisventas\Articulo');
    }

}
