<?php
    include "../db/festivio-db.php";

    $sql = "SELECT * FROM participants";
    $result = $conn->query($sql);
    if($result){
        $users = array();
        while($row = $result->fetch_assoc()){
            $users[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($users);
    }
    else{
        echo "0 results";
    }
?>