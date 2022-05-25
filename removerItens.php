<?php
require "class.Itens.php";

$id = $_GET["id"];

$itn = Itens::findbyPk($id);
if (!$itn){
    throw new Exception ("Item não encontrado!");
}
$itn->removerItens();
print $itn;

?>