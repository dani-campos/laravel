<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model {
    public $timestamps = false;
    protected $filleble = ['nome'];
    protected $guarded=[];

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class);
    }
}


