document.addEventListener("DOMContentLoaded", function(){
    const event_data = document.getElementById("event-data");
    const add_event_btn = document.getElementById("add-event-btn");
    const close_add_event = document.getElementById("close-add-modal");
    const modal_one = document.querySelector(".modal-one");
    const modal_two = document.querySelector(".modal-two");

    fetchUserData();

    function fetchUserData(){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/event-manage.php", true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                try{
                    var data = JSON.parse(xhr.responseText);
                    event_data.innerHTML = "";
                    data.forEach(function(event){
                        var row = document.createElement("tr");
                        row.dataset.user = JSON.stringify(event);
                        row.innerHTML = `<td>${event.event_id}</td>
                                        <td>${event.event_title}</td>
                                        <td>${event.start_date}</td>
                                        <td>${event.end_date}</td>
                                        <td>${event.status}</td>
                                        <td class="btn">
                                            <button class="view-btn">View</button>
                                        </td>`;
                        event_data.appendChild(row);
                    });
                } catch(e){
                    console.error("Error parsing JSON:", e);
                }
            }
        };
        xhr.send();
    }

    add_event_btn.addEventListener("click", function(){
        modal_one.style.display = "flex";
    });

    close_add_event.addEventListener("click", function(){
        modal_one.style.display = "none";
    });


    event_data.addEventListener("click", function(e){
        if(e.target.classList.contains("view-btn")){
            const row = e.target.closest("tr");
            const event = JSON.parse(row.dataset.user);
            displayEventDetails(event, row);
        }
    });


    function displayEventDetails(event, row){
        const eventID = event.event_id;
        const detailContent = document.getElementById("detail-content-two");
        detailContent.innerHTML = `
            <h2>Event Details</h2>
            <hr>
            <label for="event-id"><strong>Event ID</strong></label><br>
            <input type="text" id="event-id" value="${event.event_id}" disabled><br>
            <label for="event-title"><strong>Event Title</strong></label><br>
            <input type="text" id="event-title" value="${event.event_title}"><br>
            <label for="description"><strong>Description</strong></label><br>
            <textarea id="event-description" rows="10" cols="66">${event.event_description}</textarea><br>
            <label for="start-date"><strong>Start Date</strong></label>
            <label for="end-date"><strong>End Date</strong></label><br>
            <input type="date" id="start-date" value="${event.start_date}">
            <input type="date" id="end-date" value="${event.end_date}"><br>
            <label for="venue"><strong>Venue</strong></label><br>
            <input type="text" id="venue" value="${event.venue}"><br>
            <label for="categoryy"><strong>Category</strong></label>
            <label for="capacityy"><strong>Capacity</strong></label>
            <label for="statuss"><strong>Status</strong></label><br>
            <select id="categoryy">
                <option value="Music" ${event.category === "Music" ? "selected" : ""}>Music</option>
                <option value="Art" ${event.category === "Art" ? "selected" : ""}>Art</option>
                <option value="Technology" ${event.category === "Technology" ? "selected" : ""}>Technology</option>
                <option value="Sports" ${event.category === "Sports" ? "selected" : ""}>Sports</option>
                <option value="Education" ${event.category === "Education" ? "selected" : ""}>Education</option>
            </select>
            <input type="number" id="capacityy" value="${event.capacity}">
            <select id="statuss">
                <option value="Ongoing" ${event.status === "Ongoing" ? "selected" : ""}>Ongoing</option>
                <option value="Completed" ${event.status === "Completed" ? "selected" : ""}>Completed</option>
            </select><br>
            <button id="update-btn" class="update-btn">Update</button>
            <button id="delete-btn" class="delete-btn">Delete</button>
            <button id="close-btn" class="close-btn">Close</button>`;

        function updateEvent(eventID, updatedData){
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../php/update-event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function(){
                if(xhr.readyState === 4 && xhr.status === 200){
                    var response = JSON.parse(xhr.responseText);
                    if(response.success){
                        fetchUserData();
                        modal_two.style.display = "none";
                    } else {
                        alert("Error updating user.");
                    }
                }
            };
            console.log(updatedData);
            xhr.send("event-id=" + eventID + "&" + new URLSearchParams(updatedData).toString());
        }

        function deleteEvent(eventID, row){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/delete-event.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                var response = JSON.parse(xhr.responseText);
                if(response.success){
                    row.remove();
                    modal_two.style.display = "none";
                } else {
                    alert("Error deleting user.");
                }
            }
        };
        xhr.send("event-id=" + eventID);
    }

        const updateBtn = document.querySelector("#update-btn");
        updateBtn.addEventListener("click", () => {
            var updatedData = {
                'event-title': modal_two.querySelector("#event-title").value,
                'description': modal_two.querySelector("#event-description").value,
                'start-date': modal_two.querySelector("#start-date").value,
                'end-date': modal_two.querySelector("#end-date").value,
                'venue': modal_two.querySelector("#venue").value,
                'category': modal_two.querySelector("#categoryy").value,
                'capacity': modal_two.querySelector("#capacityy").value,
                'status': modal_two.querySelector("#statuss").value
            };
            updateEvent(eventID, updatedData);
        });
        const deleteBtn = document.getElementById("delete-btn");
        deleteBtn.addEventListener("click", () =>{
            if(confirm("Are you sure you want to delete this event?")){
                deleteEvent(eventID, row);
            }
        });
        const closeBtn = document.getElementById("close-btn");
        closeBtn.addEventListener("click", () =>{
            modal_two.style.display = "none";
        });

        modal_two.style.display = "flex";
    }

});