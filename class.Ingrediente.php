<?php
require_once dirname(__FILE__). "/interface.CRUD.php";
require __DIR__ . '/vendor/autoload.php';
require_once dirname(__FILE__) . "/class.DB.php";

class Ingredientes implements CRUD{

    private $id;
    private $descricao = "";
    private $calorias = "";

    function __toString(){
        return json_encode([
            "descricao_ingrediente" => $this->descricao,
        ]);
    }

    static function findbyPk($id){
        $database = DB::getInstance();
        $consulta = $database->prepare("SELECT * FROM ingredientes WHERE id=:id");
        $consulta->execute([":id" => $id]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Ingredientes');
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
    function getCalorias(){
        return $this->calorias;
    }
    function setId($valor){
        $this->id = $valor;
    }
    function getId(){
        return $this->id;
    }


function inserir(){
    $db = null;
        try {
            $db = DB::getInstance();
            $consulta = $db->prepare("INSERT INTO ingredientes (descricao, calorias) VALUES(:descricao_ingrediente, :calorias)");
            $consulta->execute([
                ':descricao_ingrediente' => $this->descricao,
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

    function alterar(){
        $db = null;
        try {
            $db = DB::getInstance();
            $consulta = $db->prepare("UPDATE ingredientes SET descricao = :descricao_ingrediente, calorias = :calorias WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':descricao_ingrediente' => $this->descricao,
                ':calorias' => $this->calorias
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function remover(){
        $db = null;
        try {
            $db = DB::getInstance();
            $db->query("START TRANSACTION;");
            $consulta = $db->prepare("DELETE FROM ingredientes WHERE id= :id");
            $consulta->execute([':id' => $this->id]);

            $consulta = $db->prepare("DELETE FROM itens_ingredientes WHERE id_ingrediente= :id");
            $consulta->execute([':id' => $this->id]);
            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
    }
}
    
    ?>