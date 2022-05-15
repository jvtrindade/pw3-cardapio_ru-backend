<?php

    require "classNutricionista.php";

    $crn = $_GET["crn"];

    $n = Nutricionista::findbyPk($crn); //perguntar pro Professor o que significa os ::
    if(!$p){
        throw new Exception("Usuário não encontrado!");
    }
    $n->setCRN($_POST["crn"]);
    $n->setNome($_POST["nome"]);
    $n->alterar();
    print $n;
    
?>