document.addEventListener("DOMContentLoaded", function () {
    const nameInput = document.getElementById('full-name');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone-no');
    const dobInput = document.getElementById('dob');
    const nidInput = document.getElementById('nid');
    const addressInput = document.getElementById('address');

    const changeBtn = document.getElementById('changes');
    const updateBtn = document.getElementById('update');

    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/user-data.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                const data = JSON.parse(xhr.responseText);
                if (data.error) {
                    alert(data.error);
                } else {
                    nameInput.value = data.name || "";
                    usernameInput.value = data.username || "";
                    emailInput.value = data.email || "";
                    phoneInput.value = data.phone_number || "";
                    dobInput.value = data.dob || "";
                    nidInput.value = data.nid_number || "";
                    addressInput.value = data.address || "";
                }
            } catch (e) {
                console.error("Invalid JSON:", xhr.responseText);
            }
        }
    };
    xhr.send();

    changeBtn.addEventListener("click", function () {
        const params =
            "name=" + encodeURIComponent(nameInput.value) +
            "&phone=" + encodeURIComponent(phoneInput.value) +
            "&dob=" + encodeURIComponent(dobInput.value) +
            "&nid=" + encodeURIComponent(nidInput.value) +
            "&address=" + encodeURIComponent(addressInput.value);

        const xhr1 = new XMLHttpRequest();
        xhr1.open("POST", "../php/change-user-info.php", true);
        xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr1.onreadystatechange = function () {
            if (xhr1.readyState === 4 && xhr1.status === 200) {
                alert(xhr1.responseText);
            }
        };
        xhr1.send(params);
    });

    
});
