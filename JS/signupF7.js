var stringsOnly = /^[a-zA-Z\s]+$/;
var numbersOnly = /^[0-9]+$/;
var usernamePattern = /^[a-zA-Z0-9.]+$/;
var emailPattern = /@.*\./;

var isUsernameAvailable = false;

document.addEventListener('DOMContentLoaded', () => {

const selectDrop = document.querySelector("#countryselect");

var agreed = false;


document.getElementById('agreeButton').addEventListener('click', function() {
   agreed = true;
});

document.getElementById('termservice').addEventListener('click', function(event) {

    if (agreed === false) {
 
     event.preventDefault();
     document.getElementById('error-termservice').innerHTML = 'Please read the Terms Of Service first before checking!';
     if (document.getElementById('termservice').classList.contains('border-dark')) {
        document.getElementById('termservice').classList.remove('border-dark');
        document.getElementById('termservice').classList.add('border-danger');
     }

    } else {
        document.getElementById('error-termservice').innerHTML = '';
        if (document.getElementById('termservice').classList.contains('border-danger')) {
            document.getElementById('termservice').classList.remove('border-danger');
            document.getElementById('termservice').classList.add('border-dark');
         }
    
    }
 
 });
 
fetch('https://restcountries.com/v3.1/all').then(res => {
    return res.json();
}).then(data => {
    let output = "";
    output += '<option>Your country</option>';
    data.forEach(element => {
        output += `<option>${element.name.common}</option>`;
    });

    selectDrop.innerHTML = output;
}).catch(err => {
    console.log(err);
});


});


const regionSelector = document.getElementById('regionselect');
const selectedCountry = document.getElementById('countryselect');

selectedCountry.addEventListener('change', function() {
const selectedRegionIN = countryData.find(item => item.country === selectedCountry.value);

if (selectedRegionIN) {
let output = "";
output += "<option>Your region</option>";
selectedRegionIN.regions.forEach(region => {
  output += `<option>${region}</option>`;
});

regionSelector.innerHTML = output;
} else {
regionSelector.innerHTML = "<option>Your region</option>";
}
});

const citySelector = document.getElementById('cityselect');
const selectedRegion = document.getElementById('regionselect');

selectedRegion.addEventListener('change', function() {
const selectedRegionIN = philippinesCities.find(item => item.region === selectedRegion.value);

if (selectedRegionIN) {
  let output = "";
  output += "<option>Your city</option>";
  selectedRegionIN.cities.forEach(region => {
    output += `<option>${region}</option>`;
  });

  citySelector.innerHTML = output;
} else {
  citySelector.innerHTML = "<option>Your city</option>";
}
});

function togglePassword(fieldName, eyeName) {

var field = document.getElementById(fieldName); 
var eye = document.getElementById(eyeName);

if (field.getAttribute("type") === 'password') {
    field.setAttribute('type', 'password-show');

    eye.classList.replace('fa-eye', 'fa-eye-slash');
} else {
    field.setAttribute('type', 'password');

    eye.classList.replace('fa-eye-slash', 'fa-eye');
}

}

