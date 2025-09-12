<?php
     include '../db/festivio-db.php';
     header('Content-Type: application/json');

     function ioSummary($conn, $event_id, $report_type, $report_date, $total){
        $sql = "SELECT id FROM event_report WHERE event_id = ? AND report_type = ? AND report_date =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $event_id, $report_type, $report_date);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $updateSql = "UPDATE event_report SET total_reg = ? WHERE event_id = ? AND report_type = ? AND report_date = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("issi", $total, $event_id, $report_type, $report_date);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            $insertSql = "INSERT INTO event_report (event_id, report_type, report_date, total_reg) VALUES (?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param("issi", $event_id, $report_type, $report_date, $total);
            $insertStmt->execute();
            $insertStmt->close();
        }
     }

     $event_res = $conn->query("SELECT id FROM events");
     $event = $event_res->fetch_all(MYSQLI_ASSOC);
        foreach($event as $e){
            $event_id = $e['id'];

            $daily_res = $conn->query("SELECT COUNT(*) AS total FROM registrations WHERE event_id = $event_id AND DATE(created_at) = CURDATE()");
            $daily_data = $daily_res->fetch_assoc();
            ioSummary($conn, $event_id, 'Daily', date('Y-m-d'), $daily_data['total']);
    
            $weekly_res = $conn->query("SELECT COUNT(*) AS total FROM registrations WHERE event_id = $event_id AND YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)");
            $weekly_data = $weekly_res->fetch_assoc();
            ioSummary($conn, $event_id, 'Weekly', date('Y-m-d'), $weekly_data['total']);
    
            $monthly_res = $conn->query("SELECT COUNT(*) AS total FROM registrations WHERE event_id = $event_id AND MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())");
            $monthly_data = $monthly_res->fetch_assoc();
            ioSummary($conn, $event_id, 'Monthly', date('Y-m-d'), $monthly_data['total']);

            $yearly_res = $conn->query("SELECT COUNT(*) AS total FROM registrations WHERE event_id = $event_id AND YEAR(created_at) = YEAR(CURDATE())");
            $yearly_data = $yearly_res->fetch_assoc();
            ioSummary($conn, $event_id, 'Yearly', date('Y-m-d'), $yearly_data['total']);
        }

        $report_summary = $conn->query("SELECT e.event_title, r.report_type, r.report_date, r.total_registration
                                FROM event_report r 
                                JOIN events e ON r.event_id = e.event_id
                                ORDER BY r.created_at DESC, r.event_id ASC");


        $reports = $report_summary->fetch_all(MYSQLI_ASSOC);
        echo json_encode($reports);
?>