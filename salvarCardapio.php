<?php
require "classCardapio.php";

try {
    $car = new Cardapio();
    $car->setData($_POST['data']);
    $car->setTipo($_POST['tipo']);
    $car->setId_nutricionista($_POST['nutricionista']);
    $car->setItens($_POST['item_refeicao']);
    $car->inserir();
    print $c;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>