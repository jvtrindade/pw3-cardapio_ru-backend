<?php

    require "classRefeicao.php";

    $id = $_GET["id"];

    $ref = Refeicao::findbyPk($id);
    if (!$ref){
        throw new Exception("Refeição não encontrada");
    }
    $u->remover();
    print $ref;

?>