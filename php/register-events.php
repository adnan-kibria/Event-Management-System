<?php
 include"../db/festivio-db.php";
 session_start();
  $participent_id = $_SESSION['participent_id'] ?? 2;
   $message = $_SESSION['msg'] ?? '';
    unset($_SESSION['msg']);
    $sql = "SELECT * FROM events WHERE event_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $participent_id);
    $stmt->execute();
    $result = $stmt->get_result();

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
                        
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No registrations found</td></tr>";
            }
        
    ?>
