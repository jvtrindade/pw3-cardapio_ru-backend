<?php

    require "classCardapio.php";

    $cardapio_recebido = $_GET ['id'];
    $nova_data = $_GET ['cardapioNovo'];

    $car = new Cardapio;
    $car = Cardapio::findbyPk($cardapio_recebido);
    if(!$car){
        throw new Exception("Cardápio não encontrado!");
    }
    $db = null;
    try{
        // $db = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
        $db->query("START TRANSACTION;");
        $consulta = $db->prepare("SELECT * FROM cardapios WHERE id= :id LIMIT 1");
        $consulta->execute([
            ':id' => $cardapio_recebido
        ]);
        $dados = $consulta->fetch(PDO::FETCH_ASSOC);

        $car = new Cardapio();
        $car->setData($nova_data);
        $car->setTipo($dados["tipo"]);
        $car->setId_nutricionista($dados["id_nutricionista"]);
        $car->setItens($_POST['item_refeicao']);// ver isso
        $car->inserir();
        print $c;
        $db->query("COMMIT;");

    }catch(Exception $e){
        $db->query("ROLLBACK;");
        $e->getMessage();
    }

    

?>