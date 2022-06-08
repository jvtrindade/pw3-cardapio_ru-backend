<?php

    class Cardapio implements CRUD{

        const DBNAME = "ru";
        const USER = "aluno";
        const PASSWORD = "aluno";

        private $id;
        private $data = "";
        private $tipo = "";
        private $crn_nutricionista = "";

        function __toString(){
            return json_encode([
                "data" => $this->data,
                "tipo" => $this->tipo,
                "crn_nutricionista" => $this->crn_nutricionista
            ]);
        }

        static function findbyPk($id){
            $database = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $consulta = $database->prepare("SELECT * FROM cardapios WHERE id=:id");
            $consulta->execute([":id => $id"]);
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'Cardapios');
            return $consulta->fetch();
        }

        function setData($valor){
            $this->data = $valor;
        }

        function getData(){
            return $this->data;
        }

        function setTipo($valor){
            $this->tipo = $valor;
        }

        function getTipo(){
            return $this->tipo;
        }

        function setCrn_nutricionista($valor){
            $this->crn_nutricionista = $valor;
        }

        function getCrn_nutricionista(){
            return $this->crn_nutricionista;
        }
    

    function inserir(){
        try{
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $consulta = $db->prepare("INSERT INTO cardapios(dia, tipo, crn_nutricionista) VALUES (:dia, :tipo, :crn_nutricionista");
            $consulta->execute([
                ':dia' => $this->data,
                ':tipo' => $this->tipo,
                ':crn_nutricionista' => $this->crn_nutricionista
            ]);

            $consulta = $db->prepare("SELECT id FROM cardapios ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];
        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!" . $e);
        }
    }

    function alterar(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $consulta = $db->prepare("UPDATE cardapios SET dia = :dia, tipo = :tipo, crn_nutricionsita = :crn_nutricionista WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':dia' => $this->data,
                ':tipo' => $this->tipo,
                ':crn_nutricionista' => $this->crn_nutricionista
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        
    }

    function remover(){
        try {
            $db = new PDO("mysql;host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $consulta = $db->prepare("DELETE FROM cardapios WHERE id=:id");
            $consulta->execute([
                ':id' => $this->id
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

?>