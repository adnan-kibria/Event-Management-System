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
    <title>Event Management</title>
    <link rel="stylesheet" href="../css/across-style.css">
    <link rel="stylesheet" href="../css/event-management.css">
</head>
<body>
    <div class="side-nav">
        <div class="top-section">
            <h2>Event Management</h2>
            <hr>
            <ul>
                <li><a href="./admin-dashboard.php">Home</a></li>
                <li><a href="./user-management.php">User Management</a></li>
                <li><a class="active" href="./event-management.php">Event Management</a></li>
                <li><a href="./reg-management.php">Registration Management</a></li>
                <li><a href="./event-report.php">Event Report</a></li>
                <li><a href="./announcement.php">Announcement</a></li>
            </ul>
        </div>
        <div class="bottom-section">
            <hr>
            <button onclick="location.href='../php/logout.php'">Logout</button>
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
                    <h2>Events</h2>
                    <button id="add-event-btn">Add Event</button>
                </div>
                <hr>
                <div class="table-container">
                    <table id="event-table">
                        <thead>
                            <tr>
                                <th rowspan="2">ID</th>
                                <th rowspan="2">Event Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th rowspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="event-data">                        
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-one" id="add-event-modal">
                <div class="modal-content-one" id="detail-content-one">
                    <h2>Add Event</h2>
                    <hr>
                    <div class="details-container" id="details-container">
                        <form action="../php/add-event.php" method="POST" id="add-event-form">
                            <label for="event-title">Event Title</label><br>
                            <input type="text" id="event-title" name="event-title"><br>

                            <label for="description">Description</label><br>
                            <textarea id="description" name="description" rows="10" cols="66"></textarea><br>

                            <label for="start-date">Start Date</label>
                            <label for="end-date">End Date</label><br>
                            <input type="date" id="start-date" name="start-date">
                            <input type="date" id="end-date" name="end-date"><br>

                            <label for="venue">Venue</label><br>
                            <input type="text" id="venue" name="venue"><br>

                            <label for="category">Category</label>
                            <label for="capacity">Capacity</label><br>

                            <select id="category" name="category">
                                <option value="">Select</option>
                                <option value="Music">Music</option>
                                <option value="Art">Art</option>
                                <option value="Technology">Technology</option>
                                <option value="Sports">Sports</option>
                                <option value="Education">Education</option>
                            </select>

                            <input type="number" id="capacity" name="capacity" min="50" max="5000"><br>
                            <span id="error-message"></span><br>

                            <button type="submit">Add Event</button>
                            <button type="button" id="close-add-modal">Cancel</button>
                        </form>
                    </div>
                </div>      
            </div>
            <div class="modal-two" id="show-event-modal">
                <div class="modal-content-two" id="detail-content-two">
                    <div class="details-container" id="details-container">
                        
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <script src="../js/add-event-v.js"></script>
    <script src="../js/event-manage.js"></script>
</body>
</html>