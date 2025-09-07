<?php
    session_start();
    session_unset();
    session_destroy();
    setcookie("remember-token", "", time() - 3600, "/");
    header("Location: ../view/sign-up-sign-in.php");
    exit();
?>