<?php

    require "classUsuario.php";

    try{
        $u = new Usuario();
        $u->setNome($_POST["nome"]);
        $u->setEmail($_POST["email"]);
        $u->setSenha($_POST["senha"]);
        $u->inserir();
        print $u;
    }
    catch(Exception $e){
        print json_encode([
            "error" => true,
            "message" => $e->getMessage()
        ]);
    }

?>