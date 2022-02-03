import { showGroupWindow, hideWindow } from "./formsWork.js";
import debounce from "../utilites/debounce.js";
import { openGroupChat } from "../main.js";

const addGroupBtn=document.querySelector('.add_group');
const groupList=document.querySelector('.groups_list');
let createListener;
let groupInput, groupCreateList, groupCreateBtn, modalWindow;

addGroupBtn.addEventListener('click',()=>{
    
   [groupInput,groupCreateList,groupCreateBtn,modalWindow ] = showGroupWindow();
   groupInput.addEventListener('input',debounce(()=>{
       changeButton()
   },400));
   getUserContact();
   
})

function getUserContact(){
    fetch("../php_modules/userWork/getContacts.php",{
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        credentials: 'same-origin',
        body: JSON.stringify("userContactList")
    })
    .then(responce=>{return responce.json()})
    .then(data=>showUserContact(data))
    .catch(err=>showUserContact([]))
}

function showUserContact(users){
    groupCreateList.innerHTML="";
    if(users.length==0){
        const block=document.createElement('li');
        block.className="createGroup_userItem notFound";
        block.innerHTML=`<label class="create_label">Пользователи не найдены</label>`;
        groupCreateList.appendChild(block);
    }else{
        users.forEach(user => {
            const block=document.createElement('li');
            block.className="createGroup_userItem";
            block.id=`userID_${user.ID}`
            block.innerHTML=`
            <label class="create_label" for="${user.ID}">
                ${user.LOGIN || user.EMAIL} 
                <input type="checkbox" id="${user.ID}">
            </label>
            `
            groupCreateList.appendChild(block);
            block.addEventListener('click', (e)=>selectUser(e));
        });
    }
}

function selectUser(e){
    //выбираем поле
    const target=e.target;
    if(target.nodeName=='LABEL'){
        target.parentNode.classList.toggle('selected');
        //проверям выбрано ли что то
        changeButton()
    }
}

function changeButton(){
    groupCreateBtn.removeEventListener('click', createListener);
    //проверяем имя чата и выбранные контакты
    const chatName=groupInput.value;
    let selected=[];
    //если уже есть строки
    if(groupCreateList.childNodes.length>0){
        //проверяем есть ли  выбранные
        selected = Array.from(groupCreateList.childNodes).filter(el=>{
            if(el.classList.contains('selected')) return el;
        })
    }
     
    if(selected.length>=2 && chatName){
        groupCreateBtn.addEventListener('click', createListener=()=>addNewGroup(selected, chatName));
        groupCreateBtn.classList.remove('disabled');
    }else{
        groupCreateBtn.classList.add('disabled');
    }
}

function addNewGroup(selected, chatName){
    const selectedId=selected.map(el=>{
        return Number(el.id.replace("userID_", ''));
    });
    hideWindow(modalWindow);
    fetch("../php_modules/chatWork/createGroup.php",{
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        credentials: 'same-origin',
        body: JSON.stringify({chatName, users:selectedId})
    })
    .then(responce=>{return responce.json()})
    .then(responce=>{
        const block=document.createElement('li');
        block.className="group_item";
        block.setAttribute('group',responce.chat_ID)
        block.innerHTML=responce.chat_name;
        block.addEventListener('click',(e)=>openGroupChat(e))
        groupList.appendChild(block);
    })
    
}