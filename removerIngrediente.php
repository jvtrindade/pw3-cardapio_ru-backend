<?php
require "class.Ingrediente.php";

$id = $_GET["id"];

$ing = Ingredientes::findbyPk($id);
if (!$ing){
    throw new Exception ("Ingrediente não encontrado!");
}
$ing->removerIngredientes();
header('location: ../frontend/privado/index.php');

?>