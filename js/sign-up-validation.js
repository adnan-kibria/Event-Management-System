function vName(){
    const fname = document.getElementById("fname").value.trim();
    const errorName = document.getElementById("errorName");
    errorName.innerHTML = "";

    if(fname === "" || lname === ""){
        errorName.innerHTML = "Please enter your full name!";
        return false;
    }
    else if(!fname.match(/^[A-Za-z]+$/) || !lname.match(/^[A-Za-z]+$/)){
        errorName.innerHTML = "Please enter a valid name!";
        return false;
    }
    return true;
}
function vUname(){
    const uname = document.getElementById("uname").value.trim();
    const errorUname = document.getElementById("errorUname");
    errorUname.innerHTML = "";

    if(uname === ""){
        errorUname.innerHTML = "Please enter a username!";
        return false
    }
    else if(!uname.match(/^[a-zA-Z0-9]+$/)){
        errorUname.innerHTML = "Username can only contain letters and numbers!";
        return false;
    }
    return true;
}
function vEmail(){
    const email = document.getElementById("email").value.trim();
    const errorEmail = document.getElementById("errorEmail");
    errorEmail.innerHTML = "";

    if(email === ""){
        errorEmail.innerHTML = "Please enter your email!";
        return false
    }
    else if(!email.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)){
        errorEmail.innerHTML = "Please enter a valid email!";
        return false;
    }
    return true;
}
function vPhone(){
    const phone = document.getElementById("phone").value.trim();
    const errorPhone = document.getElementById("errorPhone");
    errorPhone.innerHTML = "";

    if(phone === ""){
        errorPhone.innerHTML = "Please enter your phone number!";
        error = true;
    }
    else if(!phone.match(/^[0-9]{10}$/)){
        errorPhone.innerHTML = "Please enter a valid phone number!";
        error = true;
    }
}
