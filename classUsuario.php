<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

    class Usuario{

        private $id;
        private $nome = "";
        private $email = "";
        private $senha = "";

        function __toString(){
            return json_encode([
                "id" => $this->id,
                "nome" => $this->nome,
                "email" => $this->email,
                "senha" => $this->senha
            ]);
        }

        static function findbyPk ($id){
            $database = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $consulta = $database->prepare("SELECT * FROM usuarios WHERE id=:id");
            $consulta->execute([":id" => $id]);
            $consulta->setFetchMode(PDO::FETCH_CLASS, "Usuario");
            return $consulta->fetch();
        }

        function setNome($valor){
            $this->nome = $valor;
        }
        function setEmail($valor){
            $this->email = $valor;
        }
        function setSenha($valor){
            $this->senha = $valor;
        }
        function getNome(){
            return $this->nome;
        }
        function getEmail(){
            return $this->email;
        }
        function getSenha(){
            return $this->senha;
        }

        function inserir(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
                $consulta = $database->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
                $consulta->execute([
                    ":nome" => $this->nome,
                    ":email" => $this->email,
                    ":senha" => $this->senha
                ]);
                $consulta = $database->prepare("SELECT id FROM usuarios ORDER BY id DESC LIMIT 1");
                $consulta->execute();
                $dados = $consulta->fetch(PDO::FETCH_ASSOC);
                $this->id = $dados["id"];
            }
            catch(PDOException $e){
                throw new Exception("Ocorreu um erro interno!");
            }
        }

        function alterar(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
                $consulta = $database->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
                $consulta->execute([
                    ":id" => $this->id,
                    ":nome" => $this->nome,
                    ":email" => $this->email,
                    ":senha" => $this->senha
                ]);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }

        function remover(){
            try{
                $database = new PDO("mysql:host=localhost;dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
                $consulta = $database->prepare("DELETE FROM usuarios WHERE id = :id");
                $consulta->execute([":id" => $this->id]);
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }
    }

?>