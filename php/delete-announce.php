<?php
    include "../db/festivio-db.php";

    if(isset($_POST['announcement-id'])){
        $announcementID = $_POST['announcement-id'];
        $sql = "DELETE FROM announcements WHERE announcement_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $announcementID);
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