<?php
    session_start();
    include "../db/festivio-db.php";

    if (!isset($_SESSION["logged-in"])) {
        echo "Unauthorized!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo "Invalid request method";
        exit();
    }

    $name    = $_POST['name'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $dob     = $_POST['dob'] ?? '';
    $nid     = $_POST['nid'] ?? '';
    $address = $_POST['address'] ?? '';

    $username = $_SESSION["username"];

    $stmt = $conn->prepare("UPDATE participants SET name=?, phone_number=?, dob=?, nid_number=?, address=? WHERE username=?");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit();
    }

    $stmt->bind_param("ssssss", $name, $phone, $dob, $nid, $address, $username);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Profile updated successfully!";
        } else {
            echo "No changes made or user not found.";
        }
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>