<?php

    /*$usuario = $_POST["email"];
    $senha = $_POST["senha"];
    $database = new PDO("mysql:localhost=host;dbname=ru", "root", "root");

    $consulta = $database->prepare("SELECT * FROM usuarios WHERE email=:email and senha =:senha LIMIT 1");
    $consulta->execute([":email" => $usuario, ':senha' => $senha]);
    $consulta->setFetchMode(PDO::FETCH_CLASS, "Usuario");
    $consulta->fetch();

    foreach($database->prepare("SELECT * FROM usuarios WHERE email = :email and senha =  :senha LIMIT 1") as $dados){
        if ($usuario == $dados["email"] && $senha == $dados["senha"]){
            header("Location: ../frontend/privado/index.php");
        }
        else{
            die("Usuário ou Senha incorretos");
        }
    }*/

    $usuario = $_POST["email"];
    $senha = $_POST["senha"];
    $database = new PDO("mysql:localhost=host;dbname=ru", "root", "root");
 
    $consulta = $database->prepare("SELECT * FROM usuarios WHERE email=:email and senha =:senha LIMIT 1");
    $consulta->execute([":email" => $usuario, ':senha' => $senha]);
    $consulta->setFetchMode(PDO::FETCH_CLASS, "Usuario");
    die(var_dump($consulta->fetch()));
    foreach ($consulta as $c){
        if ($usuario == $c["email"] && $senha == $c["senha"]){
            session_start();
            header("Location: ../frontend/privado/index.php");
        }
        else{
            die("Usuário ou Senha incorretos");
        }
    }

?>