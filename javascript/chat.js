const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); //prevence odeslání formuláře
} 

sendBtn.onclick = ()=>{
    // začneme s AJAXem
    let xhr = new XMLHttpRequest(); // vytvoření XML Objektu
    xhr.open("POST", "php/insert-chat.php", true); // nastavení postovaní
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; // po kliknutí na odeslat se vyprázdní textové pole 
                scrollToBottom();
            }
        }
    }
    // musime odeslat data z formuláře do php skrze AJAX
    let formData = new FormData(form); // vytvoření nového FormData objektu
    xhr.send(formData); // odeslaní dat z formuláře
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove ("active");
}

setInterval (()=>{
    // začneme s AJAXem
    let xhr = new XMLHttpRequest(); // vytvoření XML Objektu
    xhr.open("POST", "php/get-chat.php", true); // nastavení postovaní
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ // kdyz odjedu s kurzorem pryč z chatu tak se zprávy nascrolujou dolu
                    scrollToBottom();
                }
            }
        }
    }
    // musime odeslat data z formuláře do php skrze AJAX
    let formData = new FormData(form); // vytvoření nového FormData objektu
    xhr.send(formData); // odeslaní dat z formuláře
}, 500); // tahle funkce se bude frekventovaně spouštět po 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}