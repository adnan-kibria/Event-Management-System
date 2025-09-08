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
            exit();
        }
        else{
            $stmt_check = $conn->prepare("SELECT * FROM participants WHERE email = ? OR username = ?");
            $stmt_check->bind_param("ss", $email, $username);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
            if($result_check->num_rows > 0){
                echo "Email or Username already exists!";
                exit();
            }

            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            $remember_token = null;
            $token_expiry = null;

            $sql = "INSERT INTO participants (name, username, email, password, role, remember_token, token_expiry) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $name, $username, $email, $hash_pass, $role, $remember_token, $token_expiry);

            if($stmt->execute() === TRUE){
                echo "New record created successfully";
            }
            else{
                echo "Error: " .$stmt->error;
            }
        } 
    }
?>