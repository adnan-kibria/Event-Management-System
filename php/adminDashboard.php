<?php
    include "../db/festivio-db.php";

    $total_users = 0;
    $total_events = 0;
    $total_registrations = 0;
    $sql = "SELECT COUNT(*) as total_users FROM participants";
    $result = $conn->query($sql);
    if($result){
        $row = $result->fetch_assoc();
        $total_users = $row['total_users'];
    }
    else{
        echo "0";
    }
    $sql = "SELECT COUNT(*) as total_events FROM events";
    $result = $conn->query($sql);
    if($result){
        $row = $result->fetch_assoc();
        $total_events =  $row['total_events'];
    }
    else{
        echo "0";
    }
    $sql = "SELECT COUNT(*) as total_registrations FROM registrations";
    $result = $conn->query($sql);
    if($result){
        $row = $result->fetch_assoc();
        $total_registrations = $row['total_registrations'];
    }
    else{
        echo "0";
    }

    header('Content-Type: application/json');
    echo json_encode([
        'total_users' => $total_users,
        'total_events' => $total_events,
        'total_registrations' => $total_registrations
    ]);
    $conn->close();
?>