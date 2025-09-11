<?php
    include "../db/festivio-db.php";

    if(isset($_POST['event-id'])){
        $eventID = $_POST['event-id'];
        $sql = "DELETE FROM events WHERE event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $eventID);
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