<?php

class Itens {
    private $id;
    private $descricao = "";


function inserirItens(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("INSERT INTO itens(descricao) VALUES(:descricaos)");
            $consulta->execute([
                ':descricao' => $this->descricao
            ]);
            $consulta = $db->prepare("SELECT id FROM itens ORDER BY id DESC LIMIT 1");
            $consulta->execute();
            $data = $consulta->fetch(PDO::FETCH_ASSOC);
            $this->id = $data['id'];

        }catch(PDOException $e){
            throw new Exception("Ocorreu um erro interno!");
            
        }
    }

    function alterarItens(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=pw3", "root", "");
            $consulta = $db->prepare("UPDATE itens SET descricao = :descricao WHERE id= :id");
            $consulta->execute([
                ':id' => $this->id,
                ':descricao' => $this->descricao
            ]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    function removerItens(){
        try {
            $db = new PDO("mysql:host=localhost;dbname=ru", "root", "");
            $consulta = $db->prepare("DELETE FROM itens WHERE id= :id");
            $consulta->execute([':id' => $this->id]);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
    
    ?>