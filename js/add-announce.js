function form_validation(){
    const announceTitle = document.getElementById("announce-title").value.trim();
    const body = document.getElementById("body").value.trim();

    const error_msg = document.getElementById("error-message");
    error_msg.innerHTML = "";

    if(announceTitle === "" || body === ""){
        error_msg.innerHTML = "Please fill in all fields correctly.";
        return false;
    }
    return true;
}
document.getElementById("add-announcement-form").addEventListener("submit", function(event){
    if(!form_validation()){
       event.preventDefault();
    }
});