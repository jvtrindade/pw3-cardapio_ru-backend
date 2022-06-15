<?php

require "class.Ingrediente.php";

try{
    $id = $_GET["id"];

    $ing = Ingredientes::findbyPk($id);
    if(!$ing){
        throw new Exception("Ingrediente não encontrado!");
    }
    $ing->setId($_POST["id_ingrediente_lista"]);
    $ing->setDescricao($_POST["ingrediente_lista"]);
    $ing->setCalorias($_POST["calorias_lista"]);
    $ing->alterar();
    print $ing;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>