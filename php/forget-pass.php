<?php
    include "../db/festivio-db.php";
    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forget'])){
        $username = $_POST['username'] ?? '';
        $newpass = $_POST['newpass'] ?? '';

        if($username === '' || $newpass === ''){
            echo json_encode(["status" => "error", "message" => "Invalid request"]);
            exit();
        }

        $hashedPass = password_hash($newpass, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE admin SET password=? WHERE username=?");
        $stmt->bind_param("ss", $hashedPass, $username);
        $stmt->execute();
        $admin_updated = $stmt->affected_rows;

        $stmt2 = $conn->prepare("UPDATE participants SET password=? WHERE username=?");
        $stmt2->bind_param("ss", $hashedPass, $username);
        $stmt2->execute();
        $participant_updated = $stmt2->affected_rows;

        if($admin_updated > 0 || $participant_updated > 0){
            echo json_encode(["status" => "success", "message" => "Password updated successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Username not found"]);
        }
        exit(); 
    }

    $sql = "SELECT username FROM admin UNION SELECT username FROM participants";
    $result = $conn->query($sql);
    $users = [];
    if($result){
        while($row = $result->fetch_assoc()){
            $users[] = $row['username'];
        }
    }
    echo json_encode($users);
?>
