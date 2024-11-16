var chatresponse = null;

document.addEventListener("DOMContentLoaded", function() {

    var messagefield = document.getElementById('chat-message-field');
    var chatsend = document.getElementById('chat-send');
    var conversation = document.getElementById('conversation');

   setInterval(() => {
    fetch('php-addons/get_conversation.php?chat-id=' + encodeURIComponent(document.getElementById('chat-id').value))
    .then(response => response.json())
    .then(data => {

        const conversationFetched = JSON.parse(data.conversation);

        var allMessages = conversation.querySelectorAll('*');

        Object.values(conversationFetched).forEach((message, index) => {
            let check = false;
          
            allMessages.forEach(element => {
              if (element.getAttribute('index') && message !== conversationFetched.message) {
                check = true;
                return;
              } else {
               
              }
            });
          
            if (check) {
              return; 
            } else {
                const mainDiv = document.createElement('div');
                mainDiv.classList.add('message-div');
                mainDiv.classList.add('d-flex');
                mainDiv.classList.add('justify-content-end');
                mainDiv.classList.add('px-2');
                mainDiv.setAttribute("index", index + 1);
    
                const subDiv = document.createElement('div');
    
                subDiv.classList.add('bg-dark');
                subDiv.classList.add('text-light');
                subDiv.classList.add('my-1');
                subDiv.classList.add('px-2');
                subDiv.classList.add('py-2');
                subDiv.classList.add('rounded');
                subDiv.style.fontSize = "12px";
                subDiv.style.maxWidth = "70%";
                subDiv.style.wordWrap = "break-word";
                subDiv.style.textAlign = "start";
    
                const msgSpan = document.createElement('span');
                msgSpan.textContent = message.message;
    
                const msgSpanDiv = document.createElement('div');
                msgSpanDiv.classList.add('col-12');
                msgSpanDiv.appendChild(msgSpan);
    
                const msgdateSpan = document.createElement('span');
                msgdateSpan.style.fontSize = "9px";
                msgdateSpan.style.opacity = "0.6";
    
                const msgtime = new Date(message.date);
    
                let hoursMSG = msgtime.getHours();
                const minutesMSG = msgtime.getMinutes();
                const amOrPmMSG = hoursMSG >= 12 ? 'PM' : 'AM';
    
                hoursMSG = hoursMSG % 12 || 12;
    
                const formattedTimeMSG = `${hoursMSG}:${minutesMSG.toString().padStart(2, '0')} ${amOrPmMSG}`;
    
                msgdateSpan.textContent = formattedTimeMSG;
    
                const msgdateSpanDiv = document.createElement('div');
                msgdateSpanDiv.classList.add('col-12');
                msgdateSpanDiv.classList.add('d-flex');
                msgdateSpanDiv.classList.add('justify-content-end');
                msgdateSpanDiv.appendChild(msgdateSpan);
    
                conversation.appendChild(mainDiv);
                mainDiv.appendChild(subDiv);
                subDiv.appendChild(msgSpanDiv);
                subDiv.appendChild(msgdateSpanDiv);
            }
   
          });
    })
    .catch(error => {
        console.error('Error:', error);
    });
   }, 1000);

    chatsend.disabled = true;

    messagefield.addEventListener("input", function() {
        if (messagefield.value !== '') {
            chatsend.disabled = false;
        } else {
            chatsend.disabled = true;
        };
    });

    chatsend.addEventListener("click", function() {
        if (messagefield.value !== '' && messagefield.value.trim() !== '') {
            let allmessage = document.querySelectorAll('.message-div');

            let index = allmessage.length + 1;

            const newDiv = document.createElement('div');
            newDiv.classList.add('message-div');
            newDiv.classList.add('d-flex');
            newDiv.classList.add('justify-content-end');
            newDiv.classList.add('px-2');
            newDiv.setAttribute("index", index);

            const messageDiv = document.createElement('div');

            messageDiv.classList.add('bg-dark');
            messageDiv.classList.add('text-light');
            messageDiv.classList.add('my-1');
            messageDiv.classList.add('px-2');
            messageDiv.classList.add('py-2');
            messageDiv.classList.add('rounded');
            messageDiv.style.fontSize = "12px";
            messageDiv.style.maxWidth = "70%";
            messageDiv.style.wordWrap = "break-word";
            messageDiv.style.textAlign = "start";

            const messageSpan = document.createElement('span');
            messageSpan.textContent = messagefield.value;

            const messageSpanDiv = document.createElement('div');
            messageSpanDiv.classList.add('col-12');
            messageSpanDiv.appendChild(messageSpan);

            const currenttime = new Date();

            let hours = currenttime.getHours();
            const minutes = currenttime.getMinutes();
            const amOrPm = hours >= 12 ? 'PM' : 'AM';

            hours = hours % 12 || 12;

            const formattedTime = `${hours}:${minutes.toString().padStart(2, '0')} ${amOrPm}`;

            const dateSpan = document.createElement('span');
            dateSpan.style.fontSize = "9px";
            dateSpan.style.opacity = "0.6";
            dateSpan.textContent = formattedTime;

            const dateSpanDiv = document.createElement('div');
            dateSpanDiv.classList.add('col-12');
            dateSpanDiv.classList.add('d-flex');
            dateSpanDiv.classList.add('justify-content-end');
            dateSpanDiv.appendChild(dateSpan);

            conversation.appendChild(newDiv);
            newDiv.appendChild(messageDiv);
            messageDiv.appendChild(messageSpanDiv);
            messageDiv.appendChild(dateSpanDiv);

            var sender = document.getElementById('sender-value').value;
            var message = document.getElementById('chat-message-field').value;
            var id = document.getElementById('chat-id').value;

            var data = {
                sender: sender,
                message: message,
                date: currenttime,
                id: id
            };

            fetch('php-addons/send_chat.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {

                    const messages = JSON.stringify(result);

                })
                .catch(error => {
                    console.error('Error:', error);
                });

            messagefield.value = '';
            chatsend.disabled = true;

        }
    });

    messagefield.addEventListener("keydown", function(event) {
        if (messagefield.value !== '' && messagefield.value.trim() !== '') {
            if (event.keyCode === 13) {

                let allmessage = document.querySelectorAll('.message-div');

                let index = allmessage.length + 1;

                const newDiv = document.createElement('div');
                newDiv.classList.add('message-div');
                newDiv.classList.add('d-flex');
                newDiv.classList.add('justify-content-end');
                newDiv.classList.add('px-2');
                newDiv.setAttribute("index", index);

                const messageDiv = document.createElement('div');

                messageDiv.classList.add('bg-dark');
                messageDiv.classList.add('text-light');
                messageDiv.classList.add('my-1');
                messageDiv.classList.add('px-2');
                messageDiv.classList.add('py-2');
                messageDiv.classList.add('rounded');
                messageDiv.style.fontSize = "12px";
                messageDiv.style.maxWidth = "70%";
                messageDiv.style.wordWrap = "break-word";
                messageDiv.style.textAlign = "start";

                const messageSpan = document.createElement('span');
                messageSpan.textContent = messagefield.value;

                const messageSpanDiv = document.createElement('div');
                messageSpanDiv.classList.add('col-12');
                messageSpanDiv.appendChild(messageSpan);

                const currenttime = new Date();

                let hours = currenttime.getHours();
                const minutes = currenttime.getMinutes();
                const amOrPm = hours >= 12 ? 'PM' : 'AM';

                hours = hours % 12 || 12;

                const formattedTime = `${hours}:${minutes.toString().padStart(2, '0')} ${amOrPm}`;

                const dateSpan = document.createElement('span');
                dateSpan.style.fontSize = "9px";
                dateSpan.style.opacity = "0.6";
                dateSpan.textContent = formattedTime;

                const dateSpanDiv = document.createElement('div');
                dateSpanDiv.classList.add('col-12');
                dateSpanDiv.classList.add('d-flex');
                dateSpanDiv.classList.add('justify-content-end');
                dateSpanDiv.appendChild(dateSpan);

                conversation.appendChild(newDiv);
                newDiv.appendChild(messageDiv);
                messageDiv.appendChild(messageSpanDiv);
                messageDiv.appendChild(dateSpanDiv);

                var sender = document.getElementById('sender-value').value;
                var message = document.getElementById('chat-message-field').value;
                var id = document.getElementById('chat-id').value;

                var data = {
                    sender: sender,
                    message: message,
                    date: currenttime,
                    id: id
                };

                fetch('php-addons/send_chat.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {

                        const messages = JSON.stringify(result);

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                messagefield.value = '';
                chatsend.disabled = true;

            }
        }
    });

    // setInterval(() => {

    // }, 2000);

});

// setInterval(() => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "php-addons/get_chat.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//             }
//         }
//     }

//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.send("incoming_id=" + incoming_id)

// }, 500);