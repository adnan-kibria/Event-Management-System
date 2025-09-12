<?php
    include "../db/festivio-db.php";

    $sql = "SELECT * FROM events";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result){
        $events = array();
        while($row = $result->fetch_assoc()){
            $events[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($events);
    }
    else{
        echo "0 results";
    }
    $stmt->close();
    $conn->close();
?>