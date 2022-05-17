<?php

    $usuario = $_POST["email"];
    $senha = $_POST["senha"];
    $database = new PDO("mysql:localhost=host;dbname=ru", "root", "root");

    foreach($database->query("SELECT * FROM usuarios") as $dados){
        if ($usuario == $dados["email"] && $senha == $dados["senha"]){
            header("Location: ../privado/index.php");
        }
        else{
            die("Usuário ou Senha incorretos");
        }
    }

?>