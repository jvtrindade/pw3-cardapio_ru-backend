<?php
require "classCardapio.php";

$id = $_GET["id"];

$itn = Cardapio::findbyPk($id);
if (!$itn){
    throw new Exception ("Cardapio não encontrado!");
}
$itn->removerCardapio();
print $itn;

?>