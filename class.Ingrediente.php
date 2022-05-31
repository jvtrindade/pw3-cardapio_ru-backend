<?php

class Ingrediente {
    private $id;
    private $descricao = "";
    private $calorias = "";

    function __toString(){
        return json_encode([
            "descricao" => $this->descricao,
            "calorias" => $this->calorias,
        ]);
    }

    static function findbyPk($id){
        $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
        $consulta = $database->prepare("SELECT * FROM ingredientes WHERE id=:id");
        $consulta->execute([":id" => $id]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Ingrediente');
        return $consulta->fetch();
    }

    function setDescricao($valor){
        $this->descricao = $valor;
    }
    function getDescricao(){
        return $this->descricao;
    }
    function setCalorias($valor){
        $this->calorias = $valor;
    }
    function getCalorias($valor){
        return $this->calorias;
    }


function inserirIngredientes(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
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
            $db = new PDO("mysql:host=localhost;dbname=pw3", "aluno", "aluno");
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
            $db = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
            $consulta = $db->prepare("DELETE FROM ingredientes WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>