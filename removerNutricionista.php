<?php

    require "classNutricionista.php";

try{
    $id = $_GET["id"];

    $nut = Nutricionista::findbyPk($id);
    if (!$nut){
        throw new Exception ("Nutricionista não encontrado!");
    }
    $nut->remover();
    
    header('location: ../frontend/privado/index.php');
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>