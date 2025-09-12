<?php
    include "../db/festivio-db.php";

    $sql = "SELECT * FROM registrations";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result){
        $registrations = array();
        while($row = $result->fetch_assoc()){
            $registrations[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($registrations);
    }
    else{
        echo "0 results";
    }
    $stmt->close();
    $conn->close();
?>