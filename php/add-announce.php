<?php

    include "../db/festivio-db.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $announce_title = trim($_POST['announce-title'] ?? '');
        $body = trim($_POST['body'] ?? '');

        if(empty($announce_title) || empty($body)){
            echo "Fill up the form correctly!";
        }
        else{
            $sql = "INSERT INTO announcements (announcement_title, body) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $announce_title, $body);

            if($stmt->execute() === TRUE){
                echo "New record created successfully";
                header("Location: ../view/announcement.php");
                exit();
            }
            else{
                echo "Error: " .$stmt->error;
            }
            $stmt->close();
            $conn->close();
        } 
    }
?>
        $capacity = trim($_POST['capacity'] ?? '');
        $status = trim($_POST['status'] ?? '');

        $status = "ongoing";

        if(empty($event_title) || empty($description) || empty($start_date) || empty($end_date) || empty($venue) || empty($category) || empty($capacity)){
            echo "Fill up the form correctly!";
        }
        else if($capacity < 50 || $capacity > 5000){
            echo "Capacity must be between 50 and 5000!";
        }
        else if(strtotime($start_date) > strtotime($end_date)){
            echo "Start date cannot be later than end date.";
        }
        else{
            $sql = "INSERT INTO events (event_title, event_description, start_date, end_date, venue, category, capacity, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssis", $event_title, $description, $start_date, $end_date, $venue, $category, $capacity, $status);

            if($stmt->execute() === TRUE){
                echo "New record created successfully";
                header("Location: ../view/event-management.php");
                exit();
            }
            else{
                echo "Error: " .$stmt->error;
            }
            $stmt->close();
            $conn->close();
        } 
    }
?>