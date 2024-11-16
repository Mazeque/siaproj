document.addEventListener('DOMContentLoaded', function() {

    var container1 = document.getElementById('forgot-container-1');
    var emailbutton = document.getElementById('email-recovery');

    var container2 = document.getElementById('forgot-container-2');
    var securityquestionbutton = document.getElementById('security-question-recovery');

    var container3 = document.getElementById('forgot-container-3');
    var recoverypasswordbutton = document.getElementById('recovery-password-recovery');

    var container4 = document.getElementById('forgot-container-4');
    var phonebutton = document.getElementById('phone-recovery');

    container1.addEventListener('click', function() {
        if (!emailbutton.checked) {
            emailbutton.checked = true;
        }
    });

    container2.addEventListener('click', function() {
        if (!securityquestionbutton.checked) {
            securityquestionbutton.checked = true;
        }
    });

    container3.addEventListener('click', function() {
        if (!recoverypasswordbutton.checked) {
            recoverypasswordbutton.checked = true;
        }
    });

    container4.addEventListener('click', function() {
        if (!phonebutton.checked) {
            phonebutton.checked = true;
        }
    });

    document.getElementById("forgot-password-form").addEventListener("submit", function(event) {
        event.preventDefault();
        var recoveryMethods = document.querySelector('input[name="recoverymethods"]:checked').value;
        var formAction = "forgotpassword?rec=" + recoveryMethods;
        this.action = formAction;
        this.submit();
    });


});

const eventListener = function handleClick(event) {
    event.preventDefault();
};

var allow = false;

function triggerFormSubmit() {
    allow = false;
}

function continuebutton() {
    let button = document.getElementById('continue-button');
    button.innerHTML = "<div class = 'loader'></div>";
}

function submitOption2(event) {

    let submitform = document.getElementById('submit-form');

    if (!allow) {
        submitform.addEventListener('click', eventListener(event));
    }

    let username = document.getElementById('username');
    let usernameError = document.getElementById('error-username');

    let answer = document.getElementById('answer');
    let answerError = document.getElementById('error-securityanswer');

    const form = document.getElementById('security-question-form');

    let firstcontainer = document.getElementById('forgot-container-initial');
    let secondcontainer = document.getElementById('forgot-container-final');

    if (submitform.textContent.trim() === 'Next') {
        if (username.value.length < 6) {
            username.classList.add('border-danger');
            usernameError.innerHTML = 'Please enter a valid username!';
        } else {
            if (username.value !== '') {
                usernameError.innerHTML = '';
            }

            fetch('php-addons/get_question.php?username=' + encodeURIComponent(username.value))
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error' + response.status);
                    }
                })
                .then(function(data) {
                    if (data.available) {
                        var securityQuestion = null;
                        username.classList.remove('border-danger');
                        username.classList.add('border-success');
                        securityQuestion = data.available;

                        document.getElementById('security-question-fetched').innerHTML = securityQuestion['security_q'];

                        submitform.innerHTML = 'Submit';

                        firstcontainer.style.opacity = '0';

                        setTimeout(function() {
                            firstcontainer.classList.add('d-none');
                            secondcontainer.classList.remove('d-none');
                            secondcontainer.style.opacity = '0';
                        }, 500);

                        setTimeout(function() {
                            secondcontainer.style.opacity = '1';
                        }, 600);
                    } else {
                        username.classList.add('border-danger');
                        usernameError.innerHTML = 'Username does not exist!';

                        return;
                    }
                });
        }
    } else if (submitform.textContent.trim() === 'Submit') {
        if (answer.value !== '') {
            answerError.innerHTML = '';
            answer.classList.remove('border-danger');

            fetch('php-addons/get_question.php?username=' + encodeURIComponent(username.value))
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error' + response.status);
                    }
                })
                .then(function(data) {
                    if (data.available) {
                        var securityQuestion = null;
                        securityQuestion = data.available;

                        if (answer.value.toLowerCase() === securityQuestion['security_a'].toLowerCase()) {

                            if (allow) {
                                submitform.innerHTML = "<div class = 'loader'></div>"
                                triggerFormSubmit();
                            }

                            allow = true;

                            setTimeout(submitform.click(), 500);

                            return;

                        } else {
                            answer.classList.add('border-danger');
                            answerError.innerHTML = 'Incorrect Answer!';
                        }
                    } else {
                        answer.classList.add('border-danger');
                        answerError.innerHTML = 'Error while fetching the question for this account!';
                        return;
                    }
                });
        } else {
            answerError.innerHTML = 'Please answer the question first before submitting!';
            answer.classList.add('border-danger');
        }
    }

    return;
}