function submitRegister(event) {

var firstname = document.getElementById('firstname');
var middlename = document.getElementById('middlename');
var username = document.getElementById('username');
var password = document.getElementById('password');
var confirmpassword = document.getElementById('confirmpassword');
var email = document.getElementById('email');
var phonenumber = document.getElementById('phonenumber');
var birthday = document.getElementById('birthday');
var gender = document.getElementById('genderselect');
var country = document.getElementById('countryselect');
var region = document.getElementById('regionselect');
var city = document.getElementById('cityselect');
var postcode = document.getElementById('postcode');
var barangay = document.getElementById('barangay');
var street = document.getElementById('street');
var securityquestion = document.getElementById('secQuestionSelect');
var securityanswer = document.getElementById('secAnswer');
var recoverypassword = document.getElementById('recoveryPassword');

var errorfirstname = document.getElementById('error-firstname');
var errormiddlename = document.getElementById('error-middlename');
var errorlastname = document.getElementById('error-lastname');
var errorusername = document.getElementById('error-username');
var errorpassword = document.getElementById('error-password');
var errorconfirmpassword = document.getElementById('error-confirmpassword');
var erroremail = document.getElementById('error-email');
var errorphonenumber = document.getElementById('error-phonenumber');
var errorbirthday = document.getElementById('error-birthday');
var errorgender = document.getElementById('error-gender');
var errorcountry = document.getElementById('error-country');
var errorregion = document.getElementById('error-regionorstate');
var errorcity = document.getElementById('error-city');
var errorpostcode = document.getElementById('error-postcode');
var errorbarangay = document.getElementById('error-barangay');
var errorstreet = document.getElementById('error-street');
var errorsecurityquestion = document.getElementById('error-securityquestion');
var errorsecurityanswer = document.getElementById('error-securityanswer');
var errorrecoverypassword = document.getElementById('error-recoverypassword');

if (firstname.value === '') {
    errorfirstname.innerHTML = 'First name must not be empty!';
    firstname.classList.add('border-danger');
} else {
    if (!stringsOnly.test(firstname.value)) {
        errorfirstname.innerHTML = 'First name should only contain alphabetical characters. (A-Z)';
        firstname.classList.add('border-danger');
    } else {
        errorfirstname.innerHTML = '';
        firstname.classList.remove('border-danger');
    }
}

if (middlename.value === '') {
    errormiddlename.innerHTML = 'Middle name must not be empty!';
    middlename.classList.add('border-danger');
} else {
    if (!stringsOnly.test(middlename.value)) {
        errormiddlename.innerHTML = 'Middle name should only contain alphabetical characters. (A-Z)';
        middlename.classList.add('border-danger');
    } else {
        errormiddlename.innerHTML = '';
        middlename.classList.remove('border-danger');
    }
}

if (lastname.value === '') {
    errorlastname.innerHTML = 'Last name must not be empty!';
    lastname.classList.add('border-danger');
} else {
    if (!stringsOnly.test(lastname.value)) {
        errorlastname.innerHTML = 'Last name should only contain alphabetical characters. (A-Z)';
        lastname.classList.add('border-danger');
    } else {
        errorlastname.innerHTML = '';
        lastname.classList.remove('border-danger');
    }
}


if (!isUsernameAvailable) {
    errorusername.innerHTML = 'Please check the availability of the username first!';
    username.classList.add('border-danger');
} else {
    errorusername.innerHTML = '';
    username.classList.remove('border-danger');

    isUsernameAvailable = true;
}

if (password.value === '') {
    errorpassword.innerHTML = 'Password must not be empty!';
    password.classList.add('border-danger');
} else {
    if (password.value.length < 8) {
        errorpassword.innerHTML = 'Password must be greater than or equal to 8 characters in length!';
        password.classList.add('border-danger');
    } else {
       if (password.value.length > 26) {
        errorpassword.innerHTML = 'Password must not exceed 26 characters in length!';
        password.classList.add('border-danger');
       } else {
            if (password.value != confirmpassword.value) {
                errorpassword.innerHTML = "Password and confirm password do not match.";
                password.classList.add('border-danger');
            } else {
                errorpassword.innerHTML = '';
                password.classList.remove('border-danger');
            }
       }
    } 
}

if (confirmpassword.value === '') {
    errorconfirmpassword.innerHTML = 'Confirm Password must not be empty!';
    confirmpassword.classList.add('border-danger');
} else {
    if (confirmpassword.value.length < 8) {
        errorconfirmpassword.innerHTML = 'Confirm Password must be greater than or equal to 8 characters in length!';
        confirmpassword.classList.add('border-danger');
    } else {
        if (confirmpassword.value.length > 26) {
            errorconfirmpassword.innerHTML = 'Confirm Password must not exceed 26 characters in length!';
            confirmpassword.classList.add('border-danger');
           } else {
               if (password.value != confirmpassword.value) {
                  errorconfirmpassword.innerHTML = "Password and confirm password do not match.";
                  confirmpassword.classList.add('border-danger');
               } else {
                  errorconfirmpassword.innerHTML = '';
                  confirmpassword.classList.remove('border-danger');
               }
           }
    }
}


if (email.value === '') {
    erroremail.innerHTML = 'Email must not be empty!';
    email.classList.add('border-danger');
} else {
    if (!emailPattern.test(email.value)) {
        erroremail.innerHTML = 'Email format is incorrect!';
        email.classList.add('border-danger');
    } else {
        erroremail.innerHTML = '';
        email.classList.remove('border-danger');
    }
}

if (phonenumber.value === '') {
    errorphonenumber.innerHTML = 'Phone number must not be empty!';
    phonenumber.classList.add('border-danger');
} else {
    if (!numbersOnly.test(phonenumber.value)) {
        errorphonenumber.innerHTML = 'Phone number must only contain digits!';
        phonenumber.classList.add('border-danger');
    } else {
        errorphonenumber.innerHTML = '';
        phonenumber.classList.remove('border-danger');
    }
}

if (birthday.value === '') {
    errorbirthday.innerHTML = 'Birthday must not be empty!';
    birthday.classList.add('border-danger');
} else {
    errorbirthday.innerHTML = '';
    birthday.classList.remove('border-danger');
}

if (gender.value === 'Specify') {
    errorgender.innerHTML = 'Gender must not be empty!';
    gender.classList.add('border-danger');
} else {
    errorgender.innerHTML = '';
    gender.classList.remove('border-danger');
}

if (country.value === 'Your country') {
    errorcountry.innerHTML = 'Country must not be empty!';
    country.classList.add('border-danger');
} else {
    errorcountry.innerHTML = '';
    country.classList.remove('border-danger');
}

if (region.value === 'Your region') {
    errorregion.innerHTML = 'Region / State must not be empty!';
    region.classList.add('border-danger');
} else {
    errorregion.innerHTML = '';
    region.classList.remove('border-danger');
}

if (city.value === 'Your city') {
    errorcity.innerHTML = 'City must not be empty!';
    city.classList.add('border-danger');
} else {
    errorcity.innerHTML = '';
    city.classList.remove('border-danger');
}

if (postcode.value === '') {
    errorpostcode.innerHTML = 'Post code must not be empty!';
    postcode.classList.add('border-danger');
} else {
    errorpostcode.innerHTML = '';
    postcode.classList.remove('border-danger');
}

if (barangay.value === '') {
    errorbarangay.innerHTML = 'Barangay must not be empty!';
    barangay.classList.add('border-danger');
} else {
    errorbarangay.innerHTML = '';
    barangay.classList.remove('border-danger');
}

if (street.value === '') {
    errorstreet.innerHTML = 'Street must not be empty!';
    street.classList.add('border-danger');
} else {
    errorstreet.innerHTML = '';
    street.classList.remove('border-danger');
}

var allow = true;

var termService = document.getElementById('termservice');
var errorservice = document.getElementById('error-termservice');

if (termService.checked) {
    allow = true;
    errorservice.innerHTML = '';
    
    if (termService.classList.contains('border-danger')) {
        termService.classList.replace('border-danger', 'border-dark');
    }
} else {
    allow = false;
    errorservice.innerHTML = 'Please agree to the terms of service in order to proceed.';
    
    if (termService.classList.contains('border-dark')) {
        termService.classList.replace('border-dark', 'border-danger');
    }

    event.preventDefault();

    return;
}



var allFormFields = document.querySelectorAll('.error-selector');

allFormFields.forEach(element => {
    if (element.textContent !== '') {
        allow = false;

        return;
    }
});




if (!allow) {


    event.preventDefault();

    return;
 
}  else {

    allow = false;
}
}


