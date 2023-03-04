const searchBar = document.querySelector(".users .search input"),
searchBtn = document.querySelector(".users .search button"),
usersList = document.querySelector(".users .users-list");

searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else {
        searchBar.classList.remove("active");
    }
    // začneme s AJAXem
    let xhr = new XMLHttpRequest(); // vytvoření XML Objektu
    xhr.open("POST", "php/search.php", true); // nastavení postovaní
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(()=>{
    // začneme s AJAXem
    let xhr = new XMLHttpRequest(); // vytvoření XML Objektu
    xhr.open("GET", "php/users.php", true); // nastavení postovaní
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(!searchBar.classList.contains("active")){ // pokud aktivní není aktivní ve vyhledavači přidáme data
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500); // tahle funkce se bude frekventovaně spouštět po 500ms