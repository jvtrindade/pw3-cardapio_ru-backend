<?php

    try{
        $database =new PDO("mysql:host=localhost;dbname=RU", "root", "");
        $itens = [];
        $ingredientes = [];
        $cardapios = [];
        $nutricionistas = [];
        $usuarios = [];
        
        foreach($database->query("SELECT *, (SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        WHERE ingredientes.id = itens.id_item) FROM itens") as $item){
            $itens[] = [
                "id" => $item["id"],
                "descricao" => $item["descricao"],
                "calorias_item" => $item["calorias_item"]
            ];
        }

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
                "tipo" => $cardapio["tipo"]
            ];
        }
        foreach($database->query("SELECT * FROM nutricionistas") as $nutricionista){
            $nutricionistas[] = [
                "crn" => $nutricionista["crn"],
                "nome" => $nutricionista["nome"]
            ];
        }
        foreach($database->query("SELECT * FROM usuarios") as $usuario){
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