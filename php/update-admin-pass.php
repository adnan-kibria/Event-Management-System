<?php
    session_start();
    include "../db/festivio-db.php";

    if(!isset($_SESSION["logged-in"])){
        echo "Unauthorized!";
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        echo "Invalid request method";
        exit();
    }

    $new_pass = $_POST["newpass"] ?? '';
    if (trim($new_pass) === '') {
        echo "Password cannot be empty";
        exit();
    }
    if (strlen($new_pass) < 6) {
        echo "Password must be at least 6 characters";
        exit();
    }

    $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT);
    $username = $_SESSION["username"];

    $sql = "UPDATE admin SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit();
    }
    $stmt->bind_param("ss", $hash_pass, $username);

    if($stmt->execute()){
        if($stmt->affected_rows > 0){
            echo "Password updated successfully!";
        } else {
            echo "No change made (maybe same password or user not found).";
        }
    } else {
        echo "Error updating password: ".$stmt->error;
    }

    $stmt->close();
    $conn->close();
?>
