// show all users
const container = document.querySelector(".users-list");

setInterval(() =>{
    let xhr = new XMLHttpRequest();
xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
            container.innerHTML = xhr.responseText;
        }
    }
}
xhr.open("POST", "php/users.php",  true);
xhr.send();
}, 500);