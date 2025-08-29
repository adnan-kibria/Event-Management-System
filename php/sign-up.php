<?php
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $error = [];

        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email']);
        $password = trim($_POST['password-sign-up'] ?? '');
        $confirm_password = trim($_POST['confirm-password'] ?? '');
        $terms = isset($_POST['terms']);

        if($name === ""){
            $error['name'] = "Name is required.";
        }
        else if(!preg_match("/^[A-Za-z\s]+$/", $name)){
            $error['name'] = "Name can only contain letters and spaces.";
        }
        if($username === ""){
            $error['username'] = "Username is required.";
        }
        else if(!preg_match("/^[A-Za-z0-9_]+$/", $username)){
            $error['username'] = "Username can only contain letters, numbers, and underscores.";
        }
        if($email === ""){
            $error['email'] = "Email is required.";
        }
        else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $error['email'] = "Invalid email format.";
        }
        if($password === ""){
            $error['password'] = "Password is required.";
        }
        else if(strlen($password) < 8){
            $error['password'] = "Password must be at least 8 characters long.";
        }
        if($confirm_password === ""){
            $error['confirm_password'] = "Confirm password is required.";
        }
        else if($confirm_password !== $password){
            $error['confirm_password'] = "Passwords do not match.";
        }
        if(!$terms){
            $error['terms'] = "You must accept the terms and conditions.";
        }

        echo "Submit Successfully!";

        if(!empty($error)){
            header("Location: ../view/sign-up-sign-in.html");
        } else {
            echo "Submit Successfully!";
        }
    }
?>