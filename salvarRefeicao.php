<?php

    require "classNutricionista.php";

    try{
        $r = new Refeicao();
        $r->setDia($_POST["data"]);
        $r->setTipo($_POST["tipo"]);
        $r->setItens($_POST["itens"]);
        $n->inserir();
        print $r;
    }
    catch(Exception $e){
        print json_encode([
            "error" => true,
            "message" => $e->getMessage()
        ]);
    }

?>