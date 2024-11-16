document.addEventListener('DOMContentLoaded', function() {

    alert(1);

    if (urlcatdefault !== null && urlcatdefault !== '') {
        document.getElementById('category-section-title').innerHTML = urlcatdefault.charAt(0).toUpperCase() + urlcatdefault.slice(1);
    } 

    function changeURL(newurl) {

        var newUrl = window.location.origin + window.location.pathname + "?cat=" + newurl;
        window.history.pushState({ path: newUrl }, '', newUrl);

        console.log("New URL: " + newUrl);
    }

   
    changeURL(urlcatdefault);

    document.querySelectorAll('.menu-item-text').forEach((menu, index) => {
     
        menu.addEventListener('click', function() {
            if (!menu.classList.contains('active')) {

                document.querySelectorAll('.menu-item-text').forEach(m => {
                    if (m.classList.contains('active')) {
                        m.classList.remove('active');
                    }
                });

                $('#right-panel').load('menus/' + menu.getAttribute('file') + '.php', function() {

                    if (menu.getAttribute('file') == 'profile') {
                        $.getScript('JS/profile.js');
                    } else if (menu.getAttribute('file') == 'payments'){
                        $.getScript('JS/paymentF2.js');
                    } else if (menu.getAttribute('file') == 'orders') {
                        $.getScript('JS/orders.JS');
                    }


                    menu.classList.add('active');

                    changeURL(menu.getAttribute('file'));

                    document.getElementById('category-section-title').innerHTML = menu.getAttribute('file').charAt(0).toUpperCase() + menu.getAttribute('file').slice(1);
                    document.getElementById('selected-menu').innerHTML = menu.getAttribute('file').charAt(0).toUpperCase() + menu.getAttribute('file').slice(1);
                });


            }
        });

        if (urlcatdefault !== null && urlcatdefault !== '') {
            if (menu.getAttribute('file') == urlcatdefault) {
                menu.click();
            }
        } else {
            if (index === 0) {
                menu.click();
            }
        }

    });

    document.getElementById('menu-item-button').addEventListener('click', function() {
        const spinningElement = document.getElementById('spinningElement');
        spinningElement.classList.add('rotated');
  
        if (spinningElement.classList.contains('fa-chevron-down')) {
            setTimeout(function() {
                spinningElement.classList.remove('rotated');
                spinningElement.classList.remove('fa-chevron-down');
                spinningElement.classList.add('fa-bars');
              }, 300);
        } else {
            setTimeout(function() {
                spinningElement.classList.remove('rotated');
                spinningElement.classList.remove('fa-bars');
                spinningElement.classList.add('fa-chevron-down')
              }, 300);
        }
    })
});