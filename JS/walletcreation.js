document.getElementById('wallet-creation').addEventListener('click', function() {
   $.ajax({
    url: 'php-addons/createwallet.php',
    success: function(resp) {
        if (resp) {
            $('#activate-wallet-Modal').modal('hide');

            location.reload();
        }
    }
   }); 
});