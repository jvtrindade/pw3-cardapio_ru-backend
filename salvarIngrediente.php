<?php
require "class.Ingrediente.php";

try {
    /*foreach($database->query("SELECT * FROM ingredientes") as $ingrediente){
        $ingredientes[] = [
            "id" => $ingrediente["id"],
            "descricao" => $ingrediente["descricao"],
            "calorias" => $ingrediente["calorias"]
        ];
        if ($_POST["descricao"] = $ingredientes["descricao"]){
            print json_encode("Ingrediente já cadastrado");
        }
    }*/
    $ing = new Ingredientes();
    $ing->setdescricao_ingrediente($_POST['ingrediente']);
    $ing->setCalorias($_POST['calorias']);
    $ing->inserir();
    print $ing;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>