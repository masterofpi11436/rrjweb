// Function to detect if smooth scrolling is supported, with fallback for IE
function smoothScrollToTop() {
    if ('scrollBehavior' in document.documentElement.style) {
        // If the browser supports smooth scroll behavior
        window.scrollTo({ top: 0, behavior: 'smooth' });
    } else {
        // Fallback for IE or older browsers
        window.scrollTo(0, 0);
    }
}

// Show or hide the "Back to Top" button based on scroll position
window.onscroll = function () {
    let backToTopButton = document.getElementById('back-to-top');
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        backToTopButton.style.display = 'block';
    } else {
        backToTopButton.style.display = 'none';
    }
};

// Add click event to the "Back to Top" button
document.getElementById('back-to-top').addEventListener('click', function (e) {
    e.preventDefault();
    smoothScrollToTop();
});