<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Ville;
use App\Providers\View;
use App\Providers\Validator;

class UserController
{
    final public function create()
    {
        $ville = new Ville;
        $villes = $ville->select();
        return View::render('user/create', ['villes' => $villes]);
    }

    final public function connection()
    {
        return View::render('user/connection');
    }

    final public function login($data)
    {
        $validator = new Validator;
        $validator->field('courriel', $data['courriel'])->email()->min(4)->max(80);
        $validator->field('motPasse', $data['motPasse'])->onlyLettersAndNumbers();

        if ($validator->isSuccess()) {
            $user = new User;
            $champ = array_key_first($data);
            $userExist = $user->unique($champ, $data['courriel']);
            if ($userExist) {
                $motPasseDB = $userExist[6];
                if (password_verify($data['motPasse'], $motPasseDB)) {

                    // print_r($userExist);
                    // die;
                    $idVille = $data['idVille'];
                    $ville = new Ville;
                    $ville = $ville->selectId($idVille);
                    $villes = new Ville;
                    $villes = $villes->select();
                    $ville =  $ville['ville'];
                    return View::redirect('user/show?id=' . $userExist['id'], ['user' => $userExist, 'ville' => $ville, 'villes' => $villes]);
                    echo "Mot de passe valide.";
                } else {
                    return View::render('user/connection', ['error' => "Mot de passe incorrect!", 'user' => $data]);
                }
            } else {
                return View::render('user/connection', ['error' => "C'est Utilisateur n'existe pas!", 'user' => $data]);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('user/connection', ['errors' => $errors, 'user' => $data]);
        }
    }

    final public function show($data)
    {

        if (isset($data['id']) && $data['id'] != null) {
            $user = new User;
            $user = $user->selectId($data['id']);

            if ($user) {
                // print_r($user);
                // die;
                $idVille = $user['idVille'];
                $ville = new Ville;
                $ville = $ville->selectId($idVille);
                $ville =  $ville['ville'];
                return View::render('user/show', ['user' => $user, 'ville' => $ville]);
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
            $user = new User;
            $user = $user->selectId($data['id']);

            if ($user) {
                $idVille = $user['idVille'];
                $ville = new Ville;
                $ville = $ville->selectId($idVille);
                $villes = new Ville;
                $villes = $villes->select();
                $ville =  $ville['ville'];
                $roles = new Role;
                $roles = $roles->select();
                return View::render('user/edit', ['user' => $user, 'ville' => $ville, 'villes' => $villes, 'roles' => $roles]);
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
        $validator->field('motPasse', $data['motPasse'])->onlyLettersAndNumbers();
        $validator->field('idVille', $data['idVille'], 'idVille')->required();

        if ($validator->isSuccess()) {
            $user = new User;

            // Creer un role pour l'user
            $data["idRole"] = 2;
            $data['motPasse'] = $user->hashPassword($data['motPasse']);

            $insertUser = $user->insert($data);

            if ($insertUser) {
                return View::redirect('user/show?id=' . $insertUser);
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

            return View::render('user/create', ['errors' => $errors, 'user' => $data, 'villes' => $villes]);
        }
    }

    final public function update($data, $get)
    {

        // print_r($data);
        // die;
        if (isset($get['id']) && $get['id'] != null && $get['id'] == $data['id']) {

            $validator = new Validator;
            $validator->field('nom', $data['nom'])->onlyLetters()->min(2)->max(45);
            $validator->field('prenom', $data['prenom'])->onlyLetters()->min(2)->max(25);
            $validator->field('adresse', $data['adresse'])->min(4)->max(80);
            $validator->field('telephone', $data['telephone'])->number()->min(10)->max(13);
            $validator->field('courriel', $data['courriel'])->email()->min(4)->max(80);
            $validator->field('idVille', $data['idVille'], 'idVille')->required();

            if ($validator->isSuccess()) {

                // print_r($data);
                // die;
                $user = new User;
                $insertUser = $user->update($data, $data['id']);
                // print_r($insertUser);
                // die;
                $idVille = $data['idVille'];
                $ville = new Ville;
                $ville = $ville->selectId($idVille);
                $villes = new Ville;
                $villes = $villes->select();
                $ville =  $ville['ville'];

                //print_r($insertUser);
                return View::redirect('user/show?id=' . $data['id'], ['user' => $user, 'ville' => $ville, 'villes' => $villes]);
            } else {
                $errors = $validator->getErrors();
                if ($errors['idVille']) {
                    $errors['idVille'] = "La ville est necessaire!";
                }
                $villes = new Ville;
                $villes = $villes->select();

                return View::render('user/edit', ['errors' => $errors, 'user' => $data, 'villes' => $villes]);
            }
        } else {
            return View::render('error', ['message' => 'Impossible de mettre vos informations a jour!']);
        }
    }

    final public function delete($data)
    {

        $user = new User;
        $delete = $user->delete($data['id']);
        if ($delete) {
            return View::render('delete', ['message' => 'Votre compte a ete bien supprime!']);
        }
    }
}
