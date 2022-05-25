<?php

if (!isset($_SESSION['usuario'])){
    header("location: ../frontend/publico/index.php");
    die();
}

?>