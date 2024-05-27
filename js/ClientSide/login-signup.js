document.addEventListener("DOMContentLoaded", () => {
    const createAccountForm = document.querySelector("#createAccount");
    const createAccountButton = document.querySelector("#createAccount .form-button");

    createAccountForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../API/signup.php", true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Check the response from the server
                    if (xhr.responseText === "success") {
                        // Registration successful
                        alert("Registration successful. You can now login.");
                        window.location.href = "login-signup.php";
                    } else {
                        // Registration failed, display error message
                        alert(xhr.responseText);
                    }
                } else {
                    // Request failed
                    alert("Error: " + xhr.status);
                }
            }
        };

        xhr.send(formData);
    });
});
