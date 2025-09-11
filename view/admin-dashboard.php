<?php
    include "../php/check-auth.php";

    if(!isset($_SESSION["logged-in"]) || $_SESSION["role"] !== "admin"){
        header("Location: ../view/sign-up-sign-in.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/across-style.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
</head>
<body>
    <div class="side-nav">
        <div class="top-section">
            <h2>Dashboard</h2>
            <hr>
            <ul>
                <li><a class="active" href="./admin-dashboard.php">Home</a></li>
                <li><a href="./user-management.php">User Management</a></li>
                <li><a href="./event-management.php">Event Management</a></li>
                <li><a href="./reg-management.php">Registration Management</a></li>
                <li><a href="./event-report.php">Event Report</a></li>
                <li><a href="./announcement.php">Announcement</a></li>
            </ul>
        </div>
        <div class="bottom-section">
            <hr>
            <button onclick="location.href='../php/sign-out.php'">Sign out</button>
        </div>
    </div>
    <div class="main">
       <div class="top-bar">
        <div class="top">
           <div class="search">
               <input type="text" placeholder="Search...">
               <button>Search</button>
           </div> 
        </div>
        <div class="bottom">
            <div class="user-intro">
                <img src="../images/admin-dp.jpg" alt="User Image">
                <div>
                    <p>Hi there,</p>
                    <h3><?php echo $_SESSION["name"]; ?>(@<?php echo $_SESSION["username"]; ?>)</h3>
                </div>
            </div>
            <div class="user-info">
                <button>Inbox</button>
                <div class="wrap">
                    <div class="profile">
                        <img src="../images/admin-dp.jpg" alt="admin-dp">
                        <span><?php echo $_SESSION["name"]; ?></span>
                    </div>
                </div>
           </div>
        </div>
       </div>
       <div class="main-content">
        <div class="contents">
            <div class="content">
                <h2>Total User</h2>
                <p id="total-users"></p>
            </div>
            <div class="content">
                <h2>Total Events</h2>
                <p id="total-events"></p>
            </div>
            <div class="content">
                <h2>Total Registration</h2>
                <p id="total-registrations"></p>
            </div>
        </div>
        <div class="announce">
            <h2>Announcements</h2>
            <hr>
            <div class="announce-list">
                <div class="announce-item">
                    <h3>New Event Added</h3>
                    <p>A new event "Tech Conference 2024" has been added.</p>
                </div>
                <div class="announce-item">
                    <h3>System Maintenance</h3>
                    <p>Scheduled maintenance on 15th March from 2 AM to 4 AM.</p>
                </div>
                <div class="announce-item">
                    <h3>User Feedback</h3>
                    <p>We value your feedback! Please fill out the survey.</p>
                </div>

            </div>
        </div>
       </div>
    </div>
    <script src="../js/admin-dashboard.js"></script>
</body>
</html>