<?php

    require "classNutricionista.php";

    try{
        // foreach($database->query("SELECT * FROM nutricionistas") as $nutricionista){
        //     $nutricionista[] = [
        //         "crn" => $nutricionista["crn"],
        //     ];
        //     if ($_POST["crn"] = $nutricionistas["crn"]){
        //         print json_encode("Nutricionista já cadastrado(a)");
        //     }
        // }
        $nut = new Nutricionista();
        $nut->setCRN($_POST["crn"]);
        $nut->setNome($_POST["nome_nutricionista"]);
        $nut->inserir();
        print $nut;
    }
    catch(Exception $e){
        print json_encode([
            "error" => true,
            "message" => $e->getMessage()
        ]);
    }

?>