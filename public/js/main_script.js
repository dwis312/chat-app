console.log('ok');
// search
const searchBar = document.getElementById("cari");
const searchBtn = document.getElementById("btn-cari");
const container = document.querySelector('.users-list');


searchBar.addEventListener('keyup', () => {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    };

    xhr.open('get', 'ajax/ajax_cari.php?keyword=' + searchBar.value);
    xhr.send();

});

searchBtn.addEventListener('click', ()=> {
    searchBar.classList.toggle("active");
});