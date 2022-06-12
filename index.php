<?php // precisa de vários foreach ou só um?

require __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

/* $dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load(); */

/* $USER = $_ENV['DB_USER'];
$PASSWORD = $_ENV['DB_PASSWORD'];
$DBNAME = $_ENV['DB_NAME']; */

$DBNAME = 'ru';
$USER = 'root';
$PASSWORD = '';



    try{
        $database =new PDO("mysql:host=localhost;dbname=" . $DBNAME, $USER, $PASSWORD);
        $itens = [];
        $ingredientes = [];
        $cardapios = [];
        $nutricionistas = [];
        $usuarios = [];
        
        foreach($database->query("SELECT *, (SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        INNER JOIN itens_ingredientes
        ON  itens_ingredientes.id_ingrediente = ingredientes.id
        INNER JOIN itens 
        ON itens.id = itens_ingredientes.id_item
        WHERE itens.id = itens_ingredientes.id_item 
        ) FROM itens") as $item){
            $itens[] = [
                "id" => $item["id"],
                "descricao" => $item["descricao"],
                "calorias_item" => $item["calorias_item"]
            ];
        }

        /*foreach($database->query("SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        WHERE ingredientes.id = itens.id_item") as $item){
            $itens[] = [
                "calorias_item" => $item["calorias_item"]
            ];
        }*/

        foreach($database->query("SELECT * FROM ingredientes") as $ingrediente){
            $ingredientes[] = [
                "id" => $ingrediente["id"],
                "descricao" => $ingrediente["descricao"],
                "calorias" => $ingrediente["calorias"]
            ];
        }
        foreach($database->query("SELECT * FROM cardapios") as $cardapio){
            $cardapios[] = [
                "id" => $cardapio["id"],
                "dia" => $cardapio["data"],
                "tipo" => $cardapio["tipo"] // ver se tem um if pros números
            ];
        }
        foreach($database->query("SELECT * FROM nutricionistas") as $nutricionista){
            $nutricionistas[] = [
                "crn" => $nutricionista["crn"],
                "nome" => $nutricionista["nome"]
            ];
        }
        foreach($database->query("SELECT * FROM usuarios") as $usuario){ //acho q não precisa
            $usuarios [] = [
                "id" => $usuario["id"],
                "nome" => $usuario["nome"],
                "senha" => $usuario["senha"],
                "email" => $usuario["email"]
            ];
        }

        $obj = [
            'itens' => $itens,
            'cardapios' => $cardapios,
            'ingredientes'=> $ingredientes,
            'nutricionistas' => $nutricionistas
        ];

        // print json_encode($itens);
        // print json_encode($cardapios);
        // print json_encode($ingredientes);
        // print json_encode($nutricionistas);

        print json_encode($obj);
    }
    catch (PDOException $e){
        die($e->getMessage());
    }

?>