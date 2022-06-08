<?php
require_once dirname(__FILE__). "/interface.CRUD.php";

class Itens implements CRUD {

    const DBNAME = "ru";
    const USER = "aluno";
    const PASSWORD = "aluno";

    private $id;
    private $descricao = "";
    private $ingredientes = [];

    function __toString(){
        return json_encode([
            "id" => $this->id,
            "descricao" => $this->descricao,
            'ingredientes' => $this->ingredientes
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

    function setIngredientes($ingredientes){
        foreach($ingredientes as $ingrediente) {
            $this->ingredientes[] = +$ingrediente;
        }
    }

    function inserir(){
        $db = null;
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $db->query("START TRANSACTION;");
            
            $consulta = $db->prepare("INSERT INTO itens (descricao) VALUES (:descricao)");
            
            $consulta->execute([':descricao' => $this->descricao]);
            $consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];

            foreach($this->ingredientes as $idIngrdiente) {
                $consulta = $db->prepare("INSERT INTO itens_ingredientes (id_item, id_ingrediente) values (:idItem, :idIngrediente);");
                $consulta->execute([
                    ':idItem' => $this->id,
                    ':idIngrediente' => $idIngrediente
                ]);
            }
            $db->query("COMMIT;");

        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            throw new Exception("Ocorreu um erro interno");
        }
    }

    function alterar(){
        $db = null;
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $db->query("START TRANSACTION;");
            $consulta = $db->prepare("UPDATE itens SET descricao = :descricao WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':descricao' => $this->descricao
            ]);

            $consulta = $db->prepare("DELETE FROM itens_ingredientes WHERE id_item = :idItem;");
            $consulta->execute([':idItem' => $this->id]);

            //throw new Exception("erro");
            foreach($this->ingredientes as $idIngrdiente) {
                $consulta = $db->prepare("INSERT INTO itens_ingredientes (id_item, id_ingrediente) values (:idItem, :idIngrediente);");
                $consulta->execute([
                    ':idItem' => $this->id,
                    ':idIngrediente' => $idIngrdiente
                ]);
            }

            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
    }

    function remover(){
        $db = null;
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $db->query("START TRANSACTION;");

            $consulta = $db->prepare("DELETE FROM itens_ingredientes WHERE id_item = :idItem;");
            $consulta->execute([':idItem' => $this->id]);

            $consulta = $db->prepare("DELETE FROM itens WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
    }
}
?>