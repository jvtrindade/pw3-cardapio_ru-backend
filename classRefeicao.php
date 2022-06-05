<?php

    class Refeicao{
        private $id;

        static function findbyPk($id){
            $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $database->prepare("SELECT * FROM refeicao WHERE id =:id");
            $consulta->execute([":id" => $id]);
            $consulta->setFetchMode(PDO::FETCH_CLASS, 'Refeicao');
            return $consulta->fetch();
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
                $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
                $consulta = $database->prepare("DELETE FROM nutricionistas where crn = :crn");
                $consulta->execute([":crn" => $this->crn]);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }

?>