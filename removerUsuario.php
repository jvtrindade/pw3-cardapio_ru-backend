<?php

    require "classUsuario.php";

try{
    $id = $_GET["id"];

    $usu = Usuario::findbyPk($id);
    if (!$usu){
        throw new Exception("Usuário não encontrado");
    }
    $usu->remover();
    print $usu;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}
?>