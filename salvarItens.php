<?php
require "class.Itens.php";
require "classItens_Ingredientes";

try {
    /*foreach($database->query("SELECT * FROM itens") as $itens){
        $item[] = [
            "descricao" => $itens["descricao"],
        ];
        foreach ($item as $itm){
            if ($_POST["descricao"] == $itm["descricao"]){
                print json_encode("Item já cadastrado");
                die;
            }
        }
        
    }*/
    $itn = new Itens();
    $itn->setDescricao($_POST['item']);
    $itn->inserir();
    print $itn;
    $itn_igr = new Itens_Ingredientes();
    $itn_igr->setId_Item($_POST['id']);
    $itn_igr->setId_Ingrediente($_POST['id_ingrediente']); // arrumar o POST
    $itn_igr->inserir();
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>