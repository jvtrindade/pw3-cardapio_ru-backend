<?php
    require_once dirname(__FILE__). "/interface.CRUD.php";
    require_once dirname(__FILE__) . "/class.DB.php";
    require __DIR__ . '/vendor/autoload.php';

    class Nutricionista{

        private $id;
        private $crn = "";
        private $nome = "";

        function __toString(){
            return json_encode([
                "id" => $this->id,
                "crn" => $this->crn,
                "nome" => $this->nome
            ]);
        }

        static function findbyPk($id){
            $database = DB::getInstance();
            $consulta = $database->prepare("SELECT * FROM nutricionistas WHERE id=:id");
            $consulta->execute([":id" => $id]);
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
                $db = DB::getInstance();
                $consulta = $db->prepare("INSERT INTO nutricionistas(crn, nome) VALUES (:crn, :nome)");
                $consulta->execute([
                    ':crn' => $this->crn,
                    ':nome' => $this->nome
                ]);
                $consulta = $db->prepare("SELECT id FROM nutricionistas ORDER BY id DESC LIMIT 1");
                $consulta->execute();
                $data = $consulta->fetch(PDO::FETCH_ASSOC);
                $this->id = $data['id'];
            }catch(PDOException $e){
                throw new Exception("Ocorreu um erro interno");
                
            }
        }

        function alterar(){
            try{
                $db = DB::getInstance();
                $consulta = $db->prepare("UPDATE nutricionistas SET crn = :crn, nome = :nome WHERE crn = :crn");
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
            $db = null;
            try{
                $db = DB::getInstance();
                $db->query("START TRANSACTION;");
                $consulta = $db->prepare("DELETE FROM nutricionistas where id = :id");
                $consulta->execute([":id" => $this->id]);

                $consulta = $db->prepare("DELETE FROM nutricionistas_cardapios where id_nutricionista = :id");
                $consulta->execute([":id" => $this->id]);
                $db->query("COMMIT;");
            }
            catch(PDOException $e){
                $db->query("ROLLBACK;");
                die($e->getMessage());
            }
        }
    }

?>