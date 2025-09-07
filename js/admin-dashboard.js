var xhr = new XMLHttpRequest();
xhr.open("GET", "../php/adminDashboard.php", true);

xhr.onreadystatechange = function(){
    if(xhr.readyState === 4 && xhr.status === 200){
        try{
            var data = JSON.parse(xhr.responseText);
            document.getElementById("total-users").innerHTML = data.total_users;
            document.getElementById("total-events").innerHTML = data.total_events;
            document.getElementById("total-registrations").innerHTML = data.total_registrations;
        }
        catch(e){
            console.error("Error parsing JSON: ", e);
        }
    }
}

xhr.onerror = function(){
    console.error("Error fetching dashboard data");
}
xhr.send();