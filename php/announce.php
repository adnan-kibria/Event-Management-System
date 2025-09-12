<?php
    include "../db/festivio-db.php";

    $sql = "SELECT * FROM announcements";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result){
        $announcements = array();
        while($row = $result->fetch_assoc()){
            $announcements[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($announcements);
    }
    else{
        echo "0 results";
    }
    $stmt->close();
    $conn->close();
?>