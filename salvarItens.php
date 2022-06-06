<?php
require "class.Itens.php";
//require "classItens_Ingredientes";

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
    //$itn_igr = new Itens_Ingredientes();
    //$itn_igr->setId_Item($this->id);
    //$itn_igr->setId_Ingredientes($this->id_ingrediente);
    //$itn_igr->inserirItens_Ingredientes();
    //print $itn_igr;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>