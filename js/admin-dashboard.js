fetch("../php/adminDashboard.php")
    .then(response => response.json())
    .then(data => {
        document.getElementById("total-users").innerText = data.total_users;
        document.getElementById("total-events").innerText = data.total_events;
        document.getElementById("total-registrations").innerText = data.total_registrations;
    })
    .catch(error => console.error("Error fetching dashboard data:", error));