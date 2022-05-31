<?php

    $refeicao = //$_POST["refeicao"];
    $dia = //$_POST["data"];
    $item = "Tapioca"; //$_POST["item"];
    $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
    $consultaItem = $database->prepare("SELECT descricao FROM itens WHERE descricao=:descricao");
    $consultaItem->execute([":descricao" => $item]);
    $consultaItem;//tem q fazer o fetch
    $dadoItem = $consultaItem->fetch();

    $consultaData = $database->prepare("SELECT dia FROM cardapio WHERE dia=:dia");
    $consultaData->execute([":dia" => $dia]);
    $consultaData;//fetch
    $dadoData = $consultaData->fetch();

    $consultaRefeicao = $database->prepare("SELECT tipo FROM cardapio WHERE tipo=:refeicao");
    $consultaRefeicao->execute([":refeicao" => $refeicao]);
    $consultaRefeicao;//fetch
    $dadoRefeicao = $consultaRefeicao->fetch();

    var_dump($consultaRefeicao);

    print json_encode($dadoItem);
    print json_encode($dadoData);
    print json_encode($dadoRefeicao);


?>