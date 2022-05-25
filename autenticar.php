<?php

    /*if(!isset($_SESSION['usuario'])){
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
    }*/

    require __DIR__ . '/vendor/autoload.php';
    require __DIR__ . "/key.php";
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    $usuario = $_POST['email'];
    $senha = $_POST['senha'];
    $database = new PDO("mysql:localhost=host;dbname=ru", "aluno", "aluno");
    try {
        
        $consulta = $database->prepare("SELECT id, nome FROM usuarios WHERE email=:email and senha =:senha");
        $consulta->execute([":email" => $usuario, ':senha' => $senha]);
        $consulta->setFetchMode(PDO::FETCH_CLASS, "Usuario");
        $dados = $consulta->fetch();
        
        if ($dados === false){
            throw new Exception("Dados inválidos!");
        }

        $jwt = JWT::encode($dados, $key, 'HS256');
        print json_encode(['token' => "Bearer ${jwt}", 'usuario' => ['name' => $dados['name']]]);
    } catch(Exception $e){
        die(json_encode(['error' => $e->getMessage()]));
    }

?>