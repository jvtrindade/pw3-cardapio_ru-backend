<?php
require_once dirname(__FILE__). "/interface.CRUD.php";
require __DIR__ . '/vendor/autoload.php';

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

class Itens implements CRUD {

    private $id;
    private $descricao = "";
    private $ingredientes = [];
    private $calorias_totais;

    function __toString(){
        return json_encode([
            "id" => $this->id,
            "descricao" => $this->descricao,
            'ingredientes' => $this->ingredientes
        ]);
    }

    static function findbyPk($id){
        // $database = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $database = new PDO("mysql:host=localhost;dbname=RU", "root", "");
        $consulta = $database->prepare("SELECT * FROM itens WHERE id=:id");
        $consulta->execute([":id" => $id]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, 'Itens');
        return $consulta->fetch();
    }

    function setDescricao($valor){
        $this->descricao = $valor;
    }
    function getDescricao(){
        return $this->descricao;
    }

    function setIngredientes($ingredientes){
        foreach($ingredientes as $ingrediente) {
            $this->ingredientes[] = +$ingrediente;
        }
    }

    function inserir(){
        $db = null;
        try {
            // $db = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $db = new PDO("mysql:host=localhost;dbname=RU", "root", "");
            $db->query("START TRANSACTION;");

            $consulta = $db->prepare("INSERT INTO itens (descricao) VALUES (:descricao)");
            
            $consulta->execute([':descricao' => $this->descricao]);
            $consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];

            foreach($this->ingredientes as $idIngrediente) {
                $consulta = $db->prepare("INSERT INTO itens_ingredientes (id_item, id_ingrediente) values (:idItem, :idIngrediente);");
                $consulta->execute([
                    ':idItem' => $this->id,
                    ':idIngrediente' => $idIngrediente
                ]);
            }

            $consulta = $db->prepare("SELECT SUM(calorias) AS calorias_totais FROM ingredientes INNER JOIN itens_ingrediente ON itens_ingredientes.id_item = itens.id WHERE id_item = :id");
            $consulta->execute([
                ":id" => $this->id
            ]);
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->calorias_totais = $data['calorias_totais'];

            $consulta = $db->prepare("UPDATE itens SET calorias_totais = :calorias_totais WHERE id = :id");
            $consulta->execute([
                ":id" => $this->id,
                ":calorias_totais" => $this->calorias_totais
            ]); // se não funcionar, talvez tenhamos q tirar o NOT NULL das calorias_totais
            $db->query("COMMIT;");

        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            throw new Exception("Ocorreu um erro interno" . $e);
        }
    }

    function alterar(){
        $db = null;
        try {
            // $db = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $db = new PDO("mysql:host=localhost;dbname=RU", "root", "");
            $db->query("START TRANSACTION;");
            $consulta = $db->prepare("UPDATE itens SET descricao = :descricao WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':descricao' => $this->descricao
            ]);

            $consulta = $db->prepare("DELETE FROM itens_ingredientes WHERE id_item = :idItem;"); // acho q esse trecho n precisa, pois o ID segue o msm
            $consulta->execute([':idItem' => $this->id]);

            //throw new Exception("erro");
            foreach($this->ingredientes as $idIngrediente) {
                $consulta = $db->prepare("INSERT INTO itens_ingredientes (id_item, id_ingrediente) values (:idItem, :idIngrediente);");
                $consulta->execute([
                    ':idItem' => $this->id,
                    ':idIngrediente' => $idIngrediente
                ]);
            }

            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
    }

    function remover(){
        $db = null;
        try {
            // $db = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $db = new PDO("mysql:host=localhost;dbname=RU", "root", "");
            $db->query("START TRANSACTION;");

            $consulta = $db->prepare("DELETE FROM itens_ingredientes WHERE id_item = :idItem;");
            $consulta->execute([':idItem' => $this->id]);

            $consulta = $db->prepare("DELETE FROM itens WHERE id= :id");
            $consulta->execute([':id' => $this->id]);

            $consulta = $db->prepare("DELETE FROM itens_cardapios WHERE id_item = :idItem;");
            $consulta->execute([':idItem' => $this->id]);
            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
    }
}
?>