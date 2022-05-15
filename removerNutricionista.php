<?php

    require "classNutricionista.php";

    $crn = $_GET["crn"]; //ver se não é pelo POST

    $n = Nutricionista::findbyPk($crn);
    if (!$n){
        throw new Exception ("Usuário não encontrado!");
    }
    $n->remover();
    print $n;

?>