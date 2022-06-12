<?php

require "class.Ingrediente.php";

try{
    $id = $_GET["id"];

    $ing = Ingredientes::findbyPk($id);
    if(!$ing){
        throw new Exception("Ingrediente não encontrado!");
    }
    $ing->setId($_POST["id"]);
    $ing->setDescricao($_POST["descricao"]);
    $ing->alterar();
    print $ing;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>