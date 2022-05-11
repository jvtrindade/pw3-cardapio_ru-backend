<?php

    class Nutricionistas{
        private $crn;
        private $nome = "";

        function __toString(){
            return json_encode([
                "crn" => $this->id,
                "nome" => $this->nome,
            ]);
        }

        function inserir(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
                $consulta = $database->prepare("INSERT INTO nutricionistas(crn, nome) VALUES (:crn, :nome");
                $consulta->execute([
                    ":crn" => $this->crn,
                    ":nome" => $this->nome
                ]);
            }
            catch(PDOException $e){
                throw new Exception("Ocorreu um erro interno");
            }
        }

        function alterar(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
                $consulta = $database->prepare("UPDATE pessoas SET crn = :crn, nome = :nome");
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
                $database = new PDO("");
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }

    }

?>