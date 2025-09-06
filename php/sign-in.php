<?php
    session_start();

    include "../db/festivio-db.php";

    if($_SERVER["REQUEST METHOD"] === "POST"){
        $email_username = $_POST["email-username"];
        $password = $_POST["password-sign-in"];

        if(empty($email_username) || empty($password)){
            die("Email or Username and Password is Required");
        }
        else{
            $sql = "SELECT * FROM admin WHERE (email = ? OR username = ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email_username, $email_username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows === 1){
                $user = $result->fetch_assoc();
                if(password_verify($password, $user["password"])){
                    
                }
            }
        }
    }

?>