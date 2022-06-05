<?php

class Itens {
    private $id;
    private $descricao = "";

    function __toString(){
        return json_encode([
            "descricao" => $this->descricao,
        ]);
    }

    static function findbyPk($id){
        $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
        $consulta = $database->prepare("SELECT * FROM itens WHERE id=:id");
        $consulta->execute([":id" => $id]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Itens');
        return $consulta->fetch();
    }

    function setDescricao($valor){
        $this->descricao = $valor;
    }
    function getDescricao(){
        return $this->descricao;
    }


function inserir(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("INSERT INTO itens(descricao) VALUES(:descricao)");
            $consulta->execute([
                ':descricao' => $this->descricao
            ]);
            $consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];

        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!");
            
        }
    }

    function alterarItens(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=pw3", "root", "");
            $consulta = $db->prepare("UPDATE itens SET descricao = :descricao WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':descricao' => $this->descricao
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function removerItens(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("DELETE FROM itens WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>