<?php
    include "../php/check-auth.php";

    if(!isset($_SESSION["logged-in"]) || $_SESSION["role"] !== "admin"){
        header("Location: ../view/sign-up-sign-in.php");
        exit();
    }

    if($_SESSION["role"] !== "admin"){
        header("Location: ../view/participant-dashboard.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    <link rel="stylesheet" href="../css/across-style.css">
</head>
<body>
    <div class="side-nav">
        <h2>Announcement</h2>
        <hr>
        <ul>
            <li><a href="./admin-dashboard.php">Home</a></li>
            <li><a class="active" href="./user-management.php">User Management</a></li>
            <li><a href="./event-management.php">Event Management</a></li>
            <li><a href="./reg-management.php">Ticket Management</a></li>
            <li><a href="./event-report.php">Event Report</a></li>
            <li><a href="./announcement.php">Announcement</a></li>
        </ul>
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
    </div>
</body>
</html>