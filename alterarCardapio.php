<?php

require "classCardapio.php";

try {
    $id = $_GET["id"];

    $car = Cardapio::findbyPk($id);
    if(!$car){
        throw new Exception("Cardápio não encontrado!");
    }
    $car->setId($_POST["id"]);
    $car->setData($_POST["dia"]);
    $car->setTipo($_POST["tipo"]);
    $car->setItens($_POST["item_refeicao"]);
    $car->setId_nutricionista($_POST["crn_nutricionista"]);//ver o nome aqui
    $car->alterar();
    print $car;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>