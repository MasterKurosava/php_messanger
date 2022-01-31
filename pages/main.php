<!DOCTYPE html>
<html>
  <head>
    <title>Мурчим под ушко</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8 " />
  </head>
  <body>
    <div class="main">
        <div class="container">
            <div class="container_sidebar">
                <div class="contacts">
                    <h3 class="title">Ваши контакты</h3>
                    <div class="add_contact"><span class="add_plus">+</span> Добавить контакт</div>
                    <div class="contacts_container">
                        <ul class="contacts_list">
                            <li class="contact_item"><img  class="contact_profile" src="../img/enoske.jpg">Куросава</li>
                            <li class="contact_item"><img  class="contact_profile" src="../img/enoske.jpg">mihailakalachiov@mail.ru</li>
                            <li class="contact_item">Третий</li>
                            <li class="contact_item">Четвертый</li>
                            <li class="contact_item">Mr.kurosava</li>

                        </ul>
                    </div>
                </div> 
                <div class="group">
                    <h3 class="title">Ваши групповые чаты</h3>
                    <div class="add_group"><span class="add_plus">+</span> Добавить групповой чат</div>
                    <div class="groups_container">
                        <ul class="groups_list">
                            <li class="contact_item">Первый чат</li>
                            <li class="contact_item">Второй чат</li>
                            <li class="contact_item">Третий чат</li>
                            <li class="contact_item">Четвертый чат</li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chat">
                <div class="chat_title">
                    <p class="chat_name">Чат с пользователем <span class="chat_user">228</span></p>
                </div>
                <div class="chat_window">
                    <div class="chat_message-owner">
                        <div class="message_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt eos sapiente expedita temporibus iusto modi quam assumenda atque cum. Ullam vero ducimus officia nostrum commodi totam, vel ipsum neque fuga?</div>
                        <div class="message_time">20.05.2021 20:34</div>
                    </div>

                    <div class="chat_message-guest">
                        <div class="message_author">Максимка</div>
                        <div class="message_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ipsam inventore, eos nobis, dolorum minus harum ullam est error eveniet at reiciendis sapiente fugit dignissimos. Ullam corrupti non nisi aspernatur!</div>
                        <div class="message_time">20.05.2021 20:34</div>
                    </div>
                    <div class="chat_message-guest">
                        <div class="message_author">Максимка</div>
                        <div class="message_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ipsam inventore, eos nobis, dolorum minus harum ullam est error eveniet at reiciendis sapiente fugit dignissimos. Ullam corrupti non nisi aspernatur!</div>
                        <div class="message_time">20.05.2021 20:34</div>
                    </div>
                    <div class="chat_message-guest">
                        <div class="message_author">Максимка</div>
                        <div class="message_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ipsam inventore, eos nobis, dolorum minus harum ullam est error eveniet at reiciendis sapiente fugit dignissimos. Ullam corrupti non nisi aspernatur!</div>
                        <div class="message_time">20.05.2021 20:34</div>
                    </div>
                    <div class="chat_message-guest">
                        <div class="message_author">Максимка</div>
                        <div class="message_content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi ipsam inventore, eos nobis, dolorum minus harum ullam est error eveniet at reiciendis sapiente fugit dignissimos. Ullam corrupti non nisi aspernatur!</div>
                        <div class="message_time">20.05.2021 20:34</div>
                    </div>
                </div>

                <div class="chat_inputContainer">
                    <input class="chat_inputMessage" type="text" placeholder="Введите сообщение">
                    <img src="../img/send.png" class="send_message">
                </div>
            </div>

            <div class="settings_menu">
                <ul class="settings_list">
                    <li class="setting_item">Профиль</li>
                    <li class="setting_item">Настройки</li>
                    <li class="setting_item">Выйти</li>
                </ul>

            </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="../socket.io/socket.io.js"></script>
    <script>
        // var socket = io();
        // var form = document.getElementById('form');
        // var input = document.getElementById('input');

        // form.addEventListener('submit', function(e){
        //     e.preventDefault();
        //     if(input.value){
        //         socket.emit('chat message', input.value);
        //         input.value='';
        //     }
        // })

        // socket.on('chat message', function(msg) {
        //     var item = document.createElement('li');
        //     item.textContent = msg;
        //     messages.appendChild(item);
        //     window.scrollTo(0, document.body.scrollHeight);
        // });
    </script>

  </body> 
</html>