<?php

//require "class.Itens.php";
//require "class.Ingrediente.php";

class Itens_Ingredientes extends Itens{
    private $id_item;
    private $id_ingredientes = "";

    /*static function findbyPk($id){
        $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
        $consulta = $database->prepare("SELECT * FROM itens WHERE id=:id");
        $consulta->execute([":id" => $id]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Itens');
        return $consulta->fetch();
    }*/

    function setId_Item($valor){
        $this->id_item = $valor;
    }
    function getId_Item(){
        return $this->id_item;
    }
    function setId_Ingredientes($valor){
        $this->id_ingredientes = $valor;
    }
    function getId_Ingredientes(){
        return $this->id_ingredientes;
    }


    function print_parent(){
        echo $this->id;
    }
function inserirItens_Ingredientes(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("INSERT INTO itens_ingredientes (id_item, id_ingredientes) VALUES (:id_item, :id_ingredientes)");
            $consulta->execute([
                ':id_item' => $this->id_item,
                ':id_ingredientes' => $this->id_ingredientes,
            ]);

        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!");
            
        }
    }

    function alterarItens_Ingredientes(){ //preciso ver o WHERE
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("UPDATE itens_ingredientes SET id_item = :id_item, id_ingredientes = :id_ingredientes WHERE id= :id");
            $consulta->execute([
                ':id_item' => $this->id_item,
                ':id_ingredientes' => $this->id_ingredientes
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function removerItens_Ingredientes(){ //preciso ver o WHERE
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("DELETE FROM itens_ingredientes WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>