<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up & Sign-In</title>
    <link rel="stylesheet" href="../css/sign-up-sign-in.css">
</head>
<body>
    <div class="container" id="wrapper">
        <div class="form-container sign-in">
            <h2>Sign In</h2>
            <form id="sign_in" action="../php/sign-in.php" method="POST">
                <input type="text" id="email-username" name="email-username" placeholder="Email or Username">
                <span id="email-username-error" class="error-message"></span>
                <input type="password" id="password-sign-in" name="password-sign-in" placeholder="Password">
                <span id="sign-in-password-error" class="error-message"></span>
                <div class="forget-password">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" id="sign-in-btn" class="submit-btn" name="sign-in">Sign In</button>
            </form>
        </div>
        <div class="form-container sign-up">
            <h2>Sign Up</h2>
            <form id="sign_up" action="../php/sign-up.php" method="POST">
                <input type="text" id="name" name="name" placeholder="Name">
                <span id="name-error" class="error-message"></span>
                <input type="text" id="username" name="username" placeholder="Username">
                <span id="username-error" class="error-message"></span> 
                <input type="email" id="email" name="email" placeholder="Email">
                <span id="email-error" class="error-message"></span>
                <input type="password" id="password-sign-up" name="password-sign-up" placeholder="Password">
                <span id="password-error" class="error-message"></span>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                <span id="confirm-password-error" class="error-message"></span>
                <div class="terms">
                    <input type="checkbox" id="terms" name="terms"> I agree to the <a href="#">Terms and Conditions</a>
                </div>
                <span id="terms-error" class="error-message"></span>
                <button type="submit" id="sign-up-btn" class="submit-btn" name="sign-up">Sign Up</button>
            </form>
        </div>
        <div class="toggle-container">
            <h2 id="toggle-heading">Don't you have an Account?</h2>
            <p id="toggle-text">Sign up now to create an account!</p>
            <button class="switch-btn" id="switch-to-sign-up">Sign Up</button>
        </div>
    </div>
    <script src="../js/sign-up-sign-in.js"></script>
</body>
</html>