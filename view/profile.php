<?php
    include "../php/check-auth.php";

    if(!isset($_SESSION["logged-in"]) || $_SESSION["role"] !== "participant"){
        header("Location: ../view/sign-up-sign-in.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user-dashboard.css">
    <link rel="stylesheet" href="../css/user-profile.css">
   
    

</head>
<body>
    <div class= "top-bar">
        <div class = "nav-links">
            <a href="./user-dashboard.php">Home</a>
            <a href="./browse-events.php">Browse Events</a>
            <a href="./register-events.php">Register Events</a>
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
      <div class="main-content">
        <div class="container">
            <div class="heading">
                <h2>Profile</h2>
            </div>
            <div class="tbody">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" id="full-name" name="name"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" id="username" name="username" readonly></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" id="email" name="email" readonly></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><input type="text" id="phone-no" name="phone-no"></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><input type="date" name="dob" id="dob"></td>
                    </tr>
                    <tr>
                        <td>NID Number</td>
                        <td><input type="text" name="nid" id="nid"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="address" id="address" rows="2" cols="30"></textarea></td>
                    </tr>
                </table>
                <button id="changes">Make Change</button>
            </div>
        </div>

    <script src="../js/profile.js"></script>
    </body>
    </html>


