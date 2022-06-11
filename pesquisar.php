<?php

    $refeicao = $_POST["refeicao"];
    $dia = $_POST["data"];
    $item = $_POST["item"];

    require __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $USER = $_ENV['DB_USER'];
    $PASSWORD = $_ENV['DB_PASSWORD'];
    $DBNAME = $_ENV['DB_NAME'];
    
    $database = new PDO("mysql:host=localhost;dbname=" . $DBNAME, $USER, $PASSWORD);


    $busca = [];
    $ex = [];
    if (isset ($item)) {
        $busca[] = 'descricao=:descricao';
        $ex[':descricao'] =  $item;
    }

    if (isset($dia)){
        $busca[] = 'dia=:dia';
        $ex[':dia'] =  $dia;
    }

    if (isset($refeicao)){
        $busca[] = 'tipo=:refeicao';
        $ex[':refeicao'] =  $refeicao;
    }

    $str = implode(" and ", $busca);


    $consulta = $database->prepare("SELECT descricao FROM itens WHERE {$str}");
    $consulta->execute($ex);

    var_dump($consulta);

    $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);

    // $consultaData = $database->prepare("SELECT dia FROM cardapio WHERE dia=:dia");
    // $consultaData->execute([":dia" => $dia]);
    // $consultaData;//
    // $dadoData = $consultaData->fetchAll(PDO::FETCH_ASSOC);

    // $consultaRefeicao = $database->prepare("SELECT tipo FROM cardapio WHERE tipo=:refeicao");
    // $consultaRefeicao->execute([":refeicao" => $refeicao]);
    // $consultaRefeicao;//fetch
    // $dadoRefeicao = $consultaRefeicao->fetch();

    var_dump($dados);

    print json_encode($dados);

    // print json_encode($dadoItem);
    // print json_encode($dadoData);
    // print json_encode($dadoRefeicao);


?>