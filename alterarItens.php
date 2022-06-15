<?php

require "class.Itens.php";

try {
    $id = $_GET["id"];

    $itn = Itens::findbyPk($id);
    if(!$itn){
        throw new Exception("Item não encontrado!");
    }
    $itn->setDescricao($_POST["item-lista"]);
    $itn->setIngredientes($_POST['ingrediente_item_lista']);
    $itn->alterar();
    print $itn;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}


?>