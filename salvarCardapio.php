<?php
require "classCardapio.php";

try {
    $c = new Cardapio();
    $c->setDia($_POST['data']);
    $c->setTipo($_POST['tipo']);
    $c->setCrn_nutricionista($_POST['nutricionista']);
    $c->inserirCardapio();
    print $c;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>