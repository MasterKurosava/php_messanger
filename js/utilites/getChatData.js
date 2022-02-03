async function getPrivatData(userID, chatID){
    let chatData={};
    await fetch("../../php_modules/chatWork/getPrivatData.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify({userID,chatID}),
        credentials: 'same-origin'
    })
    .then(response=>{return response.json()})
    .then((data)=>{chatData=data })
    
    return chatData;
}

async function getGroupData(chatID){
    let chatData={};
    await fetch("../../php_modules/chatWork/getGroupData.php", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json'},
        body: JSON.stringify({chatID}),
        credentials: 'same-origin'
    })
    .then(response=>{return response.json()})
    .then((data)=>{chatData=data })
    
    return chatData;
}

export {getPrivatData, getGroupData};