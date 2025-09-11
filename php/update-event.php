<?php
    include "../db/festivio-db.php";

    if(isset($_POST['id']) && isset($_POST['event-name']) && isset($_POST['description']) && isset($_POST['start-date']) && isset($_POST['end-date']) && isset($_POST['venue']) && isset($_POST['category']) && isset($_POST['capacity']) && isset($_POST['status'])){
        $eventID = $_POST['id'];
        $eventTitle = $_POST['event-title'];
        $eventDescription = $_POST['description'];
        $startDate = $_POST['start-date'];
        $endDate = $_POST['end-date'];
        $venue = $_POST['venue'];
        $category = $_POST['category'];
        $capacity = $_POST['capacity'];
        $status = $_POST['status'];

        $sql = "UPDATE events SET event_title = ?, event_description = ?, start_date = ?, end_date = ?, venue = ?, category = ?, capacity = ?, status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $eventTitle, $eventDescription, $startDate, $endDate, $venue, $category, $capacity, $status, $eventID);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        if($result){
            echo json_encode(["success" => true]);
            exit();
        }
    }
    echo json_encode(["success" => false]);
    exit();
?>