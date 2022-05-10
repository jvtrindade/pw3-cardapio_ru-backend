<?php

    try{
        $database = new PDO("mysql:host=localhost;dbname=RU", "root", "");
        $itens = [];
        $ingredientes = [];
        $cardapios = [];
        $nutricionistas = [];
        foreach($database->query("SELECT * FROM itens")
        as $item){
            $itens[] = [
                "id" => $item["id"],
                "descricao" => $item["descricao"]
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
    }
    catch(PDOException $e){
        die($e->getMessage());
    }

?>