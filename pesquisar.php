<?php

    $refeicao = $_POST["refeicao"];
    $dia = $_POST["data"];
    $item = $_POST["item"];
    $database = new PDO("mysql:host=localhost;dbname=ru", "aluno", "aluno");
    $consultaItem = $database->prepare("SELECT * FROM itens WHERE descricao=:descricao");
    $consultaItem = $database->execute([":descricao" => $item]);
    $consultaData = $database->prepare("SELECT * FROM cardapio WHERE dia=:dia");
    $consultaData = $database->execute([":dia" => $dia]);
    $consultaRefeicao = $database->prepare("SELECT * FROM cardapio WHERE tipo=:refeicao");
    $consultaRefeicao = $database->execute([":refeicao" => $refeicao]);

    print json_encode($consulta)


?>