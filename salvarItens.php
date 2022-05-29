<?php
require "class.Itens.php";

try {
    $p = new Itens();
    $p->setDescricao($_POST['descricao']); // isso aqui tem que ser diferente pq não vai ter um campo de descrição pro item
    $p->inserir();
    print $p;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>