function submitOption3(event) {

    let submitform = document.getElementById('submit-form');

    if (!allow) {
        submitform.addEventListener('click', eventListener(event));
    }

    let username = document.getElementById('username');
    let usernameError = document.getElementById('error-username');

    let answer = document.getElementById('recoverypassword');
    let answerError = document.getElementById('error-recoverypasword');

    const form = document.getElementById('recovery-pasword-form');

    let firstcontainer = document.getElementById('forgot-container-initial');
    let secondcontainer = document.getElementById('forgot-container-final');

    if (submitform.textContent.trim() === 'Next') {
        if (username.value.length < 6) {
            username.classList.add('border-danger');
            usernameError.innerHTML = 'Please enter a valid username!';
        } else {
            if (username.value !== '') {
                usernameError.innerHTML = '';
            }

            fetch('php-addons/get_question.php?username=' + encodeURIComponent(username.value))
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error' + response.status);
                    }
                })
                .then(function(data) {
                    if (data.available) {

                        fetch('php-addons/get_recovery.php?username=' + encodeURIComponent(username.value))
                            .then(function(response) {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Error' + response.status);
                                }
                            })
                            .then(function(data) {
                                if (data.available) {

                                    var securityQuestion = null;
                                    username.classList.remove('border-danger');
                                    username.classList.add('border-success');
                                    securityQuestion = data.available;

                                    submitform.innerHTML = 'Submit';

                                    firstcontainer.style.opacity = '0';

                                    setTimeout(function() {
                                        firstcontainer.classList.add('d-none');
                                        secondcontainer.classList.remove('d-none');
                                        secondcontainer.style.opacity = '0';
                                    }, 500);

                                    setTimeout(function() {
                                        secondcontainer.style.opacity = '1';
                                    }, 600);
                                } else {
                                    username.classList.add('border-danger');
                                    usernameError.innerHTML = "This user doesn't set his/her recovery password!" + data.available;
                                    return;
                                }
                            });


                    } else {
                        username.classList.add('border-danger');
                        usernameError.innerHTML = 'Username does not exist!';

                        return;
                    }
                });
        }
    } else if (submitform.textContent.trim() === 'Submit') {
        if (answer.value !== '') {
            answerError.innerHTML = '';
            answer.classList.remove('border-danger');

            fetch('php-addons/get_recovery.php?username=' + encodeURIComponent(username.value))
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error' + response.status);
                    }
                })
                .then(function(data) {
                    if (data.available) {
                        var password = null;
                        password = data.available;

                        if (answer.value === password) {

                            if (allow) {
                                submitform.innerHTML = "<div class = 'loader'></div>"
                                triggerFormSubmit();
                            }

                            allow = true;

                            setTimeout(submitform.click(), 500);

                            return;

                        } else {
                            allow = false;
                            answer.classList.add('border-danger');
                            answerError.innerHTML = 'Incorrect Recovery Passowrd!';
                        }
                    } else {
                        answer.classList.add('border-danger');
                        answerError.innerHTML = "This user doesn't set his/her recovery password!";
                        return;
                    }
                });
        } else {
            answerError.innerHTML = 'Please fill up with your recovery password first before submitting!';
            answer.classList.add('border-danger');
        }
    }

    return;
}

function submitOption4(event) {

    let submitform = document.getElementById('submit-form');

    if (!allow) {
        submitform.addEventListener('click', eventListener(event));
    }

    let username = document.getElementById('username');
    let usernameError = document.getElementById('error-username');

    let answer = document.getElementById('phonerecovery');
    let answerError = document.getElementById('error-phonerecovery');

    const form = document.getElementById('phone-recovery-form');

    let firstcontainer = document.getElementById('forgot-container-initial');
    let secondcontainer = document.getElementById('forgot-container-final');

    if (submitform.textContent.trim() === 'Next') {
        if (username.value.length < 6) {
            username.classList.add('border-danger');
            usernameError.innerHTML = 'Please enter a valid username!';
        } else {
            if (username.value !== '') {
                usernameError.innerHTML = '';
            }

            fetch('php-addons/get_question.php?username=' + encodeURIComponent(username.value))
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error' + response.status);
                    }
                })
                .then(function(data) {
                    if (data.available) {
                        var securityQuestion = null;
                        username.classList.remove('border-danger');
                        username.classList.add('border-success');
                        securityQuestion = data.available;

                        submitform.innerHTML = 'Submit';

                        firstcontainer.style.opacity = '0';

                        setTimeout(function() {
                            firstcontainer.classList.add('d-none');
                            secondcontainer.classList.remove('d-none');
                            secondcontainer.style.opacity = '0';
                        }, 500);

                        setTimeout(function() {
                            secondcontainer.style.opacity = '1';
                        }, 600);
                    } else {
                        username.classList.add('border-danger');
                        usernameError.innerHTML = 'Username does not exist!';

                        return;
                    }
                });
        }
    } else if (submitform.textContent.trim() === 'Submit') {
        if (answer.value !== '') {
            answerError.innerHTML = '';
            answer.classList.remove('border-danger');

            fetch('php-addons/get_question.php?username=' + encodeURIComponent(username.value))
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error' + response.status);
                    }
                })
                .then(function(data) {
                    if (data.available) {
                        var securityQuestion = null;
                        securityQuestion = data.available;

                        if (answer.value.toLowerCase() === securityQuestion['security_a'].toLowerCase()) {

                            if (allow) {
                                submitform.innerHTML = "<div class = 'loader'></div>"
                                triggerFormSubmit();
                            }

                            allow = true;

                            setTimeout(submitform.click(), 500);

                            return;

                        } else {
                            allow = false;
                            answer.classList.add('border-danger');
                            answerError.innerHTML = 'Incorrect Code!';
                        }
                    } else {
                        answer.classList.add('border-danger');
                        answerError.innerHTML = 'Error while fetching the question for this account!';
                        return;
                    }
                });
        } else {
            answerError.innerHTML = 'Please fill up with the SMS you received first before submitting!';
            answer.classList.add('border-danger');
        }
    }

    return;
}