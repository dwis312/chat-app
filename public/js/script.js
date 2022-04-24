// password show - hidden
const passField = document.getElementById("password");
const btnToggle = document.getElementById("show");


btnToggle.addEventListener('click', () =>{
    if(passField.type === "password") {
        passField.type = "text";
        btnToggle.innerHTML = "Hide";
    } else {
        passField.type = "password";
        btnToggle.innerHTML = "show";
    }
});
