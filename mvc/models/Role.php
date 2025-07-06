<?php

namespace App\Models;

use App\Models\CRUD;

class Role extends CRUD
{
    protected $table = "role";
    protected $primaryKey = "id";
}
