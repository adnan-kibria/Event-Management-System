<?php
    include "../db/festivio-db.php";
    header('Content-Type: application/json');

    $sql = "SELECT reg_id, event_id, participant_id, reg_date, status FROM registrations r
            JOIN participants p ON r.id = p.id
            JOIN events e ON r.event_id = e.event_id
            ORDER BY reg_date DESC";

    $result = $conn->query($sql);
    $registrations = [];
    while($row = $result->fetch_assoc()){
        $registrations[] = $row;
    }
    echo json_encode($registrations);
    $conn->close();
?>