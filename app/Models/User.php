<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = ['name', 'surname', 'email', 'contact', 'password', 'type'];

    public function getAuthIdentifierName() {
        return 'id'; // Nome do campo que é o identificador de autenticação na tabela do banco de dados
    }

    public function getAuthIdentifier() {
        return $this->getKey(); // Retorna o valor do identificador de autenticação
    }

    public function getAuthPassword() {
        return $this->password; // Retorna a senha do usuário
    }

    // Outros métodos da interface Authenticatable, se necessário

    // Por exemplo, se você estiver usando a funcionalidade de lembrar-me (remember me), você pode implementar o método abaixo.
    public function getRememberToken() {
        return $this->remember_token;
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }
}