var checkbutton = document.querySelector('.check-username');
var checkindicator = document.querySelector('.check-indicator');

checkbutton.addEventListener('click', function() {

var usernameInput = document.getElementById('username');
var username = usernameInput.value;

fetch('php-addons/check_username.php?username=' + encodeURIComponent(username))
.then(function(response) {
  if (response.ok) {
    return response.json();
  } else {
    throw new Error('Error: ' + response.status);
  }
})
.then(function(data) {

    var usernameField = document.getElementById('username');
    var erroruser = document.getElementById('error-username');

    if (usernameField.value === '') {
        erroruser.innerHTML = 'Username must not be empty!';

        if (checkindicator.classList.contains('fa-regular')) {
            checkindicator.classList.remove('fa-regular');
            checkindicator.classList.remove('fa-circle');

            checkindicator.classList.add('fa-solid');
            checkindicator.classList.add('fa-circle-xmark');

            if (checkbutton.classList.contains('btn-outline-dark')) {
                checkbutton.classList.remove('btn-outline-dark');
                checkbutton.classList.add('btn-danger');
            } else if (checkbutton.classList.contains('btn-success')){
                checkbutton.classList.remove('btn-success');
                checkbutton.classList.add('btn-danger');
            }
        } else if (checkindicator.classList.contains('fa-solid')) {
            checkindicator.classList.add('fa-solid');
            checkindicator.classList.add('fa-circle-xmark');

            if (checkbutton.classList.contains('btn-outline-dark')) {
                checkbutton.classList.remove('btn-outline-dark');
                checkbutton.classList.add('btn-danger');
            } else if (checkbutton.classList.contains('btn-success')){
                checkbutton.classList.remove('btn-success');
                checkbutton.classList.add('btn-danger');
            }
        }

        checkindicator.classList.remove('fa-regular');
       
        
        usernameField.classList.add('border-danger');
    } else {
        if (usernameField.value.length < 6) {
            erroruser.innerHTML = 'Username must be greater than or equal to 6 characters in length!';
            if (checkindicator.classList.contains('fa-regular')) {
                checkindicator.classList.remove('fa-regular');
                checkindicator.classList.remove('fa-circle');

                checkindicator.classList.add('fa-solid');
                checkindicator.classList.add('fa-circle-xmark');

                if (checkbutton.classList.contains('btn-outline-dark')) {
                    checkbutton.classList.remove('btn-outline-dark');
                    checkbutton.classList.add('btn-danger');
                } else if (checkbutton.classList.contains('btn-success')){
                    checkbutton.classList.remove('btn-success');
                    checkbutton.classList.add('btn-danger');
                }
            } else if (checkindicator.classList.contains('fa-solid')) {
                checkindicator.classList.add('fa-solid');
                checkindicator.classList.add('fa-circle-xmark');

                if (checkbutton.classList.contains('btn-outline-dark')) {
                    checkbutton.classList.remove('btn-outline-dark');
                    checkbutton.classList.add('btn-danger');
                } else if (checkbutton.classList.contains('btn-success')){
                    checkbutton.classList.remove('btn-success');
                    checkbutton.classList.add('btn-danger');
                }
            }


            usernameField.classList.add('border-danger');
        } else {
           if (usernameField.value.length > 18) {
            erroruser.innerHTML = 'Username must not exceed 18 characters in length!';

            if (checkindicator.classList.contains('fa-regular')) {
                checkindicator.classList.remove('fa-regular');
                checkindicator.classList.remove('fa-circle');

                checkindicator.classList.add('fa-solid');
                checkindicator.classList.add('fa-circle-xmark');

                if (checkbutton.classList.contains('btn-outline-dark')) {
                    checkbutton.classList.remove('btn-outline-dark');
                    checkbutton.classList.add('btn-danger');
                } else if (checkbutton.classList.contains('btn-success')){
                    checkbutton.classList.remove('btn-success');
                    checkbutton.classList.add('btn-danger');
                }
            } else if (checkindicator.classList.contains('fa-solid')) {
                checkindicator.classList.add('fa-solid');
                checkindicator.classList.add('fa-circle-xmark');

                if (checkbutton.classList.contains('btn-outline-dark')) {
                    checkbutton.classList.remove('btn-outline-dark');
                    checkbutton.classList.add('btn-danger');
                } else if (checkbutton.classList.contains('btn-success')){
                    checkbutton.classList.remove('btn-success');
                    checkbutton.classList.add('btn-danger');
                }
            }

        
            usernameField.classList.add('border-danger');
           } else {
            if (!usernamePattern.test(usernameField.value)) {
                erroruser.innerHTML = 'Username must only contain alphabetical characters, digits (0-9), and a dot (.)!';

                if (checkindicator.classList.contains('fa-regular')) {
                    checkindicator.classList.remove('fa-regular');
                    checkindicator.classList.remove('fa-circle');
    
                    checkindicator.classList.add('fa-solid');
                    checkindicator.classList.add('fa-circle-xmark');
    
                    if (checkbutton.classList.contains('btn-outline-dark')) {
                        checkbutton.classList.remove('btn-outline-dark');
                        checkbutton.classList.add('btn-danger');
                    } else if (checkbutton.classList.contains('btn-success')){
                        checkbutton.classList.remove('btn-success');
                        checkbutton.classList.add('btn-danger');
                    }
                } else if (checkindicator.classList.contains('fa-solid')) {
                    checkindicator.classList.add('fa-solid');
                    checkindicator.classList.add('fa-circle-xmark');

                    if (checkbutton.classList.contains('btn-outline-dark')) {
                        checkbutton.classList.remove('btn-outline-dark');
                        checkbutton.classList.add('btn-danger');
                    } else if (checkbutton.classList.contains('btn-success')){
                        checkbutton.classList.remove('btn-success');
                        checkbutton.classList.add('btn-danger');
                    }
                }

                usernameField.classList.add('border-danger');
            } else {
                if (usernameField.value.split('.').length > 2) {
                    erroruser.innerHTML = 'Username should not contain more than one dot!';

                    if (checkindicator.classList.contains('fa-regular')) {
                        checkindicator.classList.remove('fa-regular');
                        checkindicator.classList.remove('fa-circle');
        
                        checkindicator.classList.add('fa-solid');
                        checkindicator.classList.add('fa-circle-xmark');
        
                        if (checkbutton.classList.contains('btn-outline-dark')) {
                            checkbutton.classList.remove('btn-outline-dark');
                            checkbutton.classList.add('btn-danger');
                        } else if (checkbutton.classList.contains('btn-success')){
                            checkbutton.classList.remove('btn-success');
                            checkbutton.classList.add('btn-danger');
                        }
                    } else if (checkindicator.classList.contains('fa-solid')) {
                        checkindicator.classList.add('fa-solid');
                        checkindicator.classList.add('fa-circle-xmark');

                        if (checkbutton.classList.contains('btn-outline-dark')) {
                            checkbutton.classList.remove('btn-outline-dark');
                            checkbutton.classList.add('btn-danger');
                        } else if (checkbutton.classList.contains('btn-success')){
                            checkbutton.classList.remove('btn-success');
                            checkbutton.classList.add('btn-danger');
                        }
                    }
                    
                    usernameField.classList.add('border-danger');
                } else {
                    erroruser.innerHTML = '';
                    usernameField.classList.remove('border-danger');
                    
                    if (data.available) {
                            
                    
                        usernameField.classList.remove('border-danger');
                        usernameField.classList.add('border-success');
                
                        erroruser.innerHTML = '';

                        isUsernameAvailable = true;

                        if (checkindicator.classList.contains('fa-circle-xmark')) {
                            checkindicator.classList.remove('fa-circle-xmark');

                            checkindicator.classList.add('fa-circle-check');

                            if (checkbutton.classList.contains('btn-danger')) {
                                checkbutton.classList.remove('btn-danger');
                                checkbutton.classList.add('btn-success');
                            }
                        } else if (checkindicator.classList.contains('fa-regular') && checkindicator.classList.contains('fa-circle')) {
                            checkindicator.classList.remove('fa-regular');
                            checkindicator.classList.remove('fa-circle');

                            checkindicator.classList.add('fa-solid');
                            checkindicator.classList.add('fa-circle-check');

                            checkbutton.classList.remove('btn-outline-dark');
                            checkbutton.classList.add('btn-success');
                        }
                
                      } else {
                        usernameField.classList.remove('border-success');
                        usernameField.classList.add('border-danger');

                        if (checkindicator.classList.contains('fa-regular')) {
                            checkindicator.classList.remove('fa-regular');
                            checkindicator.classList.remove('fa-circle');
            
                            checkindicator.classList.add('fa-solid');
                            checkindicator.classList.add('fa-circle-xmark');
            
                            if (checkbutton.classList.contains('btn-outline-dark')) {
                                checkbutton.classList.remove('btn-outline-dark');
                                checkbutton.classList.add('btn-danger');
                            } else if (checkbutton.classList.contains('btn-success')){
                      
                                checkbutton.classList.remove('btn-success');
                                checkbutton.classList.add('btn-danger');
                            }

                        } else if (checkindicator.classList.contains('fa-solid')) {
                            checkindicator.classList.add('fa-solid');
                            checkindicator.classList.add('fa-circle-xmark');

                            if (checkbutton.classList.contains('btn-outline-dark')) {
                                checkbutton.classList.remove('btn-outline-dark');
                                checkbutton.classList.add('btn-danger');
                            } else if (checkbutton.classList.contains('btn-success')){
                             
                                checkbutton.classList.remove('btn-success');
                                checkbutton.classList.add('btn-danger');
                            }

                        }
            
                        
                        erroruser.innerHTML = 'Username is already taken!';
                  
                      }
                }
            }
           }
        }
    } 

})
.catch(function(error) {
  console.log('An error occurred:', error);
});

});

