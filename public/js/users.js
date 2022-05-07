// show all users
const form = document.querySelector(".form-search");
const keyword = form.querySelector(".cari");
const btnCari = form.querySelector(".btn-cari");
const usersList = document.querySelector(".users-list");

keyword.addEventListener('keyup', function() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status == 200) {
            usersList.innerHTML = xhr.responseText;
        }
    }

    xhr.open('POST', 'php/search.php?username=' + keyword.value);
    xhr.send();
});

btnCari.addEventListener('click', function() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status == 200) {
            usersList.innerHTML = xhr.responseText;
        }
    }

    xhr.open('POST', 'php/search.php?username=' + keyword.value);
    xhr.send();
});

form.onsubmit = (e)=>{
    e.preventDefault();
}

keyword.onmouseenter = ()=>{
    keyword.classList.add("active");
}

keyword.onmouseleave = ()=>{
    keyword.classList.remove("active");
    btnCari.classList.remove("active");
}

btnCari.addEventListener('click', function() {
    btnCari.classList.add("active");
})

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                if(!keyword.classList.contains("active")) {
                    if(!btnCari.classList.contains("active")) {
                        usersList.innerHTML = xhr.responseText;
                    }
                }
            }
        }
    }

    xhr.open("POST", "php/users.php",  true);
    xhr.send();
}, 500);