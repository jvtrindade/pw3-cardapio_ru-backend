<?php

require "class.Itens.php";

$id = $_GET["id"];

$itn = Itens::findbyPk($id);
if(!$p){
    throw new Exception("Item não encontrado!");
}
$itn->setId($_POST["id"]);
$itn->setDescricao($_POST["descricao"]);
$itn->alterar();
print $itn;

?>