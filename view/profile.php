<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user-dashboard.css">
   
    

</head>
<body>
    <div class= "top-bar">
        <div class = "nav-links">
            <a href="./user-dashboard.php">Home</a>
            <a href="./browse-events.php">Browse Events</a>
            <a href="./register-events.php">Registere Events</a>
            <a href="./profile.php" class="active">Profile</a>
        </div>
        <div class="search">
            <input type="text" placeholder="Search events...">
            <button>Search</button>
        </div>
        <div class="user-info">
             <button onclick="location.href='../php/sign-out.php'" class="button">Logout</button>
        </div>
    </div>
