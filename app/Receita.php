<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Receita extends Model
{
    // Atributos
    protected $fillable = [
        'title', 'slug',
        'descricao', 'ingredientes',
        'modoPreparo', 'author', 'idid',
    ];

    // p/ transformar uma url amigavel do titulo
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Relacionamentos
    public function author() {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function avaliacao() {
        return $this->hasMany(Avaliacao::class, 'receita', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    public function comentario() {
        return $this->hasMany(Comentario::class, 'receita', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    public function fazerDepois() {
        return $this->hasMany(Save::class, 'receita', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    // Relacionamento 
    public function idid() {
        return $this->belongsTo(Receita::class, 'idid', 'id');
        //class(Modelo) que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    // Relacionamento 
    public function idids() {
        return $this->hasMany(receita::class, 'idid', 'id');
        //class(Modelo) que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }
}
