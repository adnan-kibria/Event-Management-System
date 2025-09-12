const reg_data = document.getElementById("reg-data");

    function fetchRegistrations() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/dummy-reg.php?action=fetch", true);
        xhr.onload = function() {
            if (this.status === 200) {
                const data = JSON.parse(this.responseText);
                reg_data.innerHTML = "";
                data.forEach(function(reg) {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${reg.id}</td>
                        <td>${reg.event_id}</td>
                        <td>${reg.id}</td>
                        <td>${reg.regdate}</td>
                        <td>${reg.status}</td>
                        <td class="action-one"> </td>   
                        <td class="action-two"></td>
                            
                    `;
                    const actionOne = row.querySelector(".action-one");
                    const actionTwo = row.querySelector(".action-two");
                    if (reg.status === 'pending') {
                        const approveBtn = document.createElement("button");
                        approveBtn.textContent = "Approve";
                        approveBtn.addEventListener("click", function() {
                            updateRegStatus(reg.id, 'approved');
                        });

                        const rejectBtn = document.createElement("button");
                        rejectBtn.textContent = "Reject";
                        rejectBtn.addEventListener("click", function() {
                            updateRegStatus(reg.id, 'rejected');
                        });

                        actionOne.appendChild(approveBtn);
                        actionTwo.appendChild(rejectBtn);
                    }
                    else{
                        actionOne.textContent = reg.status;
                        actionTwo.textContent = reg.status;
                    }
                    reg_data.appendChild(row);
                });
            }
        };
        xhr.send();
    }

    function updateRegStatus(id, status) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/update-reg-data.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function() {
            if (this.status === 200) {
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    fetchRegistrations();
                } else {
                    alert("Failed to update status.");
                }
            }
        };
        xhr.send(`reg_id=${id}&status=${status}`);
    }

    fetchRegistrations();