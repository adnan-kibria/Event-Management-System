<?php
    session_start();

    include "../db/festivio-db.php";

    if(isset($_COOKIE["remember_token"]) && !isset($_SESSION["logged-in"])){
        $token = $_COOKIE["remember_token"];

        $sql = "SELECT * FROM admin WHERE remember_token = ? AND token_expiry > NOW()
                UNION
                SELECT * FROM participants WHERE remember_token = ? AND token_expiry > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token,$token);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $user = $result->fetch_assoc();
            $_SESSION["name"] = $user["name"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = isset($user["role"]) ? $user["role"] : "participant";
            $_SESSION["logged-in"] = true;

            if($_SESSION["role"] === "admin"){
                header("Location: ../view/admin-dashboard.php");
            } else {
                header("Location: ../view/user-dashboard.php");
            }
            exit();
        }
        else{
            setcookie("remember_token", "", time() - 3600, "/");  
        }
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email_username = $_POST["email-username"];
        $password = $_POST["password-sign-in"];

        if(empty($email_username) || empty($password)){
            die("Email or Username and Password is Required");
        }
        else{
            $sql = "SELECT * FROM admin WHERE email = ? OR username = ? 
                    UNION 
                    SELECT * FROM participants WHERE email = ? OR username = ?";
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

                    if(isset($_POST["remember-me"])){
                        $token = bin2hex(random_bytes(16));
                        $expiry = time() + (30 * 24 * 60 * 60);

                        $sql1 = "UPDATE participants SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bind_param("ssss", $token, date('Y-m-d H:i:s', $expiry), $user["email"], $user["username"]);
                        $stmt1->execute();

                        $sql2 = "UPDATE admin SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bind_param("ssss", $token, date('Y-m-d H:i:s', $expiry), $user["email"], $user["username"]);
                        $stmt2->execute();

                        setcookie("remember_token", $token, $expiry,"/", "", true, true);
                    }

                    if($_SESSION["role"] === "admin"){
                        header("Location: ../view/admin-dashboard.php");
                    } else {
                        header("Location: ../view/user-dashboard.php");
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
?>