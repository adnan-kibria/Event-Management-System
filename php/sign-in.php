<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $error = [];

        $email_username = trim($_POST['email-username'] ?? '');
        $password = trim($_POST['password-sign-in'] ?? '');
        if($email_username === ""){
            $error['email-username'] = "Email or Username is required.";
        }
        if($password === ""){
            $error['password'] = "Password is required.";
        }

        if(!empty($error)){
            header("Location: ../view/sign-up-sign-in.html");
        } else {
            echo "Submit Successfully!";
        }
    }
?>