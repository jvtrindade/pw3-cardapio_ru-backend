<?php

    class Cardapio{

        private $id;
        private $dia = "";
        private $tipo = "";

        function __toString(){
            return json_encode([
                "dia" => $this->dia,
                "tipo" => $this->tipo,
            ]);
        }

        static function findbyPk($id){
            $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $database->prepare("SELECT * FROM cardapios WHERE id=:id");
            $consulta->execute([":id => $id"]);
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'Cardapios');
            return $consulta->fetch();
        }

        function setDia($valor){
            $this->dia = $valor;
        }

        function getDia(){
            return $this->dia;
        }

        function setTipo($valor){
            $this->tipo = $valor;
        }

        function getTipo(){
            return $this->tipo;
        }
    

    function inserirCardapio(){
        try{
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("INSERT INTO cardapios(dia, tipo) VALUES (:dia,:tipo");
            $consulta->execute([
                ':dia' => $this->dia,
                ':tipo' => $this->tipo
            ]);

            $consulta = $db->prepare("SELECT id FROM cardapios ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];
        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!");
        }
    }

    function alterarCardapio(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=pw3", "root", "");
            $consulta = $db->prepare("UPDATE cardapios SET dia = :dia, tipo = :tipo WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':dia' => $this->dia,
                ':tipo' => $this->tipo
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        
    }

    function removerCardapio(){
        try {
            $db = new PDO("mysql;host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("DELETE FROM cardapios WHERE id=:id");
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}

?>