<?php

    require "classUsuario.php";

    $id = $_GET["id"];

    $u = Usuario::findbyPk($id);
    if (!$u){
        throw new Exception("Usuário não encontrado");
    }
    $u->remover();
    print $u;

?>