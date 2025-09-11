<?php
    include "../db/festivio-db.php";

    if(isset($_POST['id'])){
        $userID = $_POST['id'];
        $sql = "DELETE FROM participants WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $result = $stmt->execute();
        if($result){
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
        $stmt->close();
    }
    header('Content-Type: application/json');
    echo json_encode(["success" => false]);
    $conn->close();
?>