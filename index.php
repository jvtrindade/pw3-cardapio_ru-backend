<?php // precisa de vários foreach ou só um?

    try{
        $database = new PDO("mysql:host=localhost;dbname=ru", "root", "");
        $itens = [];
        $ingredientes = [];
        $cardapios = [];
        $nutricionistas = [];
        $usuarios = [];
        
        foreach($database->query("SELECT *, (SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        WHERE itens_ingredientes.id_item = 13
        INNER JOIN itens_ingredientes
        ON itens_ingredientes.id_ingrediente = ingredientes.id) FROM itens") as $item){
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
                "dia" => $cardapio["dia"],
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
                "id" => $usuarios["id"],
                "nome" => $usuarios["nome"],
                "senha" => $usuarios["senha"],
                "email" => $usuarios["email"]
            ];
        }
        print json_encode($itens);
        print json_encode($cardapios);
        print json_encode($ingredientes);
        print json_encode($nutricionistas);
    }
    catch (PDOException $e){
        die($e->getMessage());
    }

?>