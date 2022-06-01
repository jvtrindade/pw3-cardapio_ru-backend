<?php

require "class.Ingrediente.php";

$id = $_GET["id"];

$ing = Ingrediente::findbyPk($id);
if(!$p){
    throw new Exception("Ingrediente não encontrado!");
}
$ing->setId($_POST["id"]);
$ing->setDescricao($_POST["descricao"]);
$ing->alterar();
print $ing;

?>