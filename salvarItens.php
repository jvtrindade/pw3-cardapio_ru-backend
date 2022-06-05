<?php
require "class.Itens.php";

try {
    foreach($database->query("SELECT * FROM itens") as $itens){
        $item[] = [
            "descricao" => $itens["descricao"],
        ];
        foreach ($item as $itm){
            if ($_POST["descricao"] == $item["descricao"]){
                print json_encode("Item já cadastrado");
            }
        }
        
    }
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