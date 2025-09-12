<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Pass</title>
    <link rel="stylesheet" href="../css/forget.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create New Password</h2>
            <form id="forget" action="../php/forger-pass.php" method="POST">
                <input type="text" id="username" name="username" placeholder="username">
                <span id="username-error" class="error-message"></span>
                <input type="password" id="newpass" name="newpass" placeholder="Enter new password">
                <span id="newpass-error" class="error-message"></span>
                <input type="password" id="confirm-pass" name="confirmpass" placeholder="Re-enter password">
                <span id="confirmpass-error" class="error-message"></span><br>
                <div class="sign-in">
                    <a href="./sign-up-sign-in.php">Sign In</a>
                </div>
                <button type="submit" id="forget-btn" class="submit-btn" name="forget">Update</button>
            </form>
        </div>
    </div>
    <script src="../js/forget.js"></script>
</body>
</html>