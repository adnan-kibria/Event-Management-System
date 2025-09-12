<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user-dashboard.css">
    <link rel="stylesheet" href="../css/browse-events.css">
    
   
    

</head>
<body>
    <div class= "top-bar">
        <div class = "nav-links">
            <a href="./user-dashboard.php">Home</a>
            <a href="./browse-events.php">Browse Events</a>
            <a href="./register-events.php" class="active">Registere Events</a>
            <a href="./profile.php">Profile</a>
        </div>
        <div class="search">
            <input type="text" placeholder="Search events...">
            <button>Search</button>
        </div>
        <div class="user-info">
             <button onclick="location.href='../php/sign-out.php'" class="button">Logout</button>
        </div>
    </div>
    <div class="page-content">
        <h2>Registered Events</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Venue</th>
                <th>Category</th>
                <th>Capacity</th>
                <th>Status</th>
                
            </tr>
             <?php
                  include "../php/register-events.php";
               ?>
    </div>
        </table>
    <script src="../js/user-dashboard.js"></script>
</body>
</html>
