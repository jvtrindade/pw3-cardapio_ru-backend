<?php

    class Nutricionista{

        const DBNAME = "ru";
        const USER = "aluno";
        const PASSWORD = "aluno";

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
            try {
                $db = new PDO("mysql:host=localhost;dbname=" . SELF::DBNAME, SELF::USER, SELF::PASSWORD);
                //$consulta = $db->prepare("BEGIN TRANSACTION;");
                $consulta = $db->prepare("INSERT INTO nutricionistas(crn, nome) VALUES (:crn, :nome)");
                // ////////SELECT
                // INSERT INTO Itens_Ingredientes (id_item, id_ingrediente) VALUES ();
                // commit;
                // ");
                $consulta->execute([
                    ':crn' => $this->crn,
                    ':nome' => $this->nome
                ]);
                //$consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
                //$consulta->execute();
                //$data = $consulta->fetch(PDO::FETCH_ASSOC);
                //$this->id = $data['id'];
    
            }catch(PDOException $e){
                throw new Exception("Ocorreu um erro interno");
                //$consultar = $db->prepare("Rollback;");
                //$consultar->execute();
                
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