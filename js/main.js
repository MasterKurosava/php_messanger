import { openChatWindow } from "./interface/formsWork.js";

const contactsList=document.querySelectorAll('.contact_item');
const groupList=document.querySelectorAll('.group_item');
let inputLabel, sendBtn, currentID, btnListener, currentChat;

//открываем приватные чаты
contactsList.forEach(el => {
    el.addEventListener('click',(e)=>openPrivateChat(e));
});
//открываем групповые чаты
groupList.forEach(el => {
    el.addEventListener('click',(e)=>openGroupChat(e));
});


export async function openPrivateChat(e){
    const target=e.currentTarget;
    const userID=target.getAttribute('userID');
    const chatID=target.getAttribute('private');
    [inputLabel, sendBtn, currentID]=await openChatWindow(userID, chatID, 'private');
    sendBtn.addEventListener('click', btnListener=()=>sendMessage(inputLabel.value, chatID))
}

export async function openGroupChat(e){
    const target=e.currentTarget;
    const chatID=target.getAttribute('group');
    [inputLabel, sendBtn, currentID]=await openChatWindow('',chatID,'group');
    sendBtn.addEventListener('click', btnListener=()=>sendMessage(inputLabel.value, chatID))
}

function sendMessage(value, chatID){
    if(!value) return;
    inputLabel.value="";

    const messageContainer=document.querySelector('.chat_window');
    const newMes=document.createElement('div');
    let d =new Date();
    d= d.getDate()+"."+d.getMonth()+"."+d.getFullYear()+" "+d.getHours()+":"+(d.getMinutes().length!=1 ? "0"+d.getMinutes() : d.getMinutes());
    newMes.className="chat_message-owner";
    newMes.innerHTML=`
        <div class="message_content">${value}</div>
        <div class="message_time">${d}</div>
    `
    messageContainer.append(newMes);

    fetch("../../php_modules/chatWork/sendMessage.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify({chatID, currentID, value}),
        credentials: 'same-origin'
    })

}
