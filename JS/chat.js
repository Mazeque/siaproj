document.addEventListener("DOMContentLoaded", function() {

    var messagefield = document.getElementById('message-field');
    var chatsend = document.getElementById('chat-send');
    var conversation = document.getElementById('conversation');

    chatsend.disabled = true;

    messagefield.addEventListener("input", function() {
       if (messagefield.value !== '') {
        chatsend.disabled = false;
       } else {
        chatsend.disabled = true;
       };
    });

    chatsend.addEventListener("click", function() {
        if (messagefield.value !== '') {
                const newDiv = document.createElement('div');
                newDiv.classList.add('d-flex');
                newDiv.classList.add('justify-content-end');

                const messageDiv = document.createElement('div');
                messageDiv.classList.add('bg-dark');
                messageDiv.classList.add('text-light');
                messageDiv.classList.add('my-1');
                messageDiv.classList.add('px-2');
                messageDiv.classList.add('py-2');
                messageDiv.classList.add('rounded');
                messageDiv.textContent = messagefield.value;
                messageDiv.style.fontSize = "12px";

                conversation.appendChild(newDiv);
                newDiv.appendChild(messageDiv);

                messagefield.value = '';
                chatsend.disabled = true;
        }
    });

    messagefield.addEventListener("keydown", function(event) {
        if (messagefield.value !== '') {
          if (event.keyCode === 13) {
            const newDiv = document.createElement('div');
            newDiv.classList.add('bg-danger');
            newDiv.classList.add('d-flex');
            newDiv.classList.add('justify-content-end');
            newDiv.classList.add('px-2');
      
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

         
      
            messagefield.value = '';
            chatsend.disabled = true;
          }
        }
      });

});