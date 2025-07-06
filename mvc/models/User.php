<?php

namespace App\Models;

use App\Models\CRUD;

class User extends CRUD
{
    protected $table = "utilisateur";
    protected $primaryKey = "id";
    protected $fillable = ['nom', 'prenom', 'adresse', 'telephone', 'courriel', 'motPasse', 'idRole', 'idVille'];

    public function hashPassword($password, $cost = 10)
    {
        $options = [
            'cost' => $cost
        ];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
}
