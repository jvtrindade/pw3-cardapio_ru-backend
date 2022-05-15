<?php

    require "classNutricionista.php";

    try{
        $n = new Nutricionista();
        $n->setCRN($_POST["crn"]);
        $n->setNome($_POST["nome"]);
        $n->inserir();
        print $n;
    }
    catch(Exception $e){
        print json_encode([
            "error" => true,
            "message" => $e->getMessage()
        ]);
    }

?>