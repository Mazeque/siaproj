function toggleChat() {
    var chatConvo = document.getElementById('chatConvo');
    var carouselIndicatorsSmall = document.getElementById('carouselIndicatorSmall');

    var chatContainer = document.querySelector('.chat-container');
    
    if (chatConvo.classList.contains('d-none')) {
      chatConvo.classList.remove('d-none');
      carouselIndicatorsSmall.classList.add('d-none');

      chatContainer.style.transform = 'translateY(-20%)'; // Adjust the value to match the chat-convo width
    } else {
        chatConvo.classList.add('d-none');
        carouselIndicatorsSmall.classList.remove('d-none');
 
      chatContainer.style.transform = 'translateX(0)';
    }
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    
   
    var searchbutton = document.getElementById('search-button');
    var rightpanel = document.getElementById('right-panel');
    var searchpanel = document.getElementById('search-panel');
    var cancelbutton = document.getElementById('cancel-button');
    var searchingbutton = document.getElementById('searching-button');
    var searchinputfield = document.getElementById('search-input-field');
    
    searchbutton.addEventListener('click', function() {
        if (rightpanel.classList.contains('d-lg-block')) {

            searchpanel.classList.remove('right-panel-fade'); 
            
             rightpanel.classList.add('right-panel-fade');
             rightpanel.style.opacity = '0';

            setTimeout(function() {
                rightpanel.classList.remove('d-lg-block');
            }, 300);
    
            setTimeout(function() {
    
                if (!searchpanel.classList.contains('d-lg-block')) {         
                    searchpanel.classList.add('d-lg-block');
                    setTimeout(function() {
                        searchpanel.style.opacity = "1";
                        rightpanel.style.opacity = "1";
                    },100);
                }
            }, 300);
        }
    });

    searchinputfield.addEventListener('input', function() {
  
        if (searchinputfield.value !== '' && searchingbutton.classList.contains('d-none')) {
            cancelbutton.classList.add('d-none');
            searchingbutton.classList.remove('d-none');
        } else if (searchinputfield.value === '' && cancelbutton.classList.contains('d-none')){
            searchingbutton.classList.add('d-none');
            cancelbutton.classList.remove('d-none');
            
        }
    });

    cancelbutton.addEventListener('click', function() {
        
        rightpanel.classList.remove('right-panel-fade');

        searchpanel.classList.add('right-panel-fade');
        searchpanel.style.opacity = '0';
     
        setTimeout(function() {
            searchpanel.classList.remove('d-lg-block');
        }, 200);

        setTimeout(function() {
            if (!rightpanel.classList.contains('d-lg-block')) {         
                rightpanel.classList.add('d-lg-block');
                setTimeout(function() {
                    rightpanel.style.opacity = "1";
                    searchpanel.style.opacity = "1";
                },100);
            }
        }, 200);
      

     
     
     
    });



});

function donebutton(event) {

    let button = document.getElementById('login-button');
    button.innerHTML = "<div class='loader'></div>";

};

var proceedChat = false;

function startchat(event) {
    
    if (!proceedChat) {
        event.preventDefault();
    }

    let namechat = document.getElementById('nameChat');
    let emailchat = document.getElementById('emailChat');
    let supportchat = document.getElementById('supportChat');
    let messagechat = document.getElementById('messageChat');   

    if (namechat.value === '') {
        namechat.classList.add('border-danger');
    } else {
        if (namechat.classList.contains('border-danger')) {
            namechat.classList.remove('border-danger');
        }
    }

    if (emailchat.value === '') {
        emailchat.classList.add('border-danger');
    } else {
        if (emailchat.classList.contains('border-danger')) {
            emailchat.classList.remove('border-danger');
        }
    }

    if (supportchat.value === '') {
        supportchat.classList.add('border-danger');
    } else {
        if (supportchat.classList.contains('border-danger')) {
            supportchat.classList.remove('border-danger');
        }
    }

    if (messagechat.value === '') {
        messagechat.classList.add('border-danger');
    } else {
        if (messagechat.classList.contains('border-danger')) {
            messagechat.classList.remove('border-danger');
        }
    }

    let fields = document.querySelectorAll('.chat-control');

    proceedChat = true;

    fields.forEach(element => {
        if (element.classList.contains('border-danger')) {
            proceedChat = false;

            return;
        }
    });

    if (proceedChat) {
        document.getElementById('chat-submit').click();
    }

}