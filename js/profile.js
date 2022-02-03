const editBtn=document.querySelector('.profile_redacticting'),
    loginInput=document.querySelector('.user_login'),
    loginLabel=document.querySelector('.profile_label'),
    choiceBtn=document.querySelector('.profile_choicePhoto'),
    sendBtn=document.querySelector('.send_photo'),
    filename=document.querySelector('.file_name');

let status="saved";

function openInput(){
    loginInput.removeAttribute('disabled');
    editBtn.textContent="Сохранить";
    loginInput.select();

    editBtn.removeEventListener('click',openBtnListener);
    editBtn.addEventListener('click',closeBtnListener=()=>checkValues(),);
}

function checkValues(){
    const login=loginInput.value;
    const reqLogin=/^[а-яА-ЯёЁa-zA-Z0-9]+$/gm;
    if(reqLogin.test(login)){
        closeInput();
        fetch("../php_modules/userWork/editUser.php",{
            method: 'POST',
            headers: { 'Content-Type': 'application/json'},
            credentials: 'same-origin',
            body: JSON.stringify({login})
        })
        .catch(err=>alert("Что то пошло не так "+err))
    }else{
        loginLabel.classList.add('error');
    }
}

function closeInput(){
    loginInput.setAttribute('disabled',"true");
    editBtn.textContent="Редактирование профиля";
    editBtn.removeEventListener('click',closeBtnListener);
    editBtn.addEventListener('click',openBtnListener=()=>checkValues());
}


let openBtnListener, closeBtnListener, sendBtnListener;

choiceBtn.addEventListener('change',()=>{
    if(choiceBtn.value){
        try{
            filename.textContent=choiceBtn.value.match(/[\/\\]([\w\d\s\.\-(\)]+)$/)[1];
            sendBtn.classList.remove('disabled');
            sendBtn.removeEventListener('click',sendBtnListener)
        }catch{
            filename.textContent="Ошибка";
        }
    }
})

sendBtn.addEventListener('click', sendBtnListener=(e)=>e.preventDefault())

editBtn.addEventListener('click' , openBtnListener=()=>openInput());

loginInput.addEventListener('input', ()=>loginLabel.classList.remove('error'))