const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".msg");
const sendBtn = form.querySelector("button");

form.onsubmit = (e)=>{
    e.preventDefault();
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log(xhr.responseText);
                form.innerHTML = xhr.responseText;
            }
        }
    }
    var params = new URLSearchParams(window.location);
    xhr.open("GET", "php/insert-chat.php",  true);
    xhr.send();
}, 500);