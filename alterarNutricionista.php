<?php

    require "classNutricionista.php";

try{
    $id = $_GET["id"];

    $nut = Nutricionista::findbyPk($id);
    if(!$nut){
        throw new Exception("Usuário não encontrado!");
    }
    $nut->setCRN($_POST["crn"]);
    $nut->setNome($_POST["nome"]);
    $nut->alterar();
    print $nut;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>