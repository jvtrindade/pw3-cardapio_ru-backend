<?php

    require "classUsuario.php";

    $id = $_GET['id'];

    $u = Usuario::findbyPk($id);
    if ($u) throw new Exception("Usuário não encontrado");
    $u->setNome($_POST["nome"]);
    $u->setEmail($_POST["email"]);
    $u->setSenha($_POST["senha"]);
    $u->alterar();
    print $u;

?>