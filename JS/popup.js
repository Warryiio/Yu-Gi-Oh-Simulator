$(document).ready(function() {
    let popup= document.getElementById("popup");
    function openPopup() {
        popup.classList.add("open-popup");

    }
    function closePopup() {
        popup.classList.remove("open-popup");
    }

    function error() {
        document.getElementById("status").src= "/Yu-Gi-Oh-Simulator/images/red.png";
        document.getElementById("message").innerHTML = "Something went wrong";
        document.getElementById("details").innerHTML = "Your Username or Email is already used";
        openPopup();
    }
    function success() {
        document.getElementById("status").src= "/Yu-Gi-Oh-Simulator/images/green.png";
        document.getElementById("message").innerHTML = "Thank you";
        document.getElementById("details").innerHTML = "Your Account has been created";
        openPopup();
    }
});