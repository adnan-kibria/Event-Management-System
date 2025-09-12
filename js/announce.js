document.addEventListener("DOMContentLoaded", function(){
    const announcement_data = document.getElementById("announcement-data");
    const add_announcement_btn = document.getElementById("add-announcement-btn");
    const close_add_announcement = document.getElementById("close-add-modal");
    const modal_one = document.querySelector(".modal-one");
    const modal_two = document.querySelector(".modal-two");

    fetchUserData();

    function fetchUserData(){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/announce.php", true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                try{
                    var data = JSON.parse(xhr.responseText);
                    announcement_data.innerHTML = "";
                    data.forEach(function(announcement){
                        var row = document.createElement("tr");
                        row.dataset.user = JSON.stringify(announcement);
                        row.innerHTML = `<td>${announcement.announcement_id}</td>
                                        <td>${announcement.announcement_title}</td>
                                        <td class="btn">
                                            <button class="view-btn">View</button>
                                        </td>`;
                        announcement_data.appendChild(row);
                    });
                } catch(e){
                    console.error("Error parsing JSON:", e);
                }
            }
        };
        xhr.send();
    }

    add_announcement_btn.addEventListener("click", function(){
        modal_one.style.display = "flex";
    });

    close_add_announcement.addEventListener("click", function(){
        modal_one.style.display = "none";
    });


    announcement_data.addEventListener("click", function(e){
        if(e.target.classList.contains("view-btn")){
            const row = e.target.closest("tr");
            const announcement = JSON.parse(row.dataset.user);
            displayEventDetails(announcement, row);
        }
    });


    function displayEventDetails(announcement, row){
        const announcementID = announcement.announcement_id;
        const detailContent = document.getElementById("detail-content-two");
        detailContent.innerHTML = `
            <h2>Announcement Details</h2>
            <hr>
            <label for="announcement-id"><strong>Announcement ID</strong></label><br>
            <input type="text" id="announcement-id" value="${announcement.announcement_id}" disabled><br>
            <label for="announcement-title"><strong>Announcement Title</strong></label><br>
            <input type="text" id="announcement-title" value="${announcement.announcement_title}"><br>
            <label for="body"><strong>Body</strong></label><br>
            <textarea id="body" rows="10" cols="66">${announcement.body}</textarea><br>
            <button id="update-btn" class="update-btn">Update</button>
            <button id="delete-btn" class="delete-btn">Delete</button>
            <button id="close-btn" class="close-btn">Close</button>`;

        function updateAnnouncement(announcementID, updatedData){
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../php/update-announce.php", true);
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
            xhr.send("announcement-id=" + announcementID + "&" + new URLSearchParams(updatedData).toString());
        }

        function deleteAnnouncement(announcementID, row){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/delete-announce.php", true);
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
        xhr.send("announcement-id=" + announcementID);
    }

        const updateBtn = document.querySelector("#update-btn");
        updateBtn.addEventListener("click", () => {
            var updatedData = {
                'announcement-title': modal_two.querySelector("#announcement-title").value,
                'body': modal_two.querySelector("#body").value,
            };
            updateAnnouncement(announcementID, updatedData);
        });
        const deleteBtn = document.getElementById("delete-btn");
        deleteBtn.addEventListener("click", () =>{
            if(confirm("Are you sure you want to delete this announcement?")){
                deleteAnnouncement(announcementID, row);
            }
        });
        const closeBtn = document.getElementById("close-btn");
        closeBtn.addEventListener("click", () =>{
            modal_two.style.display = "none";
        });

        modal_two.style.display = "flex";
    }

});