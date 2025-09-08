<?php 
    session_start();
    include "../db/festivio-db.php";
    if(!isset($_SESSION["logged-in"]) && (isset($_COOKIE["remember_token"]))){
        $token = $_COOKIE["remember_token"];
        $sql = "SELECT * FROM participants WHERE remember_token = ? OR token_expiry > NOW()
                UNION 
                SELECT * FROM admin WHERE remember_token = ? OR token_expiry > NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $user = $result->fetch_assoc();
            $_SESSION["name"] = $user["name"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = isset($user["role"]) ? $user["role"] : "participant";
            $_SESSION["logged-in"] = true;

            session_regenerate_id(true);

            $new_token = bin2hex(random_bytes(16));
            $expiry = time() + (30 * 24 * 60 * 60);

            $sql1 = "UPDATE participants SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("ssss", $new_token, date('Y-m-d H:i:s', $expiry), $user["email"], $user["username"]);
            $stmt1->execute();

            $sql2 = "UPDATE admin SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("ssss", $new_token, date('Y-m-d H:i:s', $expiry), $user["email"], $user["username"]);
            $stmt2->execute();

            setcookie("remember_token", $new_token, $expiry, "/", "", true, true);
        }
    }
    if(!isset($_SESSION["logged-in"])){
        header("Location: ../view/sign-up-sign-in.php");
        exit();
    }
?>