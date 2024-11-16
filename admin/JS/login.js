document.addEventListener('DOMContentLoaded', function() {

    var loginbutton = document.getElementById('login-button');
});


var noerror = false;

function login(event) {


    if (!noerror) {
        event.preventDefault();
    }

    let allow = true;

    var username = document.getElementById('username');
    var password = document.getElementById('password');

    if (username.value === '') {
        allow = false;

        return;
    } else {
        allow = true;
    }

    if (allow) {
        if (password.value === '') {
            allow = false;
    
        } else {
            allow = true;
            
        }
    }

    if (allow) {
        noerror = true;
        document.getElementById('login-button').click();

        document.getElementById('login-button').innerHTML = "<div class = 'loader'></div>";

        setTimeout(function() {
            document.getElementById('login-button').click();
        }, 600);
    }
}