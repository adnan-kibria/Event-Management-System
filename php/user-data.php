<?php
    session_start();
    include "../db/festivio-db.php";
    header('Content-Type: application/json');

    if (!isset($_SESSION["logged-in"])) {
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }

    $username = $_SESSION["username"] ?? '';

    if (!$username) {
        echo json_encode(["error" => "No username in session"]);
        exit();
    }

    $sql = "SELECT name, username, email, phone_number, dob, nid_number, address 
            FROM participants WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(["error" => "Prepare failed: " . $conn->error]);
        exit();
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No user found"]);
    }

    $stmt->close();
    $conn->close();
?>