<?php

require "classRefeicao.php";

$id = $_GET["id"];

$itn = Refeicao::findbyPk($id);
if(!$p){
    throw new Exception("Refeição não encontrado!");
}
$ref->setId($_POST["id"]);
$ref->alterar();
print $ref;

?>