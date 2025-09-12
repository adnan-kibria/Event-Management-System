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

const announcement = document.querySelector(".announce-list");
const xhr1 = new XMLHttpRequest();
xhr1.open("GET", "../php/announce.php");
xhr1.onreadystatechange = function(){
    if(xhr1.readyState === 4 && xhr1.status === 200){
        try{
            let data = JSON.parse(xhr1.responseText);
            announcement.innerHTML = "";
            data.forEach(function(announce){
                let announce_item = document.createElement("div");
                announce_item.classList.add("announce-item");
                announce_item.innerHTML = `
                            <h3>${announce.announcement_title}</h3>
                            <p>${announce.body}</p>`;
                announcement.appendChild(announce_item);
            });
        }
        catch(e){
            console.error("Error parsing JSON: ", e);
        }
    }
}
xhr1.send();

