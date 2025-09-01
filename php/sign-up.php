<?php

    include "../db/festivio-db.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = trim($_POST['name'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email']);
        $password = trim($_POST['password-sign-up'] ?? '');
        $confirm_password = trim($_POST['confirm-password'] ?? '');
        $terms = isset($_POST['terms']);

        $role = "participant";

        if(empty($name) || !preg_match("/^[A-Za-z\s]+$/", $name) || empty($username) || !preg_match("/^[A-Za-z0-9_]+$/", $username) || empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false || empty($password) || strlen($password) < 8 || empty($confirm_password) || $confirm_password !== $password || !$terms){
            echo "Fill up the form correctly!";
        }
        else{
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO participants (name, username, email, password, role) VALUES ('$name', '$username', '$email', '$hash_pass', '$role')";

            if($conn->query($sql) === TRUE){
                echo "New record created successfully";
            }
            else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } 
    }
?>