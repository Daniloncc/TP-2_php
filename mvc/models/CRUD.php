<?php

namespace App\Models;

abstract class CRUD extends \PDO
{
    final public function __construct()
    {
        parent::__construct('mysql:host=localhost;dbname=librairie;port=8888;charset=utf8', 'root', 'root');

        // parent::__construct('mysql:host=localhost;dbname=e2495746;port=8888;charset=utf8', 'e2495746', 'y5TEKKmOhVowqRpygXoN');
    }

    final public function insert($data)
    {
        // print_r($data);
        // die;
        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);
        // mettre le mot cle en mode string separe par vigule
        // Array ( [nom] => Nunes Costa e Costa [prenom] => Danilo [adresse] => Rua Doutor Augusto Lopes Pontes [telephone] => 11998090203 [courriel] => dancc86@gmail.com )
        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":" . implode(", :",  array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue);";
        $stmt = $this->prepare($sql);


        foreach ($data as $key => $value) {
            // (':nom', 'Alice'); associe la key a la valeur
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return $this->lastInsertId();
        } else {
            return false;
        }
    }

    final public function selectId($valueId)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        // Eviter des injections SQL et associer le nom avec la valeur
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $valueId);
        //faire la requete et retourne un booleen mais avec un contenu "cache" qui cest le retour de la requete
        $stmt->execute();
        // pour voir son contenu, ligne par ligne, s'il y en a
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // confirmer - chatGPT dit que le rowCount() est mieux pour INSERT, DELETE, UPDATE, pour select c'est mieux : $data = $stmt->fetchAll(PDO::FETCH_ASSOC); pour retourner la quantite de lignes
        $count = count($rows);
        if ($count == 1) {
            return $rows[0];
        } else {
            return false;
        }
    }

    final public function unique($field, $value)
    {
        $sql = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    final public function select($field = null, $order = 'asc')
    {
        if ($field == null) {
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";

        if ($stmt = $this->query($sql)) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    final public function update($data, $id)
    {


        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);
        $fieldName = null;
        foreach ($data as $key => $value) {
            $fieldName .= "$key = :$key, ";
        }
        $fieldName = rtrim($fieldName, ', ');
        $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey";
        // return $sql;
        $data[$this->primaryKey] = $id;
        $stmt = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    final public function delete($data)
    {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $data);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
