<?php

namespace App\Controllers;

use App\Providers\View;
use App\Models\Livre;
use App\Models\Editeur;
use App\Models\Categorie;
use App\Models\Auteur;
use App\Providers\Validator;

class LivreController
{
    public function index()
    {
        $livre = new Livre;
        $livres = $livre->select();
        return View::render('livre/index', ['livres' => $livres]);
    }

    final public function create()
    {
        $editeur = new Editeur;
        $editeurs = $editeur->select();
        $categorie = new Categorie;
        $categories = $categorie->select();
        $auteur = new Auteur;
        $auteurs = $auteur->select();
        //print_r($editeurs);
        return View::render('livre/create', ['editeurs' => $editeurs, 'categories' => $categories, 'auteurs' => $auteurs]);
    }

    final public function store($data)
    {
        // filtrer le prix:
        $prix_input = $_POST['prix'] ?? '';
        $prix_cleaned = trim($prix_input);
        $prix_cleaned = str_replace(',', '.', $prix_cleaned);
        $prix_float = floatval($prix_cleaned);

        $validator = new Validator;
        $validator->field('titre', $data['titre'])->onlyLetters()->min(2)->max(45);
        $validator->field('numero_pages', $data['numero_pages'], 'numero_pages')->required();
        $validator->field('edition', $data['edition'])->number()->required();
        $validator->field('prix', $prix_cleaned)->number()->required();
        $validator->field('id_editeur', $data['id_editeur'], 'id_editeur')->required();
        $validator->field('id_categorie', $data['id_categorie'], 'id_categorie')->required();
        $validator->field('id_auteur', $data['id_auteur'], 'id_auteur')->required();
        $validator->field('description', $data['description'], 'description')->required();

        if ($validator->isSuccess()) {

            $upload_dir_on_server = "/Applications/MAMP/htdocs/03_session/TP_3/mvc/public/img/";
            $db_image_prefix = "img/";
            $livreData = [];
            //print_r($_FILES["fileToUpload"]);
            // print_r($data);
            // die;
            //print("ici 1");
            if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {

                $uploadOk = 1;
                $originalFileName = basename($_FILES["fileToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
                $filename_without_ext = pathinfo($originalFileName, PATHINFO_FILENAME);
                $filename = $filename_without_ext . "." . $imageFileType;
                $target_file_path_on_server = $upload_dir_on_server . $filename;

                //  Validations de l'image 
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check === false) {
                    $errors['fileToUpload'] = "Le fichier n'est pas une image.";
                    $uploadOk = 0;
                }

                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    $errors['fileToUpload'] = "Désolé, votre fichier est trop volumineux (max 500KB).";
                    $uploadOk = 0;
                }

                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp"
                    && $imageFileType != "gif"
                ) {
                    $errors['fileToUpload'] = "Désolé, seuls les fichiers JPG, JPEG, PNG, WEBP et GIF sont autorisés.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    // $this->view('livre/create', ['errors' => $errors, 'livre' => $data]);
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_path_on_server)) {
                        $livreData = $db_image_prefix . $filename;
                    } else {
                        $errors['fileToUpload'] = "Désolé, une erreur s'est produite lors de l'upload de votre fichier.";
                    }
                }

                $data['prix'] = $prix_float;
                $data['img_url'] = $livreData;
                $livre = new Livre;
                $livre = $livre->insert($data);
                return View::redirect('livres');
            } else {
                $errors['fileToUpload'] = "Une erreur inattendue s'est produite lors de l'upload : Code d'erreur " . $_FILES["fileToUpload"]["error"];

                $editeur = new Editeur;
                $editeurs = $editeur->select();
                $categorie = new Categorie;
                $categories = $categorie->select();
                $auteur = new Auteur;
                $auteurs = $auteur->select();

                if (isset($errors['fileToUpload']) && $errors['fileToUpload'] != null) {
                    $errors['fileToUpload'] = "L'image est necessaire!";
                }
                return View::render('livre/create', ['livre' => $data, 'editeurs' => $editeurs, 'categories' => $categories, 'auteurs' => $auteurs, 'errors' => $errors]);
            }
        } else {
            $errors = $validator->getErrors();
            $editeur = new Editeur;
            $editeurs = $editeur->select();
            $categorie = new Categorie;
            $categories = $categorie->select();
            $auteur = new Auteur;
            $auteurs = $auteur->select();

            if (isset($errors['id_editeur']) && $errors['id_editeur'] != null) {
                $errors['id_editeur'] = "L'Editeur est necessaire!";
            }
            if (isset($errors['id_categorie']) && $errors['id_categorie'] != null) {
                $errors['id_categorie'] = "La Categorie est necessaire!";
            }
            if (isset($errors['id_auteur']) && $errors['id_auteur'] != null) {
                $errors['id_auteur'] = "L'Auteur est necessaire!";
            }
            if (isset($errors['numero_pages']) && $errors['numero_pages'] != null) {
                $errors['numero_pages'] = "Le numero de pages est necessaire!";
            }
            if (isset($errors['description']) && $errors['description'] != null) {
                $errors['description'] = "La description est necessaire!";
            }
            return View::render('livre/create', ['livre' => $data, 'editeurs' => $editeurs, 'categories' => $categories, 'auteurs' => $auteurs, 'errors' => $errors]);
        }
    }
}
