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
    <link rel="stylesheet" href="../css/announcement.css">
</head>
<body>
    <div class="side-nav">
        <div class="top-section">
            <h2>Announcement</h2>
            <hr>
            <ul>
                <li><a href="./admin-dashboard.php">Home</a></li>
                <li><a href="./user-management.php">User Management</a></li>
                <li><a href="./event-management.php">Event Management</a></li>
                <li><a href="./reg-management.php">Registration Management</a></li>
                <li><a href="./event-report.php">Event Report</a></li>
                <li><a class="active" href="./announcement.php">Announcement</a></li>
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
            <div class="fixed-content">
                <div class="header-section">
                    <h2>Announcements</h2>
                    <button id="add-announcement-btn">Add Announcement</button>
                </div>
                <hr>
                <div class="table-container">
                    <table id="announcement-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Announcement Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="announcement-data">                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-one" id="add-announcement-modal">
                <div class="modal-content-one" id="detail-content-one">
                    <h2>Add Announcement</h2>
                    <hr>
                    <div class="details-container" id="details-container">
                        <form action="../php/add-announce.php" method="POST" id="add-announcement-form">
                            <label for="announce-title">Announcement Title</label><br>
                            <input type="text" id="announce-title" name="announce-title"><br>

                            <label for="body">Body</label><br>
                            <textarea id="body" name="body" rows="10" cols="66"></textarea><br>

                            <span id="error-message"></span><br>

                            <button type="submit">Add</button>
                            <button type="button" id="close-add-modal">Cancel</button>
                        </form>
                    </div>
                </div>      
            </div>
            <div class="modal-two" id="show-announcement-modal">
                <div class="modal-content-two" id="detail-content-two">
                    <div class="details-container" id="details-container">
                        
                    </div>
                </div>      
            </div>
        </div>  
    </div>
    <script src="../js/add-announce.js"></script>
    <script src="../js/announce.js"></script>
</body>
</html>