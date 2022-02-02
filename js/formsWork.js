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
        <div class="group_title">
            Создание группы
        </div>
        <div class="group_inputContainer"> 
            <input type="text" placeholder="Название группы" class="group_input-name">
        </div>
        <div class="group_usersContainer">
            <ul class="group_usersList">
                <li class="createGroup_userItem>Куросава <input type="checkbox"></li>
            </ul>
        </div>
        <div class="group_btn">Создать</div>
    </div>
`

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

function showGroupWindow(){
    //добавляем новый элемент
    const win=document.createElement('div');
    win.addEventListener('click', function(e){
        if(e.target==win) e.currentTarget.remove();
    })
    win.className="background";
    win.innerHTML=groupWindow;
    document.body.append(win);
}

function hideWindow(element){
    element.remove();
}

export {showAddWindow, showGroupWindow, hideWindow};