document.addEventListener("DOMContentLoaded", () => {
    const eventData = document.getElementById("event-data");
    const addEventBtn = document.getElementById("add-event-btn");
    const closeAddEvent = document.getElementById("close-add-modal");
    const modalOne = document.querySelector(".modal-one");
    const modalTwo = document.querySelector(".modal-two");
    const detailContent = document.getElementById("detail-content-two");

    // === Load Events ===
    function fetchEvents() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/event-manage.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const data = JSON.parse(xhr.responseText);
                    eventData.innerHTML = "";
                    data.forEach(event => {
                        const row = document.createElement("tr");
                        row.dataset.event = JSON.stringify(event);
                        row.innerHTML = `
                            <td>${event.event_id}</td>
                            <td>${event.event_title}</td>
                            <td>${event.start_date}</td>
                            <td>${event.end_date}</td>
                            <td>${event.status}</td>
                            <td><button class="view-btn">View</button></td>
                        `;
                        eventData.appendChild(row);
                    });
                } catch (e) {
                    console.error("Invalid JSON:", e);
                }
            }
        };
        xhr.send();
    }
    fetchEvents();

    // === Show Add Event Modal ===
    addEventBtn.addEventListener("click", () => modalOne.style.display = "flex");
    closeAddEvent.addEventListener("click", () => modalOne.style.display = "none");

    // === Handle View Click ===
    eventData.addEventListener("click", e => {
        if (!e.target.classList.contains("view-btn")) return;
        const row = e.target.closest("tr");
        const event = JSON.parse(row.dataset.event);
        showEventDetails(event, row);
    });

    // === Show Event Details ===
    function showEventDetails(event, row) {
        detailContent.innerHTML = `
            <h2>Event Details</h2><hr>
            <label><strong>Title</strong></label><br>
            <input type="text" id="event-title" value="${event.event_title}"><br>

            <label><strong>Description</strong></label><br>
            <textarea id="event-description" rows="5" cols="40">${event.event_description}</textarea><br>

            <label><strong>Start Date</strong></label>
            <input type="date" id="start-date" value="${event.start_date}">

            <label><strong>End Date</strong></label>
            <input type="date" id="end-date" value="${event.end_date}"><br>

            <label><strong>Venue</strong></label><br>
            <input type="text" id="venue" value="${event.venue}"><br>

            <label><strong>Category</strong></label>
            <select id="category">
                <option value="Music" ${event.category === "Music" ? "selected" : ""}>Music</option>
                <option value="Art" ${event.category === "Art" ? "selected" : ""}>Art</option>
                <option value="Technology" ${event.category === "Technology" ? "selected" : ""}>Technology</option>
                <option value="Sports" ${event.category === "Sports" ? "selected" : ""}>Sports</option>
                <option value="Education" ${event.category === "Education" ? "selected" : ""}>Education</option>
            </select>

            <label><strong>Capacity</strong></label>
            <input type="number" id="capacity" value="${event.capacity}">

            <label><strong>Status</strong></label>
            <select id="status">
                <option value="Ongoing" ${event.status === "Ongoing" ? "selected" : ""}>Ongoing</option>
                <option value="Closed" ${event.status === "Closed" ? "selected" : ""}>Closed</option>
            </select><br>

            <button id="update-btn">Update</button>
            <button id="delete-btn">Delete</button>
            <button id="close-btn">Close</button>
        `;

        // === Update Event ===
        document.getElementById("update-btn").onclick = function () {
            const updated = {
                title: document.getElementById("event-title").value,
                description: document.getElementById("event-description").value,
                start_date: document.getElementById("start-date").value,
                end_date: document.getElementById("end-date").value,
                venue: document.getElementById("venue").value,
                category: document.getElementById("category").value,
                capacity: document.getElementById("capacity").value,
                status: document.getElementById("status").value
            };

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../php/update-event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        fetchEvents();
                        modalTwo.style.display = "none";
                    } else {
                        alert("Update failed");
                    }
                }
            };
            xhr.send("id=" + event.event_id + "&" + new URLSearchParams(updated).toString());
        };

        // === Delete Event ===
        document.getElementById("delete-btn").onclick = function () {
            if (!confirm("Delete this event?")) return;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../php/delete-event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const res = JSON.parse(xhr.responseText);
                    if (res.success) {
                        row.remove();
                        modalTwo.style.display = "none";
                    } else {
                        alert("Delete failed");
                    }
                }
            };
            xhr.send("id=" + event.event_id);
        };

        // === Close Modal ===
        document.getElementById("close-btn").onclick = function () {
            modalTwo.style.display = "none";
        };

        modalTwo.style.display = "flex";
    }
});
