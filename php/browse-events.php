<?php
include "../db/festivio-db.php";
$sql = "SELECT * FROM events ORDER BY event_id ASC";
$result = $conn->query($sql);
$events = [];
if ($result->num_rows > 0) {
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
                <td>
                    <form method='POST' action='../view/register-events.php'>
                        <input type='hidden' name='event_id' value='" . $row['event_id'] . "'>
                        <button type='submit' class='register-button'>Register</button>
                    </form>
              </tr>";
    }
    
}
else {
    echo "<tr><td colspan='9'>No events found</td></tr>";
}
$conn->close();
?>