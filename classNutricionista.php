<?php

    class Nutricionista{
        private $crn = "";
        private $nome = "";

        function __toString(){
            return json_encode([
                "crn" => $this->crn,
                "nome" => $this->nome,
            ]);
        }

        static function findbyPk($crn){
            $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
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
                $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
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
                $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
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
                $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
                $consulta = $database->prepare("DELETE FROM nutricionistas where crn = :crn");
                $consulta->execute([":crn" => $this->crn]);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }

?>