
document.querySelectorAll(".orders-btn").forEach((element, index) => {
    element.addEventListener('click', function () {
        
        document.querySelectorAll(".orders-btn").forEach(btn => {
            if (btn.classList.contains("btn-dark")) {
                btn.classList.replace("btn-dark", "btn-outline-dark");
            }
        });

        element.classList.replace("btn-outline-dark", "btn-dark");

        const sharraine = element.getAttribute("orderbtns");
 
        const container = document.getElementById("orders-content");

        $("#orders-content").load('php-addons/load' + sharraine + 'orders.php', function() {
            if (sharraine == 'active' || sharraine == 'all') {
                $.getScript('JS/loadprocessdelivery.js');
            }

            if (sharraine == 'all' || sharraine == 'delivered') {
                $.getScript('JS/loadreviewmodal.js');
            }
        });
    });


    if (index == 0) {
        element.click();
    }
});


