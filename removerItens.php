<?php
require "class.Itens.php";

try {
    $id = $_GET["id"];
    $itn = Itens::findbyPk($id);
    if (!$itn){
        throw new Exception ("Item não encontrado!");
    }
    $itn->remover();
    print $itn;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>