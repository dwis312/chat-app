// get Chat users
const form = document.querySelector(".typing-area"),
    inputField = form.querySelector(".msg"),
    sendBtn = form.querySelector("button"),
    container = document.querySelector(".chat-box");


form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
            //   console.log(xhr.responseText)
                inputField.value = "";
                scrollToBottom();
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}

container.onmouseenter = ()=>{
    container.classList.add("active");
}

container.onmouseleave = ()=>{
    container.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                // console.log(xhr.responseText);
                container.innerHTML = xhr.responseText;
                if(!container.classList.contains("active")){
                    scrollToBottom();
                  }
            }
        }
    }
    var params = new URLSearchParams(window.location);
    xhr.open("GET", "php/chat-box.php" + params.get('search'),  true);
    xhr.send();
}, 500);

function scrollToBottom(){
    container.scrollTop = container.scrollHeight;
  }