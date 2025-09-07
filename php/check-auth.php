<?php 
    session_start();
    include "../db/festivio-db.php";
    if(!isset($_SESSION["logged-in"]) && (isset($_COOKIE["remember_token"]))){
        $token = $_COOKIE["remember_token"];
        $sql = "SELECT * FROM participants WHERE remember_token = ? UNION SELECT * FROM admin WHERE remember_token = ?";
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

            $new_token = bin2hex(random_bytes(16));
            $expiry = time() + (30 * 24 * 60 * 60);

            $sql = "UPDATE participants SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?
                    UNION UPDATE admin SET remember_token = ?, token_expiry = ? WHERE email = ? OR username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $new_token, date('Y-m-d H:i:s', $expiry), $user["email"], $user["username"], $new_token, date('Y-m-d H:i:s', $expiry), $user["email"], $user["username"]);
            $stmt->execute();

            setcookie("remember-token", $new_token, $expiry, "/");
        }
    }
?>