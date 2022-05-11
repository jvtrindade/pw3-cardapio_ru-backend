<?php

class Ingrediente {
    private $id;
    private $descricao = "";
    private $calorias = "";


function inserirIngredientes(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("INSERT INTO ingredientes(descricao, calorias) VALUES(:descricao,:calorias)");
            $consulta->execute([
                ':descricao' => $this->descricao,
                ':calorias' => $this->calorias
            ]);
            $consulta = $db->prepare("SELECT id FROM ingredientes ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];

        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!");
            
        }
    }

    function alterarIngredientes(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=pw3", "root", "");
            $consulta = $db->prepare("UPDATE intredientes SET descricao = :descricao, calorias = :calorias WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':descricao' => $this->descricao,
                ':calorias' => $this->calorias
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function removerIngredientes(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("DELETE FROM ingredientes WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>