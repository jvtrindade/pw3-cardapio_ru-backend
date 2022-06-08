<?php

class Itens {

    const DBNAME = "ru";
    const USER = "root";
    const PASSWORD = "";

    private $id;
    private $descricao = "";
    private $id_item = "";
    private $id_ingrediente = "";

    function __toString(){
        return json_encode([
            "descricao" => $this->descricao,
        ]);
    }

    static function findbyPk($id){
        $database = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
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

    function setId_item($valor){
        $this->id_item = $valor;
    }
    function getId_item(){
        return $this->id_item;
    }

    function setId_ingrediente($valor){
        $this->id_item = $valor;
    }
    function getId_ingrediente(){
        return $this->id_ingrediente;
    }


function inserir(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            //$consulta = $db->prepare("BEGIN TRANSACTION;");
            $consulta = $db->prepare("INSERT INTO itens (descricao) VALUES (:descricao)");
            // "START TRANSACTION;
            // SELECT id FROM itens ORDER BY id DESC LIMIT 1
            // INSERT INTO itens (descricao) VALUES (:descricao)
            // INSERT INTO Itens_Ingredientes (id_item, id_ingrediente) VALUES (:id_item, :id_ingrediente);
            // COMMIT;");
            $consulta->execute([
                ':descricao' => $this->descricao,
                //':id_item' => $this->id_item,
                //':id_ingrediente' => $this->id_ingrediente
            ]);
            $consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];

        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno");
            //$consultar = $db->prepare("Rollback;");
            //$consultar->execute();
            
        }
    }

    function alterarItens(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
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
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $consulta = $db->prepare("DELETE FROM itens WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>