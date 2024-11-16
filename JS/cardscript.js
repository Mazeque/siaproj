$("#card-name-field").on("keydown", function(e) {
    var cursor = this.selectionStart;
    if (this.selectionEnd !== cursor && e.which !== 46) return;
    if (e.which === 46) {
        if (this.value[cursor] === "/") this.selectionStart++;
    }
}).on("input", function() {
    var value = this.value;
    var cursor = this.selectionStart;
    var matches = value.substring(0, cursor).match(/[^A-Za-z.\s]/g);
    if (matches) cursor -= matches.length;
    value = value.replace(/[^A-Za-z.\s]/g, "");
    var formatted = "";
    for (var i = 0, n = value.length; i < n; i++) {
        if (formatted.length <= cursor) cursor++;
        formatted += value[i];
    }
    if (formatted === this.value) return;
    this.value = formatted;
    this.selectionEnd = cursor;
});

$("#card-number-field").on("keydown", function(e) {
    var cursor = this.selectionStart;
    if (this.selectionEnd != cursor) return;
    if (e.which == 46) {
        if (this.value[cursor] == " ") this.selectionStart++;
    } else if (e.which == 8) {
        if (cursor && this.value[cursor - 1] == " ") this.selectionEnd--;
    }
}).on("input", function() {
    var value = this.value;
    var cursor = this.selectionStart;
    var matches = value.substring(0, cursor).match(/[^0-9]/g);
    if (matches) cursor -= matches.length;
    value = value.replace(/[^0-9]/g, "").substring(0, 16);
    var formatted = "";
    for (var i=0, n=value.length; i<n; i++) {
        if (i && i % 4 == 0) {
            if (formatted.length <= cursor) cursor++;
            formatted += " ";
        }
        formatted += value[i];
    }
    if (formatted == this.value) return;

    if (value.length === 16) {
        noerrorfield1 = true;
    } else {
        noerrorfield1 = false;
    }

    if (/^5/.test(value)) {
        cardType = "Mastercard";
        $('div[pm="mastercard"]').click();

    } else if (/^4/.test(value)) {
        cardType = "Visa";
        $('div[pm="visa"]').click();
    } else if (/^3[47]/.test(value)) {
        cardType = "AMEX";
        $('div[pm="amex"]').click();
    }

    this.value = formatted;
    this.selectionEnd = cursor;

});

$("#expiry-field").on("keydown", function(e) {
    var cursor = this.selectionStart;
    if (this.selectionEnd != cursor) return;
    if (e.which == 46) {
        if (this.value[cursor] == "/") this.selectionStart++;
    } else if (e.which == 8) {
        if (cursor && this.value[cursor - 1] == "/") this.selectionEnd--;
    }
}).on("input", function() {
    var value = this.value;
    var cursor = this.selectionStart;
    var matches = value.substring(0, cursor).match(/[^0-9/]/g);
    if (matches) cursor -= matches.length;
    value = value.replace(/[^0-9]/g, "").substring(0, 4);
    var formatted = "";
    for (var i = 0, n = value.length; i < n; i++) {
        if (i == 2 && value.length > 2) {
            if (formatted.length <= cursor) cursor++;
            formatted += "/";
        }
        formatted += value[i];
    }
    if (formatted == this.value) return;
    this.value = formatted;
    this.selectionEnd = cursor;
});

$("#cvccvv-field").on("keydown", function(e) {
    var cursor = this.selectionStart;
    if (this.selectionEnd != cursor) return;
    if (e.which == 8) {
        if (cursor && this.value[cursor - 1] == " ") this.selectionEnd--;
    }
}).on("input", function() {
    var value = this.value;
    var cursor = this.selectionStart;
    value = value.replace(/[^0-9]/g, "").substring(0, 4);
    var formatted = "";
    for (var i = 0, n = value.length; i < n; i++) {
        if (i && i % 4 == 0) {
            if (formatted.length <= cursor) cursor++;
            formatted += " ";
        }
        formatted += value[i];
    }
    if (formatted == this.value) return;
    this.value = formatted;
    this.selectionEnd = cursor;
});


document.querySelectorAll('.box-card').forEach(element => {
    element.addEventListener('click', function() {

        document.querySelectorAll('.box-card').forEach(sub => {
            if (sub.classList.contains('active-pm')) {
                sub.classList.remove('active-pm')
            }
        });

        element.classList.add('active-pm');
       
        if (element.getAttribute('pm') == 'mastercard') {
            document.getElementById('card-img-suffix').src = 'Images/ModePay/mastercard-logo.png';
        } else if (element.getAttribute('pm') == 'visa') {
            document.getElementById('card-img-suffix').src = 'Images/ModePay/visa-logo.png';
        } else if (element.getAttribute('pm') == 'amex') {
            document.getElementById('card-img-suffix').src = 'Images/ModePay/amex-logo.png';
        }

        
        if (document.getElementById('card-img-suffix').classList.contains('d-none')) {
            document.getElementById('card-img-suffix').classList.remove('d-none');
        }

        if (document.getElementById('card-field-container').classList.contains('disabled')) {
            document.getElementById('card-field-container').classList.remove('disabled');
        }

        document.getElementById('proceedButton').disabled = false;
    });
});