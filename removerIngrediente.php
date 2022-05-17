<?php
require "class.Ingrediente.php";

$id = $_GET["id"];

$ing = Ingrediente::findbyPk($id);
if (!$ing){
    throw new Exception ("Ingrediente não encontrado!");
}
$ing->remover();
print $ing;

?>