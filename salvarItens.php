<?php
require "class.Itens.php";

try {
    /*foreach($database->query("SELECT * FROM itens") as $itens){
        $itens[] = [
            "id" => $itens["id"],
            "descricao" => $itens["descricao"],
        ];
        if ($_POST["descricao"] = $itens["descricao"]){
            print json_encode("Item já cadastrado");
        }
    }*/
    $itn = new Itens();
    $itn->setDescricao($_POST['item']);
    $itn->inserir();
    print $itn;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>