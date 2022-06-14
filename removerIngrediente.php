<?php
require "class.Ingrediente.php";

try{
    $id = $_GET["id"];

    $ing = Ingredientes::findbyPk($id);
    if (!$ing){
        throw new Exception ("Ingrediente não encontrado!");
    }
    $ing->remover();
    header('location: ../frontend/privado/index.php');
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>