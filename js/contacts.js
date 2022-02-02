import {showAddWindow, showGroupWindow, hideWindow} from "./formsWork.js";
import debounce from "./utilites/debounce.js";

const addContanctBtn=document.querySelector('.add_contact');
const contactsList=document.querySelector('.contacts_list');
let addInput, searchList, addBtn;
let btnListener;
//открываем окно добавление контакта
addContanctBtn.addEventListener('click', ()=>{
    [addInput,searchList,addBtn]=showAddWindow();
    //фильтруем пользователей при вводе
    addInput.addEventListener('input', debounce(()=>{
        debounce(getUsers('../php_modules/userWork/findUser.php', addInput.value))
    },500))    
})

function getUsers(url, data){
    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify(data),
        credentials: 'same-origin'
    })
    .then(response=>{return response.json()})
    .then(data=>placeContacts(data))
 };


function placeContacts(users){
    addBtn.classList.add('disabled');
    addBtn.removeEventListener('click',btnListener);
    searchList.innerHTML="";;
    if(users.length==0){
        const block=document.createElement('li');
        block.className="add_userItem notFound";
        block.innerHTML="Пользователей с таким именем нет."
        searchList.appendChild(block);
    }else{
        users.forEach(user => {
            const block=document.createElement('li');
            block.className="add_userItem ";
            block.innerHTML=user.LOGIN || user.EMAIL;
            searchList.appendChild(block);
            block.addEventListener('click', (e)=>setContact(e))
        });
    }
}

function setContact(e){
    const target=e.currentTarget;
    searchList.childNodes.forEach(user=>user.classList.remove('selected'))
    target.classList.add('selected');
    addBtn.classList.remove('disabled');
    addBtn.addEventListener('click', btnListener=()=>addContact(target));
}

function addContact(user){
    user.remove()
    fetch("../php_modules/userWork/addContact.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify(user.textContent),
        credentials: 'same-origin'
    })
    .then(response=>{return response.json()})
    .then((data)=>{
        const newContact=document.createElement('li');
        newContact.className="contact_item";
        newContact.id="user_"+data;
        newContact.innerHTML=user.textContent;
        contactsList.appendChild(newContact);
    })

}