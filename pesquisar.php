<?php

    $refeicao = "almoco";//$_POST["refeicao"];
    $dia = null;//$_POST["data"];
    $item = "Feijão"; //$_POST["item"];
    
    $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");


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

    // print json_encode($dadoItem);
    // print json_encode($dadoData);
    // print json_encode($dadoRefeicao);


?>