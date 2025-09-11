<?php

    include "../db/festivio-db.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $event_title = trim($_POST['event-title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $start_date = trim($_POST['start-date'] ?? '');
        $end_date = trim($_POST['end-date'] ?? '');
        $venue = trim($_POST['venue'] ?? '');
        $category = trim($_POST['category'] ?? '');
        $capacity = trim($_POST['capacity'] ?? '');

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
            $status = "ongoing";
            $sql = "INSERT INTO events (event_title, event_description, start_date, end_date, venue, category, capacity, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $event_title, $description, $start_date, $end_date, $venue, $category, $capacity, $status);

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