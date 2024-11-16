document.querySelectorAll('.process-order').forEach(element => {
    element.addEventListener('click', function() {
        $.ajax({
            url: 'php-addons/updateorderinfo.php',
            method: "POST",
            data: {
                orderid: element.getAttribute('orderid'),
            },
            success: function(resp) {
                if (resp) {
                    location.reload();
                }
            }
        });
    })
});