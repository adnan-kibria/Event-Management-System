<?php
    include "../db/festivio-db.php";

    if(isset($_POST['id'])){
        $eventID = $_POST['id'];
        $sql = "DELETE FROM events WHERE id = ?";
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