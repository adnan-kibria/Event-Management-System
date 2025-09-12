<?php
    include "../db/festivio-db.php";

    header('Content-Type: application/json');

    if(isset($_POST['reg_id'], $_POST['status'])){
        $reg_id = $_POST['reg_id'];
        $status = $_POST['status'];

        if($status === 'approved'){
            $status = 'Approved';
        } elseif($status === 'rejected'){
            $status = 'Rejected';
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
            exit();
        }

        $sql = "UPDATE registrations SET status = ? WHERE reg_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $reg_id);

        if($stmt->execute()){
            echo json_encode(['success' => true, 'message' => 'Registration updated successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
?>