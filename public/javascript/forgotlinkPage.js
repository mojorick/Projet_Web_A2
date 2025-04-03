document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const message = document.getElementById("message");

    form.addEventListener("submit", function (event) {
        message.style.display = "block"; 

        setTimeout(function () {
            message.style.display = "none";
            window.location.href = "enregistrement.php"; // Redirection après 1 seconde
        }, 3000);
    });
});
