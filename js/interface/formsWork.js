import {getPrivatData, getGroupData} from "../utilites/getChatData.js";
import { editMsg } from "../utilites/messagesWork.js";

const addWindow=`
    <div class="add_window">
        <div class="add_title">
            Введите логин или почту.
        </div>
        <div class="add_inputContainer"> 
            <input type="text" class="add_input">
        </div>
        <div class="add_usersContainer">
            <ul class="add_usersList">

            </ul>
        </div>
        <div class="add_btn disabled">Добавить</div>
    </div>
`

const groupWindow=`
    <div class="group_window">
        <div class="group_title">Создание группы</div>
        <div class="group_inputContainer"> 
            <input type="text" placeholder="Название группы" class="group_input-name">
        </div>
        <div class="group_usersContainer">
            <ul class="group_usersList">
                <li class="createGroup_userItem">
                </li>
            </ul>
        </div>
        <div class="group_btn disabled">Создать</div>
    </div>
`
const resendWindow=`

`
const chatModel=`
    <div class="chat_title">
    </div>
    <div class="chat_window"></div>
    <div class="chat_inputContainer">
        <input class="chat_inputMessage" type="text" placeholder="Введите сообщение">
        <img src="../img/send.png" class="send_message">
    </div>
`    
const modalBlock=`
    <div class="chat_modalMenu">
        <img class="title_svg resend_svg hidden" src="../svg/resend.svg">
        <img class="title_svg edit_svg hidden" src="../svg/edit.svg">
    </div>
`

let editListener, sendListener;

//Показываем окно с добавлением контакта
function showAddWindow(){
    //добавляем новый элемент
    const win=document.createElement('div');
    win.addEventListener('click', function(e){
        if(e.target==win) e.currentTarget.remove();
    })
    win.className="background";
    win.innerHTML=addWindow;
    document.body.append(win);

    const addInput=document.querySelector('.add_input');
    const addList=document.querySelector('.add_usersList');
    const addBtn=document.querySelector('.add_btn');
    return [addInput, addList, addBtn];
}
//Показываем окно с добавлением чата
function showGroupWindow(){
    //добавляем новый элемент
    const win=document.createElement('div');
    win.addEventListener('click', function(e){
        if(e.target==win) e.currentTarget.remove();
    })
    win.className="background";
    win.innerHTML=groupWindow;
    document.body.append(win);

    const groupInput=document.querySelector('.group_input-name');
    const groupCreateList=document.querySelector('.group_usersList');
    const groupCreateBtn=document.querySelector('.group_btn');

    return [groupInput, groupCreateList, groupCreateBtn, win];
}



//показываем окно с приватным чатом чатом
async function openChatWindow(userID, chatID, type){
    const container=document.querySelector('.chat_container');
    container.innerHTML='';
    const chatWindow=document.createElement('div');
    chatWindow.className=`chat chatID_${chatID}`;
    chatWindow.innerHTML=chatModel;
    container.append(chatWindow);

    const chatName=document.querySelector('.chat_title');
    const messageContainer=document.querySelector('.chat_window');
    const inputLabel=document.querySelector('.chat_inputMessage');
    const sendMessage=document.querySelector('.send_message');

    //если нужен приватный чат
    if(type=="private"){
        const chatData= await getPrivatData(userID, chatID);

        chatName.innerHTML=`<p class='chat_name'>Чат с пользователем <span class='chat_user'>${chatData.userName}</span></p>${modalBlock}`;

        fillMessages(chatData, messageContainer);

        return [inputLabel, sendMessage, chatData.currentUser];
    } //если нужен групповый чат
    else{
        const chatData= await getGroupData(chatID);

        chatName.innerHTML=`<p class='chat_name'><span class='chat_user'>${chatData.chatName}</span></p>${modalBlock}`;
        fillMessages(chatData, messageContainer);
    
        return [inputLabel, sendMessage, chatData.currentUser];
    }

}

//Добавляем сообщения в чат
function fillMessages(data, messageContainer){
    data.messages.forEach(mes => {
        const newMes=document.createElement('div');
        newMes.setAttribute('messageId',mes.ID);
        if(mes.USER_ID == data.currentUser){
            newMes.className="chat_message-owner";
            newMes.innerHTML=`
                <div class="message_content">${mes.CONTENT}</div>
                <div class="message_time">${mes.TIME}</div>
            `
        }else{
            newMes.className="chat_message";
            newMes.innerHTML=`
                <div class="message_author">${mes.USER_NAME}</div>
                <div class="message_content">${mes.CONTENT}</div>
                <div class="message_time">${mes.TIME}</div>
            `
        }
        newMes.addEventListener('click', (e)=>selectMessage(e))
        messageContainer.appendChild(newMes);        
    });
}

//выбираем сообщение
function selectMessage(e){
    const target=e.currentTarget;
    target.classList.toggle('selected');
    const messageContainer=document.querySelector('.chat_window');
    const someSelected= Array.from(messageContainer.childNodes).filter(el=>{
        if (el.classList.contains('selected')) return el;
    })
    changeModalWindow(someSelected)
}

//показываем или скрываем модальное окно
function changeModalWindow(selected){
    const modalWindow=document.querySelector('.chat_modalMenu')
    const sendBtn=document.querySelector('.resend_svg');
    const editBtn=document.querySelector('.edit_svg');
    sendBtn.removeEventListener('click', sendListener);
    editBtn.removeEventListener('click', editListener);
    //если ничего не выбрано
    if(selected.length==0){
        editBtn.classList.add('hidden');
        sendBtn.classList.add('hidden');
    }
    //если выбрано 1 или более
    else if(selected.length==1){
        editBtn.classList.remove('hidden');
        sendBtn.classList.remove('hidden');
        sendBtn.addEventListener('click', sendListener=()=>resendMsg(selected));
        editBtn.addEventListener('click', editListener=()=>editMsg(selected[0]));
    }else{
        modalWindow.classList.remove('hidden');
        editBtn.classList.add('hidden');
        sendBtn.addEventListener('click', sendListener=()=>resendMsg(selected));
    }
}


function hideWindow(element){
    element.remove();
}

export {showAddWindow, showGroupWindow, openChatWindow, hideWindow};