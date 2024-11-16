document.querySelectorAll('.order-received').forEach(element => {
   element.addEventListener('click', function() {
    const orderid = element.getAttribute('orderid');

    $.ajax({
        url: 'php-addons/updateorderinfo.php',
        data: {
            orderid: orderid
        },
        method: "POST",
        success: function(resp) {
            if (resp) {
                window.location.href = "menu?cat=orders";
            }
        }
    });
   });
});

document.querySelectorAll('.cancel-order').forEach(element => {
    element.addEventListener('click', function() {
        const orderid = element.getAttribute('orderid');

        $.ajax({
            url: 'php-addons/cancelorder.php',
            data: {
                orderid: orderid
            },
            method: "POST",
            success: function(resp) {
                if (resp) {
                    window.location.href = "menu?cat=orders";
                }

                
            }
        });
    });
});