<?php
require "classCardapio.php";

try{
    $id = $_GET["id"];

    $car = Cardapio::findbyPk($id);
    if (!$car){
        throw new Exception ("Cardápio não encontrado!");
    }
    $car->removerCardapio();
    print $car;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>