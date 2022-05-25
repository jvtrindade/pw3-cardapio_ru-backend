<?php

    if(!isset($_SESSION['usuario'])){
        $usuario = $_POST["email"];
        $senha = $_POST["senha"];
        $database = new PDO("mysql:localhost=host;dbname=ru", "aluno", "aluno");
    
        $consulta = $database->prepare("SELECT * FROM usuarios WHERE email=:email and senha =:senha");
        $consulta->execute([":email" => $usuario, ':senha' => $senha]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, "Usuario");
        $dados = $consulta->fetch();
        if($dados != false){
            session_start();
            $_SESSION['usuario'] = $dados;
            header("Location: autenticar.php");
        }
        else{
            header("Location: ../frontend/publico/index.php");
        }
    }
    else{
        header ("Location: ../frontend/privado/index.php");
    }

?>