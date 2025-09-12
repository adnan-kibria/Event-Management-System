<?php
    include "../db/festivio-db.php";

    header('Content-Type: application/json');

    if(isset($_POST['event-id'])) {
        $eventID = $_POST['event-id'];
        $updates = [];
        $params = [];
        $types = "";

        if(isset($_POST['event-title'])) {
            $updates[] = "event_title = ?";
            $params[] = $_POST['event-title'];
            $types .= "s";
        }
        if(isset($_POST['description'])) {
            $updates[] = "event_description = ?";
            $params[] = $_POST['description'];
            $types .= "s";
        }
        if(isset($_POST['start-date'])) {
            $updates[] = "start_date = ?";
            $params[] = $_POST['start-date'];
            $types .= "s";
        }
        if(isset($_POST['end-date'])) {
            $updates[] = "end_date = ?";
            $params[] = $_POST['end-date'];
            $types .= "s";
        }
        if(isset($_POST['venue'])) {
            $updates[] = "venue = ?";
            $params[] = $_POST['venue'];
            $types .= "s";
        }
        if(isset($_POST['category'])) {
            $updates[] = "category = ?";
            $params[] = $_POST['category'];
            $types .= "s";
        }
        if(isset($_POST['capacity'])) {
            $updates[] = "capacity = ?";
            $params[] = $_POST['capacity'];
            $types .= "i";
        }
        if(isset($_POST['status'])) {
            $updates[] = "status = ?";
            $params[] = $_POST['status'];
            $types .= "s";
        }

        if(!empty($updates)) {
            $sql = "UPDATE events SET " . implode(", ", $updates) . " WHERE event_id = ?";
            $params[] = $eventID;
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
        echo json_encode(["success" => false, "error" => "Event ID not provided."]);
    }

    $conn->close();
?>