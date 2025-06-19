<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Ville;
use App\Providers\View;
use App\Providers\Validator;

class ClientController
{
    final public function create()
    {
        $ville = new Ville;
        $villes = $ville->select();
        return View::render('client/create', ['villes' => $villes]);
    }

    final public function show($data)
    {

        if (isset($data['id']) && $data['id'] != null) {
            $client = new Client;
            $client = $client->selectId($data['id']);

            if ($client) {
                $idVille = $client['idVille'];
                $ville = new Ville;
                $ville = $ville->selectId($idVille);
                $ville =  $ville['ville'];
                return View::render('client/show', ['client' => $client, 'ville' => $ville]);
            } else {
                return View::render('error', ['message' => "Ce Client n'existe pas!"]);
            }
        } else {
            return View::render('error', ['message' => '404 page non trouve!']);
        }
    }

    final public function edit($data)
    {
        if (isset($data['id']) && $data['id'] != null) {
            $client = new Client;
            $client = $client->selectId($data['id']);

            if ($client) {
                $idVille = $client['idVille'];
                $ville = new Ville;
                $ville = $ville->selectId($idVille);
                $villes = new Ville;
                $villes = $villes->select();
                $ville =  $ville['ville'];
                return View::render('client/edit', ['client' => $client, 'ville' => $ville, 'villes' => $villes]);
            } else {
                return View::render('error', ['message' => "Ce Client n'existe pas!"]);
            }
        } else {
            return View::render('error', ['message' => '404 page non trouve!']);
        }
    }

    final public function store($data)
    {

        $validator = new Validator;
        $validator->field('nom', $data['nom'])->onlyLetters()->min(2)->max(45);
        $validator->field('prenom', $data['prenom'])->onlyLetters()->min(2)->max(25);
        $validator->field('adresse', $data['adresse'])->min(4)->max(80);
        $validator->field('telephone', $data['telephone'])->number()->min(10)->max(13);
        $validator->field('courriel', $data['courriel'])->email()->min(4)->max(80);
        $validator->field('idVille', $data['idVille'], 'idVille')->required();

        if ($validator->isSuccess()) {
            $client = new Client;
            $insertClient = $client->insert($data);

            if ($insertClient) {
                return View::redirect('client/show?id=' . $insertClient);
            } else {
                return View::render('error', ['message' => '404 page non trouve!']);
            }
        } else {
            $errors = $validator->getErrors();
            if ($errors['idVille']) {
                $errors['idVille'] = "La ville est necessaire!";
            }
            $villes = new Ville;
            $villes = $villes->select();

            return View::render('client/create', ['errors' => $errors, 'client' => $data, 'villes' => $villes]);
        }
    }

    final public function update($data, $get)
    {

        if (isset($get['id']) && $get['id'] != null && $get['id'] == $data['id']) {

            $validator = new Validator;
            $validator->field('nom', $data['nom'])->onlyLetters()->min(2)->max(45);
            $validator->field('prenom', $data['prenom'])->onlyLetters()->min(2)->max(25);
            $validator->field('adresse', $data['adresse'])->min(4)->max(80);
            $validator->field('telephone', $data['telephone'])->number()->min(10)->max(13);
            $validator->field('courriel', $data['courriel'])->email()->min(4)->max(80);
            $validator->field('idVille', $data['idVille'], 'idVille')->required();

            if ($validator->isSuccess()) {

                $client = new Client;
                $insertClient = $client->update($data, $data['id']);
                $idVille = $data['idVille'];
                $ville = new Ville;
                $ville = $ville->selectId($idVille);
                $villes = new Ville;
                $villes = $villes->select();
                $ville =  $ville['ville'];

                return View::redirect('client/show?id=' . $data['id'], ['client' => $client, 'ville' => $ville, 'villes' => $villes]);
            } else {
                $errors = $validator->getErrors();
                if ($errors['idVille']) {
                    $errors['idVille'] = "La ville est necessaire!";
                }
                $villes = new Ville;
                $villes = $villes->select();

                return View::render('client/edit', ['errors' => $errors, 'client' => $data, 'villes' => $villes]);
            }
        } else {
            return View::render('error', ['message' => 'Impossible de mettre vos informations a jour!']);
        }
    }

    final public function delete($data)
    {

        $client = new Client;
        $delete = $client->delete($data['id']);
        if ($delete) {
            return View::render('delete', ['message' => 'Votre compte a ete bien supprime!']);
        }
    }
}
