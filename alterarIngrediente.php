<?php

require "class.Ingrediente.php";

$id = $_GET["id"];

$ing = Ingredientes::findbyPk($id);
if(!$ing){
    throw new Exception("Ingrediente não encontrado!");
}
$ing->setId($_POST["id"]);
$ing->setDescricao($_POST["descricao"]);
$ing->alterar();
print $ing;

?>