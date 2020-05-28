<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    public $timestamps = false;
    protected $filleble = ['numero'];
    protected $guarded=[];

    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class);
    }
}
