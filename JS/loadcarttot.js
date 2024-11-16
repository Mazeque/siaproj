document.addEventListener('DOMContentLoaded', function() {


    $.ajax({
        url: "check_login.php",
        method: "GET",
        dataType: "json",
        success: function(response) {
            var isLoggedIn = response.isLoggedIn;

            if (isLoggedIn) {
                $.ajax({
                    url: "gettotcart.php",
                    method: "POST",
                    data: {
                        userid: response.user_id
                    },
                    success: function(cartresponse) {
                        if (cartresponse) {
            
                            document.getElementById('count-tot-items').innerHTML = cartresponse;
                            setTimeout(function() {
                                
                            document.getElementById('count-tot-items').classList.add('show-tot-items');

                            if (document.getElementById('count-tot-items').classList.contains('show-tot-items')) {
                                document.getElementById('count-tot-items').classList.remove('show-tot-items');
                                document.getElementById('count-tot-items').classList.add('show-tot-items');
                            } else {
                                document.getElementById('count-tot-items').classList.add('show-tot-items');
                            }
                            }, 300);
                        }
                    }
                });
            }

        }
      });

})