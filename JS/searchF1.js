document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searching-button').addEventListener('click', function() {

        window.location.href = "products?id=" + searchedid;

    });

    document.getElementById('search-input-field').addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            window.location.href = "products?id=" + searchedid;
        }
    });
});