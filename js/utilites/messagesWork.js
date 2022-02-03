function editMsg(message){
    const messageID=message.getAttribute('messageid');
    const newContent=prompt("Введите новое сообщение");
    if(!newContent) return;
    message.querySelector('.message_content').textContent=newContent;

    fetch("../../php_modules/chatWork/editMessage.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify({messageID, newContent}),
        credentials: 'same-origin'
    })
}

export {editMsg};