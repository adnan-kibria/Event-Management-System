document.addEventListener("DOMContentLoaded", function(){
    const user_data = document.getElementById("user-data");

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
                        row.innerHTML = `<td>${user.id}</td>
                                        <td>${user.name}</td>
                                        <td>${user.username}</td>
                                        <td>${user.email}</td>
                                        <td>${user.phone}</td>
                                        <td class="view-btn">
                                            <button>View</button>
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

    fetchUserData();
});