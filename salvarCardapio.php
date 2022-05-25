<?php
require "lib/classCardapio.php";

try {
    $p = new Cardapio();
    $p->setDia($_POST['dia']);
    $p->setTipo($_POST['tipo']);
    $p->inserirCardapio();
    print $p;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>