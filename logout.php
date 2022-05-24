<?php

    if (session_status() === PHP_SESSION_NONE){
        header("Location: ../frontend/publico/index.html");
    }
    else{
        session_destroy();
        header("Location: ../frontend/publico/index.html");
    }

?>