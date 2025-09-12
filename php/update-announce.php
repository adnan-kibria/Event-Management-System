<?php
    include "../db/festivio-db.php";

    header('Content-Type: application/json');

    if(isset($_POST['announcement-id'])) {
        $announcementID = $_POST['announcement-id'];
        $updates = [];
        $params = [];
        $types = "";

        if(isset($_POST['announcement-title'])) {
            $updates[] = "announcement_title = ?";
            $params[] = $_POST['announcement-title'];
            $types .= "s";
        }
        if(isset($_POST['body'])) {
            $updates[] = "body = ?";
            $params[] = $_POST['body'];
            $types .= "s";
        }

        if(!empty($updates)) {
            $sql = "UPDATE announcements SET " . implode(", ", $updates) . " WHERE announcement_id = ?";
            $params[] = $announcementID;
            $types .= "i";

            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                echo json_encode(["success" => false, "error" => $conn->error]);
                exit();
            }

            $stmt->bind_param($types, ...$params);
            $result = $stmt->execute();
            
            if($result) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["success" => false, "error" => "No fields to update."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Announcement ID not provided."]);
    }

    $conn->close();
?>