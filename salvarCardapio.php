<?php
require "classCardapio.php";

try {
    $c = new Cardapio();
    $c->setDia($_POST['dia']);
    $c->setTipo($_POST['tipo']);
    $c->inserirCardapio();
    print $c;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>