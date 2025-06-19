<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\Livre;


class LivreController
{
    public function index()
    {
        $livre = new Livre;
        $livres = $livre->select();
        return View::render('livre/index', ['livres' => $livres]);
    }
}
