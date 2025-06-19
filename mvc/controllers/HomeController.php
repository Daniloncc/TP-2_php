<?php

namespace App\Controllers;

use App\Models\Client;
use App\Providers\View;

class HomeController
{

    public function index()
    {
        return View::render('/home');
    }
}
