<?php

    class Nutricionista{

        const DBNAME = "ru";
        const USER = "root";
        const PASSWORD = "";

        private $crn = "";
        private $nome = "";

        function __toString(){
            return json_encode([
                "crn" => $this->crn,
                "nome" => $this->nome,
            ]);
        }

        static function findbyPk($crn){
            $database = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
            $consulta = $database->prepare("SELECT * FROM nutricionistas WHERE crn=:crn");
            $consulta->execute([":crn" => $crn]);
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'Nutricionista');
            return $consulta->fetch();
        }

        function setCRN($valor){
            $this->crn = $valor;
        }
        function getCRN(){
            return $this->crn;
        }
        function setNome($valor){
            $this->nome = $valor;
        }
        function getNome(){
            return $this->nome;
        }

        function inserir(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
                $consulta = $database->prepare("INSERT INTO nutricionistas(crn, nome) VALUES (:crn, :nome");
                $consulta->execute([
                    ":crn" => $this->crn,
                    ":nome" => $this->nome
                ]);
                $data = $consulta->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                var_dump($data);
                throw new Exception("Ocorreu um erro interno");
            }
        }

        function alterar(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
                $consulta = $database->prepare("UPDATE nutricionistas SET crn = :crn, nome = :nome WHERE crn = :crn");
                $consulta->execute([
                    ":crn" => $this->crn,
                    ":nome" => $this->nome
                ]);
            }
            catch(PDOException $e){
                die ($e->getMessage());
            }
        }

        function remover(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
                $consulta = $database->prepare("DELETE FROM nutricionistas where crn = :crn");
                $consulta->execute([":crn" => $this->crn]);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }

?>