<?php

    try{
        $database = new PDO("mysql:host=localhost;dbname=RU", "root", "");
        $itens = [];
        $ingredientes = [];
        $cardapios = [];
        $nutricionistas = [];
        foreach($database->query("SELECT *,
        (SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        /*INNER JOIN
        itens_ingredientes ON itens_ingredientes.id_item = itens.id
        INNER JOIN
        ingredientes ON ingredientes.id = itens_ingredientes.id_ingrediente*/
        WHERE ingredientes.id = itens.id)
        FROM itens")
        as $item){
            $itens[] = [
                "id" => $item["id"],
                "descricao" => $item["descricao"],
                "calorias_item" => $item["calorias_item"]
            ];
        }
        foreach($database->query("SELECT * FROM ingredientes")
        as $ingrediente){
            $ingredientes[] = [
                "id" => $ingrediente["id"],
                "descricao" => $ingrediente["descricao"],
                "calorias" => $ingrediente["calorias"]
            ];
        }
        foreach($database->query("SELECT * FROM cardapios")
        as $cardapio){
            $cardapios[] = [
                "id" => $cardapio["id"],
                "dia" => $cardapio["dia"],
                "tipo" => $cardapio["tipo"],
            ];
        }
        foreach($database->query("SELECT * FROM nutricionistas")
        as $nutricionista){
            $nutricionistas [] = [
                "crn" => $nutricionista["crn"],
                "nome" => $nutricionista["nome"]
            ];
        }
        print json_encode($nutricionistas);
        print json_encode($cardapios);
        print json_encode($ingredientes);
        print json_encode($itens);
    }
    catch(PDOException $e){
        die($e->getMessage());
    }

?>