var editbuttons = document.querySelectorAll('.edit');
var currentaccount = null;

var isAllowed = false;

fetch('https://restcountries.com/v3.1/all').then(res => {
    return res.json();
}).then(data => {
    let output = "";
    output += '<option>Your country</option>';
    data.forEach(element => {
        output += `<option>${element.name.common}</option>`;
    });

    document.getElementById('edit-country').innerHTML = output;
}).catch(err => {
    console.log(err);
});

        var defaultoption = document.createElement("option");
        defaultoption.text = "Select Account Type";
        defaultoption.value = "None";

        var useroption = document.createElement("option");
        useroption.text = "User";
        useroption.value = "User";

        var adminoption = document.createElement("option");
        adminoption.text = "Admin";
        adminoption.value = "Admin";

        document.getElementById('edit-accounttype').add(defaultoption);
        document.getElementById('edit-accounttype').add(useroption);
        document.getElementById('edit-accounttype').add(adminoption);

editbuttons.forEach(eb => {
    eb.addEventListener('click', function() {


        let myModal = new bootstrap.Modal(document.getElementById('myModal'), {});

        document.getElementById('myModal').setAttribute('index', parseInt(eb.getAttribute('index') - 1));

        currentaccount = document.getElementById('myModal').getAttribute('index');


        document.getElementById('editModalHeader').innerHTML = dynamicArray[currentaccount]['username'];
        document.getElementById('edit-id').innerHTML = dynamicArray[currentaccount]['id'];
        document.getElementById('edit-username').value = dynamicArray[currentaccount]['username'];
        document.getElementById('edit-firstname').value = dynamicArray[currentaccount]['firstname'];
        document.getElementById('edit-middlename').value = dynamicArray[currentaccount]['middlename'];
        document.getElementById('edit-lastname').value = dynamicArray[currentaccount]['lastname'];
        document.getElementById('edit-email').value = dynamicArray[currentaccount]['email'];
        document.getElementById('edit-contactnumber').value = dynamicArray[currentaccount]['contactnumber'];

        var genderselect = dynamicArray[currentaccount]['gender'];

        for (var i = 0; i < document.getElementById('edit-gender').options.length; i++) {
            if (document.getElementById('edit-gender').options[i].value === genderselect) {
                document.getElementById('edit-gender').options[i].selected = true;

                break;
            }
        }

        var birthdayselected = dynamicArray[currentaccount]['birthday'];
        document.getElementById('edit-birthday').value = birthdayselected;

        var countryselected = dynamicArray[currentaccount]['country'];
        var regionselected = dynamicArray[currentaccount]['region'];
        var cityselected = dynamicArray[currentaccount]['city'];

        for (var i = 0; i < document.getElementById('edit-country').options.length; i++) {
            if (document.getElementById('edit-country').options[i].value === countryselected) {
                document.getElementById('edit-country').options[i].selected = true;

                
                const rgSelector = document.getElementById('edit-state');
                const selectedCty = document.getElementById('edit-country');

                const selectedRGIN = countryData.find(item => item.country === selectedCty.value);

                if (selectedRGIN) {
                    let outputRG = "";
                    outputRG += "<option>Your state</option>";
                  
                    selectedRGIN.regions.forEach(rg => {
                        outputRG += `<option>${rg}</option>`;
                    });
    
                    rgSelector.innerHTML = outputRG;

                    for (var j = 0; j < document.getElementById('edit-state').options.length; j++) {
                        if (document.getElementById('edit-state').options[j].value === regionselected) {
                            document.getElementById('edit-state').options[j].selected = true;

                            const ctySelector = document.getElementById('edit-city');
                            const selectedRG = document.getElementById('edit-state');


                            const selectedRGIN = philippinesCities.find(item => item.region === selectedRG.value);

                            if (selectedRGIN) {
                            let output = "";
                            output += "<option>Your city</option>";
                            selectedRGIN.cities.forEach(region => {
                                output += `<option>${region}</option>`;
                            });

                            ctySelector.innerHTML = output;
                            } else {
                            ctySelector.innerHTML = "<option>Your city</option>";
                            }

                            for (var k = 0; k < document.getElementById('edit-city').options.length; k++) {
                                if (document.getElementById('edit-city').options[k].value === cityselected) {
                                    document.getElementById('edit-city').options[k].selected = true;
                                }
                            }


                            break;
                        }
                    }

                    } else {
                    rgSelector.innerHTML = "<option>Your state</option>";
                    }

   
   
                break;
            }
        }

        document.getElementById('edit-barangay').value = dynamicArray[currentaccount]['barangay'];
        document.getElementById('edit-street').value = dynamicArray[currentaccount]['street'];
        document.getElementById('edit-postcode').value = dynamicArray[currentaccount]['postcode'];

        var accounttype = dynamicArray[currentaccount]['account_type'];

        for (var i = 0; i < document.getElementById('edit-accounttype').options.length; i++) {
            if (document.getElementById('edit-accounttype').options[i].value === accounttype) {
                document.getElementById('edit-accounttype').options[i].selected = true;

                break;
            }
        }

        let successupdate = false;

        document.getElementById('edit-savebutton').addEventListener('click', function(event) {
            
            let tempusername = document.getElementById('edit-username').value;
            let tempfirstname = document.getElementById('edit-firstname').value;
            let tempmiddlename = document.getElementById('edit-middlename').value;
            let templastname = document.getElementById('edit-lastname').value;
            let tempaccounttype = document.getElementById('edit-accounttype').value;

            $.ajax({

                url: "../admin/php-addons/updateuser.php",
                method: "POST",
                data: {
                    id: dynamicArray[currentaccount]['id'],
                    username: document.getElementById('edit-username').value,
                    firstname: document.getElementById('edit-firstname').value,
                    middlename: document.getElementById('edit-middlename').value,
                    lastname: document.getElementById('edit-lastname').value,
                    email: document.getElementById('edit-email').value,
                    contactnumber: document.getElementById('edit-contactnumber').value,
                    gender: document.getElementById('edit-gender').value,
                    birthday: document.getElementById('edit-birthday').value,
                    country: document.getElementById('edit-country').value,
                    state: document.getElementById('edit-state').value,
                    city: document.getElementById('edit-city').value,
                    barangay: document.getElementById('edit-barangay').value,
                    street: document.getElementById('edit-street').value,
                    postcode: document.getElementById('edit-postcode').value,
                    accounttype: document.getElementById('edit-accounttype').value,
                },
                success: function(response) {

                    if (response === 'Update Successful') {
             
                        $("#content-panel").load("php-addons/load-panel.php", {
                            panel: 'users'
                        }, function() {

                            $.getScript('JS/locationsF1.js');
                            $.getScript('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit')
                            $.getScript('https://www.google.com/recaptcha/api.js');
                            $.getScript('JS/usersF3.js');

                            $('.success').removeClass("d-none");
                            $('.success').addClass("show");
                            $('.success').removeClass("hide");
                            $('.success').addClass("showSuccess");
                            setTimeout(function(){
                                $('.success').removeClass("show");
                                $('.success').addClass("hide");
                            },2000);
                            setTimeout(function() {
                                $('.success').addClass("d-none");
                                tempusername = username;
                            }, 3000)

                            successupdate = true;

                            success(successupdate, tempusername, tempfirstname, tempmiddlename, templastname, tempaccounttype);
                          
                          
                            myModal.hide();
                        });
                     
                    } else {

                        successupdate = true;

                        success(successupdate, tempusername, tempfirstname, tempmiddlename, templastname, tempaccounttype);
                      
                        myModal.hide();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }

            });

            
      
        });

        myModal.show();


     

   
    });
});

function success(issuccess, username, firstname, middlename, lastname, accounttype) {
    if (issuccess) {
        $.ajax({
            url: "php-addons/updatesession.php",
            method: 'POST',
            data: {
                id: dynamicArray[currentaccount]['id'],
                usernameses: username,
                firstnameses: firstname,
                middlenameses: middlename,
                lastnameses: lastname,
                accounttypeses: accounttype
            },
            success: function(response) {

                if (!response) {
                    $.get('php-addons/unsetsession.php');
                }
      
            },
            error: function(response) {
        
            }
        })

    } else {

    }
}