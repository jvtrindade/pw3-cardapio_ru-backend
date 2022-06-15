<?php
    require_once dirname(__FILE__) . "/class.DB.php";
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
        $db = DB::getInstance();
        $db->query("START TRANSACTION;");
        $consulta = $db->prepare("SELECT * FROM cardapios WHERE id= :id LIMIT 1");
        $consulta->execute([
            ':id' => $cardapio_recebido
        ]);
        $dados = $consulta->fetch(PDO::FETCH_ASSOC);

        $consulta = $db->prepare("SELECT id_itens FROM itens_cardapios WHERE id_cardapio = :id_cardapio");
        $consulta->execute([
            ":id_cardapio" => $cardapio_recebido
        ]);
        $itens = $consulta->fetch(PDO::FETCH_ASSOC);

        $car = new Cardapio();
        $car->setData($nova_data);
        $car->setTipo($dados["tipo"]);
        $car->setId_nutricionista($dados["id_nutricionista"]);
        $car->setItens($itens);
        $car->inserir();
        print $car;
        $db->query("COMMIT;");

    }catch(Exception $e){
        $db->query("ROLLBACK;");
        $e->getMessage();
    }

    

?>