<?php

    try{
<<<<<<< HEAD
        $database =new PDO("mysql:host=localhost;dbname=RU", "root", "");
=======
        $database = new PDO("mysql:host=localhost;dbname=RU", "root", "");
>>>>>>> 36b4e8c9931c5416c2fdc83a0e817486a7885208
        $itens = [];
        $ingredientes = [];
        $cardapios = [];
        $nutricionistas = [];
<<<<<<< HEAD
        $usuarios = [];
        
        foreach($database->query("SELECT *, (SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        WHERE ingredientes.id = itens.id_item) FROM itens") as $item){
=======
        foreach($database->query("SELECT *,
        (SELECT SUM(ingredientes.calorias) as calorias_item FROM ingredientes
        /*INNER JOIN
        itens_ingredientes ON itens_ingredientes.id_item = itens.id
        INNER JOIN
        ingredientes ON ingredientes.id = itens_ingredientes.id_ingrediente*/
        WHERE ingredientes.id = itens.id)
        FROM itens")
        as $item){
>>>>>>> 36b4e8c9931c5416c2fdc83a0e817486a7885208
            $itens[] = [
                "id" => $item["id"],
                "descricao" => $item["descricao"],
                "calorias_item" => $item["calorias_item"]
            ];
        }
<<<<<<< HEAD

        foreach($database->query("SELECT * FROM ingredientes") as $ingrediente){
=======
        foreach($database->query("SELECT * FROM ingredientes")
        as $ingrediente){
>>>>>>> 36b4e8c9931c5416c2fdc83a0e817486a7885208
            $ingredientes[] = [
                "id" => $ingrediente["id"],
                "descricao" => $ingrediente["descricao"],
                "calorias" => $ingrediente["calorias"]
            ];
        }
<<<<<<< HEAD
        foreach($database->query("SELECT * FROM cardapios") as $cardapio){
            $cardapios[] = [
                "id" => $cardapio["id"],
                "dia" => $cardapio["dia"],
                "tipo" => $cardapio["tipo"]
            ];
        }
        foreach($database->query("SELECT * FROM nutricionistas") as $nutricionista){
            $nutricionistas[] = [
=======
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
>>>>>>> 36b4e8c9931c5416c2fdc83a0e817486a7885208
                "crn" => $nutricionista["crn"],
                "nome" => $nutricionista["nome"]
            ];
        }
<<<<<<< HEAD
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
=======
        print json_encode($nutricionistas);
        print json_encode($cardapios);
        print json_encode($ingredientes);
        print json_encode($itens);
    }
    catch(PDOException $e){
>>>>>>> 36b4e8c9931c5416c2fdc83a0e817486a7885208
        die($e->getMessage());
    }

?>