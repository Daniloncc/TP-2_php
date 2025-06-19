<?php

namespace App\Models;

use App\Models\CRUD;

class Livre extends CRUD
{
    protected $table = "livre";
    protected $primaryKey = "id";
}
