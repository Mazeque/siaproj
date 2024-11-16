var password = document.getElementById('password');
var confirmpass = document.getElementById('confirmpassword');
var errorpass = document.getElementById('error-password');
var errorconfirmpass = document.getElementById('error-confirmpassword');

var submit = document.getElementById('submit-form');

document.addEventListener('DOMContentLoaded', function() {



});

var allowed = false;

function submitForm(event) {

 
    if (!allowed) {
        event.preventDefault();
    }

    if (password.value === '') {
        errorpass.innerHTML = 'Password must not be empty!';
    } else {
        if (password.value.length < 8) {
            errorpass.innerHTML = 'Password must be greater than or equal to 8 digits/characters!';
        } else {
            if (confirmpass.value !== password.value) {
                errorpass.innerHTML = "Password and Confirm Password doesn't match!";
            } else {
                errorpass.innerHTML = '';
            }
        }
    }

    if (confirmpass.value === '') {
        errorconfirmpass.innerHTML = 'Password must not be empty!';
    } else {
        if (confirmpass.value.length < 8) {
            errorconfirmpass.innerHTML = 'Password must be greater than or equal to 8 digits/characters!';
        } else {
            if (confirmpass.value !== password.value) {
                errorconfirmpass.innerHTML = "Password and Confirm Password doesn't match!";
            } else {
                errorconfirmpass.innerHTML = '';
            }
        }
    }

    var errors = document.querySelectorAll('.error-selector');

    var noerror = true;

    errors.forEach(element => {
        if (element.textContent !== '') {

            allowed = false;

            noerror = false;
          return;
        }
    });

    if (noerror) {
        allowed = true;
        document.getElementById('submit-form').innerHTML = "<div class = 'loader'></div>"
        document.getElementById('submit-form').click();
    }

}


