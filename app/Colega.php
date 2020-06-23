<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colega extends Model
{
    // Tirando $timestamps da tabela
    protected $table = 'colegas';
    public $timestamps = false;

    // Relacionamento 
    public function seguidor() {
        return $this->belongsTo(User::class, 'seguidor', 'id');
        //class(Modelo) que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    public function seguido() {
        return $this->belongsTo(User::class, 'seguido', 'id');
        //class(Modelo) que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }
}
