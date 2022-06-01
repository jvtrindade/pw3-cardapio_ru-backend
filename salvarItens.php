<?php
require "class.Itens.php";

try {
    foreach($database->query("SELECT * FROM itens") as $itens){
        $itens[] = [
            "id" => $itens["id"],
            "descricao" => $itens["descricao"],
        ];
        if ($_POST["descricao"] = $itens["descricao"]){
            print json_encode("Item já cadastrado");
        }
    }
    $p = new Itens();
    $p->setDescricao($_POST['descricao']); // isso aqui tem que ser diferente pq não vai ter um campo de descrição pro item
    $p->inserir();
    print $p;
}catch(Exception $e){
    print json_encode([
        "error" => true,
        "message" => $e->getMessage()
    ]);
}

?>