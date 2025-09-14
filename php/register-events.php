<?php
session_start();
include "../db/festivio-db.php";

if (!isset($_SESSION["logged-in"])) {
    die("You must be logged in to view registered events.");
}

$username = $_SESSION["username"] ?? null;


$getIdSql = "SELECT id FROM participants WHERE username = ?";
$getIdStmt = $conn->prepare($getIdSql);
$getIdStmt->bind_param("s", $username);
$getIdStmt->execute();
$getIdResult = $getIdStmt->get_result();

if ($getIdResult->num_rows === 0) {
    die("Participant not found.");
}

$participant = $getIdResult->fetch_assoc();
$participant_id = $participant['id'];
$getIdStmt->close();


$sql = "SELECT e.*, r.status 
        FROM events e
        JOIN registrations r ON e.event_id = r.event_id
        WHERE r.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $participant_id);
$stmt->execute();
$result = $stmt->get_result();


if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['event_title']) . "</td>
                <td>" . htmlspecialchars($row['event_description']) . "</td>
                <td>" . $row['start_date'] . "</td>
                <td>" . $row['end_date'] . "</td>
                <td>" . htmlspecialchars($row['venue']) . "</td>
                <td>" . htmlspecialchars($row['category']) . "</td>
                <td>" . $row['capacity'] . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No registrations found.</td></tr>";
}


$stmt->close();
$conn->close();
?>
