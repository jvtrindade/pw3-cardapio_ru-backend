<?php

class Ingredientes {
    private $id_ingrediente;
    private $descricao_ingrediente = "";
    private $calorias = "";

    function __toString(){
        return json_encode([
            "descricao_ingrediente" => $this->descricao_ingrediente,
        ]);
    }

    static function findbyPk($id){
        $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
        $consulta = $database->prepare("SELECT * FROM ingredientes WHERE id=:id");
        $consulta->execute([":id" => $id]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Ingredientes');
        return $consulta->fetch();
    }

    function setdescricao_ingrediente($valor){
        $this->descricao_ingrediente = $valor;
    }
    function getdescricao_ingrediente(){
        return $this->descricao_ingrediente;
    }
    function setCalorias($valor){
        $this->calorias = $valor;
    }
    function getCalorias(){
        return $this->calorias;
    }


function inserir(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
            $consulta = $db->prepare("INSERT INTO ingredientes (descricao, calorias) VALUES(:descricao_ingrediente, :calorias)");
            $consulta->execute([
                ':descricao_ingrediente' => $this->descricao_ingrediente,
                ':calorias' => $this->calorias
            ]);
            $consulta = $db->prepare("SELECT id FROM ingredientes ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id_ingrediente = $data['id'];

        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!");
            
        }
    }

    function alterarIngredientes(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
            $consulta = $db->prepare("UPDATE ingredientes SET descricao_ingrediente = :descricao_ingrediente, calorias = :calorias WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id_ingrediente,
                ':descricao_ingrediente' => $this->descricao_ingrediente,
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
            $consulta->execute([':id' => $this->id_ingrediente]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>