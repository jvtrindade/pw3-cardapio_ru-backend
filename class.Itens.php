<?php

class Itens {

    const DBNAME = "ru";
    const USER = "root";
    const PASSWORD = "";

    protected $id;
    protected $descricao = "";

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


function inserir(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            //$consulta = $db->prepare("BEGIN TRANSACTION;");
            $consulta = $db->prepare("INSERT INTO itens(descricao) VALUES (:descricao)");
            // ////////SELECT
            // INSERT INTO Itens_Ingredientes (id_item, id_ingrediente) VALUES ();
            // commit;
            // ");
            $consulta->execute([
                ':descricao' => $this->descricao
            ]);
            $consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);

            var_dump($data);
            die();
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