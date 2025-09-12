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
    <title>Registration Management</title>
    <link rel="stylesheet" href="../css/across-style.css">
    <link rel="stylesheet" href="../css/reg.css">
</head>
<body>
    <div class="side-nav">
        <div class="top-section">
            <h2>Registration Management</h2>
            <hr>
            <ul>
                <li><a href="./admin-dashboard.php">Home</a></li>
                <li><a href="./user-management.php">User Management</a></li>
                <li><a href="./event-management.php">Event Management</a></li>
                <li><a class="active" href="./reg-management.php">Registration Management</a></li>
                <li><a href="./event-report.php">Event Report</a></li>
                <li><a href="./announcement.php">Announcement</a></li>
            </ul>
        </div>
        <div class="bottom-section">
            <hr>
            <button onclick="location.href='../php/Sign out.php'">Sign out</button>
        </div>
    </div>
    <div class="main">
        <div class="top-bar">
            <div class="top">
                <div class="search">
                    <input type="text" placeholder="Search...">
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
                    <div class="wrap">
                        <a href="../view/admin-profile.php"><div class="profile">
                            <img src="../images/admin-dp.jpg" alt="admin-dp">
                            <span><?php echo $_SESSION["name"]; ?></span>
                        </div></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="fixed-content">
                <h2>Registration Management</h2>
                <hr>
                <div class="table-container">
                    <table id="reg-table">
                        <thead>
                            <tr>
                                <th>Registration ID</th>
                                <th>Event ID</th>
                                <th>Participant ID</th>
                                <th>Registration Date</th>
                                <th>Status</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="reg-data">                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/reg.js"></script>
</body>
</html>