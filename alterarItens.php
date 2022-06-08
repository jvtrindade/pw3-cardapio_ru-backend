<?php

require "class.Itens.php";

try {
    $id = $_GET["id"];

    $itn = Itens::findbyPk($id);
    if(!$itn){
        throw new Exception("Item não encontrado!");
    }
    $itn->setDescricao($_POST["descricao"]);
    $itn->setIngredientes($_POST['ingrediente_item']);
    $itn->alterar();
    print $itn;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}


?>