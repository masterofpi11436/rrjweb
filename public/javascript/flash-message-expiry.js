// flash-message-expiry.js

document.addEventListener("DOMContentLoaded", function() {
    // Hide the flash message after 2 seconds
    setTimeout(function() {
        var flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 2000); // 2000ms = 2 seconds
});
