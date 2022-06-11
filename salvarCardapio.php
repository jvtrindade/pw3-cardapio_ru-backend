<?php
require "classCardapio.php";

try {
    $c = new Cardapio();
    $c->setData($_POST['data']);
    $c->setTipo($_POST['tipo']);
    $c->setCrn_nutricionista($_POST['nutricionista']);
    $c->inserir();
    print $c;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>