<?php

if (!isset($_SESSION['usuario'])){
    header("location: ../publico/index.php");
    die();
}

?>