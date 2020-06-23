<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'foto','descricao', 
        'dt_nasc','sexo', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relacionamento com as receitas na Receita
    public function receitas() {
        return $this->hasMany(Receita::class, 'author', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    public function seguidor() {
        return $this->hasMany(Colega::class, 'seguidor', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    public function seguido() {
        return $this->hasMany(Colega::class, 'seguido', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    // Relacionamento avaliaçao
    public function saves() {
        return $this->hasMany(Save::class, 'author', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    // Relacionamento com as receitas na Receita
    public function comentarios() {
        return $this->hasMany(Comentario::class, 'author', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }

    // Relacionamento com as receitas na Receita
    public function avaliacoes() {
        return $this->hasMany(Avaliacao::class, 'author', 'id');
        //class que se relaciona
        //nome da chave estrangeira
        //nome da pk local
    }
}
