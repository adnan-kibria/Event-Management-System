const wrapper = document.getElementById("wrapper");
const toggleBtn = document.getElementById("switch-to-sign-up");
const toggleHeading = document.getElementById("toggle-heading");
const toggleText = document.getElementById("toggle-text");

toggleBtn.addEventListener("click", () => {
    wrapper.classList.toggle("active");

    if(wrapper.classList.contains("active")) {
        toggleHeading.innerHTML = "Already have an Account?";
        toggleText.innerHTML = "Sign in now to access your account!";
        toggleBtn.innerHTML = "Sign In";
    } else {
        toggleHeading.innerHTML = "Don't you have an Account?";
        toggleText.innerHTML = "Sign up now to create an account!";
        toggleBtn.innerHTML = "Sign Up";
    }
});

function validateName(){
    const name = document.getElementById("name").value.trim();
    const nameError = document.getElementById("name-error");
    nameError.innerHTML = "";

    if(name === ""){
        nameError.innerHTML = "Name is required";
        return false;
    }
    else if(!name.match(/^[A-Za-z\s]+$/)){
        nameError.innerHTML = "Name can only contain letters and spaces";
        return false;
    }
    return true;
}
function validateUsername(){
    const username = document.getElementById("username").value.trim();
    const usernameError = document.getElementById("username-error");
    usernameError.innerHTML = "";

    if(username === ""){
        usernameError.innerHTML = "Username is required";
        return false;
    }
    else if(!username.match(/^[A-Za-z0-9_]+$/)){
        usernameError.innerHTML = "Username can only contain letters, numbers, and underscores";
        return false;
    }
    return true;
}
function validateEmail(){
    const email = document.getElementById("email").value.trim();
    const emailError = document.getElementById("email-error");
    emailError.innerHTML = "";

    if(email === ""){
        emailError.innerHTML = "Email is required";
        console.log("here");
        return false;
    }
    else if(!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
        emailError.innerHTML = "Invalid email format";
        return false;
    }
    return true;
}
function validatePassword(){
    const password = document.getElementById("password-sign-up").value.trim();
    const passwordError = document.getElementById("password-error");
    passwordError.innerHTML = "";

    if(password === ""){
        passwordError.innerHTML = "Password is required";
        return false;
    }
    else if(password.length < 8){
        passwordError.innerHTML = "Password must be at least 8 characters long";
        return false;
    }
    return true;
}
function validateConfirmPassword(){
    const password = document.getElementById("password-sign-up").value.trim();
    const confirmPassword = document.getElementById("confirm-password").value.trim();
    const confirmPasswordError = document.getElementById("confirm-password-error");
    confirmPasswordError.innerHTML = "";

    if(confirmPassword === ""){
        confirmPasswordError.innerText = "Confirm Password is required";
        return false;
    }
    else if(confirmPassword !== password){
        confirmPasswordError.innerHTML = "Passwords do not match";
        return false;
    }
    return true;
}
function validateTerms(){
    const terms = document.getElementById("terms").checked;
    const termsError = document.getElementById("terms-error");
    termsError.innerHTML = "";

    if(!terms){
        termsError.innerHTML = "You must agree to the terms and conditions";
        return false;
    }
    return true;
}

document.getElementById("sign_up").addEventListener("submit", function(event){
    // event.preventDefault();
    if(!validateName() && !validateUsername() && !validateEmail() && !validatePassword() && !validateConfirmPassword() && !validateTerms() && !validateTerms()){
        event.preventDefault(); 
    }
    if(!validateName() || !validateUsername() || !validateEmail() || !validatePassword() || !validateConfirmPassword() || !validateTerms() || !validateTerms()){
        event.preventDefault();
    }
    // return true;
});

function validateUsernameEmail(){
    const username_email = document.getElementById("email-username").value.trim();
    const username_email_error = document.getElementById("email-username-error");
    username_email_error.innerHTML = "";

    if(username_email === ""){
        username_email_error.innerHTML = "Email or Username is required";
        return false;
    }
    return true;
}
function validateSignInPassword(){
    const password = document.getElementById("password-sign-in").value.trim();
    const passwordError = document.getElementById("sign-in-password-error");
    passwordError.innerHTML = "";

    if(password === ""){
        passwordError.innerHTML = "Password is required";
        return false;
    }
    else if(password.length < 8){
        passwordError.innerHTML = "Password must be at least 8 characters long";
        return false;
    }
    return true;
}
document.getElementById("sign_in").addEventListener("submit", function(event){
    // event.preventDefault();
    if(!validateUsernameEmail() && !validateSignInPassword()){
        event.preventDefault();
    }
    if(!validateUsernameEmail() || !validateSignInPassword()){
        event.preventDefault();
    }
    // return true;
});
