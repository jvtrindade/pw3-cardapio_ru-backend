<?php

require "classCardapio.php";

$id = $_GET["id"];

$car = Cardapio::findbyPk($id);
if(!$p){
    throw new Exception("Cardápio não encontrado!");
}
$car->setId($_POST["id"]);
$car->setDia($_POST["dia"]);
$car->setTipo($_POST["tipo"]);
$car->alterar();
print $n;

?>