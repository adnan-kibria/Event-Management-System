document.addEventListener("DOMContentLoaded", function(){
    const user_data = document.getElementById("user-data");
    const modal = document.querySelector(".modal");
    const user_details = document.getElementById("details-container");
    

    fetchUserData();

    function fetchUserData(){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/user-manage.php", true);
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                try{
                    var data = JSON.parse(xhr.responseText);
                    user_data.innerHTML = "";
                    data.forEach(function(user){
                        var row = document.createElement("tr");
                        row.dataset.user = JSON.stringify(user);
                        row.innerHTML = `<td>${user.id}</td>
                                        <td>${user.name}</td>
                                        <td>${user.username}</td>
                                        <td>${user.email}</td>
                                        <td>${user.phone_number}</td>
                                        <td class="btn">
                                            <button class="view-btn">View</button>
                                        </td>
                                        <td class="btn">
                                            <button class="delete-btn">Delete</button>
                                        </td>`;
                        user_data.appendChild(row);
                    });
                } catch(e){
                    console.error("Error parsing JSON:", e);
                }
            }
        };
        xhr.send();
    }

    user_data.addEventListener("click", function(e){
        if(e.target.classList.contains("view-btn")){
            const row = e.target.closest("tr");
            const user = JSON.parse(row.dataset.user);
            displayUserDetails(user);
        }
        else if(e.target.classList.contains("delete-btn")){
            const row = e.target.closest("tr");
            const userID = row.cells[0].textContent;
            if(confirm("Are you sure you want to delete this user?")){
                deleteUser(userID, row);
            }
        }
    });


    function displayUserDetails(user){
        const detailContent = document.getElementById("detail-content");
        detailContent.innerHTML = `
            <h2>Participant Details</h2>
            <hr>
            <label for="user-name"><strong>Full Name</strong></label>
            <label for="user-username"><strong>Username</strong></label><br>
            <input type="text" id="user-name" value="${user.name}" disabled>
            <input type="text" id="user-username" value="${user.username}" disabled><br>
            <label for="user-email"><strong>Email</strong></label>
            <label for="user-phone"><strong>Phone Number</strong></label><br>
            <input type="text" id="user-email" value="${user.email}" disabled>
            <input type="text" id="user-phone" value="${user.phone_number}" disabled><br>
            <label for="user-gender"><strong>Gender</strong></label>
            <label for="user-dob"><strong>Date of Birth</strong></label><br>
            <input type="text" id="user-gender" value="${user.gender}" disabled>
            <input type="text" id="user-dob" value="${user.dob}" disabled><br>
            <label for="user-address"><strong>Address</strong></label><br>
            <textarea id="user-address" rows="3" cols="68" disabled>${user.address}</textarea><br>
            <button id="close-btn" class="close-btn">Close</button>`;

        const close = document.getElementById("close-btn");
        close.addEventListener("click", () =>{
            modal.style.display = "none";
        });

        modal.style.display = "flex";
    }

    function deleteUser(userID, row){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/delete-user.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                var response = JSON.parse(xhr.responseText);
                if(response.success){
                    row.remove();
                } else {
                    alert("Error deleting user.");
                }
            }
        };
        xhr.send("id=" + userID);
    }

});