<?php

    require "classNutricionista.php";

    try{
        foreach($database->query("SELECT * FROM nutricionistas") as $nutricionista){
            $nutricionista[] = [
                "crn" => $nutricionista["crn"],
            ];
            if ($_POST["crn"] = $nutricionistas["crn"]){
                print json_encode("Nutricionista já cadastrado(a)");
            }
        }
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