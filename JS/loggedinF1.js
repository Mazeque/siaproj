document.addEventListener('DOMContentLoaded', function() {

    var profilehandler = document.querySelector('.profile-button');
    var profilecontainer = document.getElementById('profile-container');
    var userpanel = document.querySelector('.image-carousel');
    
    profilehandler.addEventListener('mouseover', function() {
      if (!profilecontainer.classList.contains('d-lg-block')) {
        profilecontainer.classList.add('d-lg-block');
      } 
    });

    profilecontainer.addEventListener('mouseleave', function() {
        profilecontainer.classList.remove('d-lg-block');
    });

    userpanel.addEventListener('mouseleave', function() {
        if (profilecontainer.classList.contains('d-lg-block')) {
            profilecontainer.classList.remove('d-lg-block');
          }
    });
    

});