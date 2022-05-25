<?php
require "lib/class.Ingredientes.php";

try {
    $p = new Ingrediente();
    $p->setDescricao($_POST['descricao']);
    $p->setCalorias($_POST['calorias']);
    $p->inserirIngredientes();
    print $p;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>