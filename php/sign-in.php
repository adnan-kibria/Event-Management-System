<?php
    session_start();

    include "../db/festivio-db.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email_username = $_POST["email-username"];
        $password = $_POST["password-sign-in"];

        if(empty($email_username) || empty($password)){
            die("Email or Username and Password is Required");
        }
        else{
            $sql = "SELECT * FROM admin WHERE (email = ? OR username = ?) UNION SELECT * FROM participants WHERE (email = ? OR username = ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $email_username, $email_username, $email_username, $email_username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows === 1){
                $user = $result->fetch_assoc();
                if(password_verify($password, $user["password"])){
                    $_SESSION["name"] = $user["name"];
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["email"] = $user["email"];
                    $_SESSION["role"] = isset($user["role"]) ? $user["role"] : "participant";
                    $_SESSION["logged-in"] = true;

                    if($_SESSION["role"] === "admin"){
                        header("Location: ../view/admin-dashboard.php");
                    } else {
                        header("Location: ../view/participant-dashboard.php");
                    }
                    exit();
                } else {
                    die("Invalid Password");
                }
            } 
            else {
                die("User Not Found");
            }
            header("Location: ../view/sign-in.php");
            exit();
        }
    }

    if(isset($_POST["remember-me"])){
        $token = bin2hex(random_bytes(16));
        $expiry = time() + (30 * 24 * 60 * 60);

        $sql = "UPDATE participants SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?
                UNION UPDATE admin SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $token, date('Y-m-d H:i:s', $expiry), $email_username, $email_username, $token, date('Y-m-d H:i:s', $expiry), $email_username, $email_username);
        $stmt->execute();

        setcookie("remember-token", $token, $expiry, "/");
    }

?>