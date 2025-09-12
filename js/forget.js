let users = [];

window.onload = function() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/forget-pass.php", true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200){
            try {
                users = JSON.parse(xhr.responseText);
            } catch(e){
                console.error("Error parsing JSON: ", e);
            }
        }
    };
    xhr.send();
};

function validation(){
    const username = document.getElementById("username").value.trim();
    const newpass = document.getElementById("newpass").value.trim();
    const confirmpass = document.getElementById("confirm-pass").value.trim();

    const username_error = document.getElementById("username-error");
    const newpass_error = document.getElementById("newpass-error");
    const confirmpass_error = document.getElementById("confirmpass-error");

    username_error.innerHTML = "";
    newpass_error.innerHTML = "";
    confirmpass_error.innerHTML = "";

    if(username === ""){
        username_error.innerHTML = "Username required";
        return false;
    }
    if(!users.includes(username)){
        username_error.innerHTML = "User not found";
        return false;
    }

    if(newpass === ""){
        newpass_error.innerHTML = "Password can't be empty";
        return false;
    }
    if(newpass.length < 8){
        newpass_error.innerHTML = "Password must be 8 characters long";
        return false;
    }

    if(confirmpass === ""){
        confirmpass_error.innerHTML = "Confirm password required";
        return false;
    }
    if(newpass !== confirmpass){
        confirmpass_error.innerHTML = "Passwords do not match";
        return false;
    }

    return true;
}

document.getElementById("forget").addEventListener("submit", function(event){
    event.preventDefault();

    if(validation()){
        const xhr = new XMLHttpRequest();
        const formData = new FormData(this);
        formData.append("forget", "1");

        xhr.open("POST", "../php/forget-pass.php", true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                try {
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message);
                    if(response.status === "success"){
                        window.location.href = "./sign-up-sign-in.php";
                    }
                } catch(e){
                    console.error("Error parsing JSON: ", e, xhr.responseText);
                }
            }
        };
        xhr.send(formData);
    }
});
