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
    <title>Profile</title>
    <link rel="stylesheet" href="../css/across-style.css">
    <link rel="stylesheet" href="../css/admin-profile.css">
</head>
<body>
    <div class="side-nav">
        <div class="top-section">
            <h2>Profile</h2>
            <hr>
            <ul>
                <li><a href="./admin-dashboard.php">Home</a></li>
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
        <div class="container">
            <div class="heading">
                <h2>Security</h2>
            </div>
            <div class="tbody">
                <table>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="newpass" id="newpass"></td>
                    </tr>
                    <tr>
                        <td>Confirm Pass</td>
                        <td><input type="password" name="confirmpass" id="confirmpass"></td>
                    </tr>
                </table>
                <button id="update">Update</button>
            </div>
        </div>
       </div>
    </div>
    <script src="../js/admin-profile.js"></script>
</body>
</html>