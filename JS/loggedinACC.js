document.addEventListener('DOMContentLoaded', function() {
    var userProfileButton = document.getElementById('user-profile-button');
    var userBox = document.getElementById('user-box');
    
    function handleClickOutside(event) {
      if (!userProfileButton.contains(event.target)) {
        userBox.style.transform = "translateX(150%)";

      }
    }
    
    userProfileButton.addEventListener('click', function() {
      userBox.style.transform = "translateX(0%)";
    });
    
    document.addEventListener('click', handleClickOutside);
  });