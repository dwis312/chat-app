// password show - hidden
const passField = document.getElementById("password");
const passField2 = document.getElementById("cpassword");
const btnPss = document.querySelector(".password-show");
const btnCPss = document.querySelector(".cpassword-show");



btnPss.addEventListener('click', () => {
    if(passField.type === "password" ) {
        passField.type = "text";
        btnPss.innerHTML = "Hide";
    } else {
        passField.type = "password";
        btnPss.innerHTML = "show";
    }
})

btnCPss.addEventListener('click', () => {
    if(passField2.type === "password" ) {
        passField2.type = "text";
        btnCPss.innerHTML = "Hide";
    } else {
        passField2.type = "password";
        btnCPss.innerHTML = "show";
    }
})