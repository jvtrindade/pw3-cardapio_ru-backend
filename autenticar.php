<?php

    if(session_status() === PHP_SESSION_NONE){
        $usuario = $_POST["email"];
        $senha = $_POST["senha"];
        $database = new PDO("mysql:localhost=host;dbname=ru", "aluno", "aluno");
    
        $consulta = $database->prepare("SELECT * FROM usuarios WHERE email=:email and senha =:senha");
        $consulta->execute([":email" => $usuario, ':senha' => $senha]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, "Usuario");
        $dados = $consulta->fetch();
        if($dados != false){
            session_start();
            header("Location: autenticar.php");
        }
        else{
            header("HTTP/1.0 404 Not Found");
            die("Usuário não encontrado!"); //header voltar
        }
    }
    else{
        header ("Location: ../frontend/privado/index.html");
    }

?>