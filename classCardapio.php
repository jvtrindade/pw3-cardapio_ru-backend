<?php
    require_once dirname(__FILE__). "/interface.CRUD.php";
    require __DIR__ . '/vendor/autoload.php';

    use Dotenv\Dotenv;

    /* $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load(); */

    class Cardapio implements CRUD{

        private $id;
        private $data;
        private $tipo;
        private $itens = [];
        private $id_nutricionista;

        function __toString(){
            return json_encode([
                "id" => $this->id,
                "data" => $this->data,
                "tipo" => $this->tipo,
                "itens" => $this->itens,
                "id_nutricionista" => $this->id_nutricionista
            ]);
        }

        static function findbyPk($id){
            $database = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
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

        function setItens($valor){
            foreach($valor as $item){
                $this->itens[] = +$item;
            }
        }

        function setId_nutricionista($valor){
            $this->id_nutricionista = $valor;
        }

        function getId_nutricionista(){
            return $this->id_nutricionista;
        }
    

    function inserir(){
        $db = null;
        try{
            $db = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $db->query("START TRANSACTION;");

            $consulta = $db->prepare("INSERT INTO cardapios(dia, tipo, id_nutricionista) VALUES (:dia, :tipo, :id_nutricionista");

            $consulta->execute([
                ':dia' => $this->data,
                ':tipo' => $this->tipo,
                ':id_nutricionista' => $this->id_nutricionista
            ]);

            $consulta = $db->prepare("SELECT id FROM cardapios ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $dados = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $dados['id'];

            foreach($this->itens as $idItem){
                $consulta = $db->prepare("INSERT INTO itens_cardapios (id_item, id_cardapio) VALUES (:idItem, :idCardapio);");
                $consulta->execute([
                    ':idItem' => $idItem,
                    ':idCardapio' => $this->id
                ]);
            }

            $consulta = $db->prepare("INSERT INTO nutricionistas_cardapios (id_nutricionista, id_cardapio) VALUES (:idNutricionista, :idCardapio);");
            $consulta->execute([
                ':idNutricionista' => $this->id_nutricionista,
                ':idCardapio' => $this->id
            ]);
            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            throw new Exception("Ocorreu um erro interno");
        }
    }

    function alterar(){
        $db = null;
        try {
            $db = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $db->query("START TRANSACTION;");
            $consulta = $db->prepare("UPDATE cardapios SET dia = :dia, tipo = :tipo, id_nutricionsita = :id_nutricionista WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':dia' => $this->data,
                ':tipo' => $this->tipo,
                ':id_nutricionista' => $this->id_nutricionista
            ]);

            $consulta = $db->prepare("DELETE FROM itens_cardapios WHERE id_cardapio = :idCardapio");
            $consulta->execute([':idCalendario' => $this->id]);

            foreach($this->itens as $idItem){
                $consulta = $db->prepare("INSERT INTO itens_cardapios (id_item, id_cardapio) values (:idItem, :idCardapio);");
                $consulta->execute([
                    ":idItem" => $idItem,
                    ":idCardapio" => $this->id
                ]);
            }

            $consulta = $db->prepare("DELETE FROM nutricionistas_cardapios WHERE id_cardapio = :idCardapio");
            $consulta->execute([':idCalendario' => $this->id]);
            $consulta = $db->prepare("INSERT INTO nutricionistas_cardapios (id_nutricionistas, id_cardapio) values (:idNutricionista, :idCardapio);");
            $consulta->execute([
                ":idNutricionista" => $this->id_nutricionista,
                ":idCardapio" => $this->id
            ]);

            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
        
    }

    function remover(){
        $db = null;
        try {
            $db = new PDO("mysql;host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $db->query("START TRANSACTION;");

            $consulta = $db->prepare("DELETE FROM itens_cardapios WHERE id_cardapio = :idCardapio;");
            $consulta->execute([':idCalendario' => $this->id]);

            $consulta = $db->prepare("DELETE FROM cardapios WHERE id=:id");
            $consulta->execute([':id' => $this->id]);

            $consulta = $db->prepare("DELETE FROM nutricionistas_cardapios WHERE id_cardapio = :idCardapio;");
            $consulta->execute([':idCalendario' => $this->id]);
            $db->query("COMMIT;");
        }catch(PDOException $e){
            $db->query("ROLLBACK;");
            die($e->getMessage());
        }
    }

    function mostrarCardapio(){

        $db = new PDO("mysql;host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    
        if($this->id !== null && $this->id != ''){
    
          $sql = 'SELECT * FROM cardapios WHERE id = :id';
    
        }else if($this->data !== null && $this->data != ''){
    
             $sql = 'SELECT * FROM cardapios
                   WHERE dia = :dia';
    
        }else{ 
     
        $sql = 'SELECT * FROM cardapios'; 
     
        } 
     
        $resultado = $db->prepare($sql); 
    
        if($this->id !== null && $this->id != ''){ 
     
        $resultado->bindValue(':id', $this->id); 
    
        }
    
        if($this->data !== null && $this->data != ''){ 
     
         $resultado->bindValue(':dia', $this->data); 
        } 
    
        $resultado->execute(); 
    
        return $resultado->fetchAll(PDO::FETCH_ASSOC); 
     
    }
    
}



    

?>