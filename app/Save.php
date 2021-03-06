<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    // Tirando $timestamps da tabela
    protected $table = 'saves';
    public $timestamps = false;

    // Relacionamento 
    public function receita() {
        return $this->belongsTo(Receita::class, 'receita', 'id');
        //class(Modelo) que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    // Relacionamento 
    public function author() {
        return $this->belongsTo(User::class, 'author', 'id');
        //class(Modelo) que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }
}
