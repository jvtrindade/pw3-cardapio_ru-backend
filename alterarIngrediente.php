<?php

require "classIngrediente.php";

$id = $_GET["id"];

$ing = Ingrediente::findbyPk($id);
if(!$p){
    throw new Exception("Ingrediente não encontrado!");
}
$n->setId($_POST["id"]);
$n->setDescricao($_POST["descricao"]);
$n->alterar();
print $n;

?>