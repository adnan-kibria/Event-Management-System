function form_validation(){
    const eventTitle = document.getElementById("event-title").value.trim();
    const description = document.getElementById("description").value.trim();
    const startDate = document.getElementById("start-date").value;
    const endDate = document.getElementById("end-date").value;
    const venue = document.getElementById("venue").value.trim();
    const category = document.getElementById("category").value.trim();
    const capacity = document.getElementById("capacity").value.trim();

    const error_msg = document.getElementById("error-message");
    error_msg.innerHTML = "";

    if(eventTitle === "" || description === "" || startDate === "" || endDate === "" || venue === "" || category === "" || capacity === ""){
        error_msg.innerHTML = "Please fill in all fields correctly.";
        return false;
    }

    if(isNaN(capacity) || capacity < 50 || capacity > 5000){
        error_msg.innerHTML = "Capacity must be a number between 50 and 5000.";
        return false;
    }

    if(new Date(startDate) > new Date(endDate)){
        error_msg.innerHTML = "Start date cannot be later than end date.";
        return false;
    }
    return true;
}
document.getElementById("add-event-form").addEventListener("submit", function(event){
    if(!form_validation()){
       event.preventDefault();
    }
});