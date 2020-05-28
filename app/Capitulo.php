<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Capitulo extends Model
{
    public $timestamps = false;
    protected $filleble = ['numero'];
    protected $guarded=[];

    public function paginas()
    {
        return $this->hasMany(Pagina::class);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function getPaginasLidas(): Collection
    {
        return $this->paginas->filter(function (Pagina $pagina) {
            return $pagina->lido;
        });
    }
}
