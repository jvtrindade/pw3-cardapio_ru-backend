<?php
require "lib/class.Itens.php";

try {
    $p = new Itens();
    $p->setDescricao($_POST['descricao']);
    $p->inserir();
    print $p;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>