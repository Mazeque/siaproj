document.addEventListener('DOMContentLoaded', function() {


    document.querySelectorAll('.category-title').forEach(element => {
        element.addEventListener('click', function() {

            document.querySelectorAll('.category-title').forEach(sub => {
                if (sub.classList.contains('active-title')) {
                    sub.classList.remove('active-title');
                }
            });

            element.classList.add('active-title');

            let category =  element.getAttribute('category');
            let name = element.getAttribute('name');

            $('#shop-content').load('loadshop.php', {
               category: category,
               name: name
            }, function() {


            }) ;
        });
    });

});