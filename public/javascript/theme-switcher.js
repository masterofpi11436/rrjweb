var themeToggleBtn = document.getElementById('theme-toggle');
var themeLink = document.getElementById('theme-link');
var lightTheme = "/css/water-light.css";
var darkTheme = "/css/water-dark.css";

if (themeToggleBtn.addEventListener) {
    themeToggleBtn.addEventListener('click', toggleTheme);
} else if (themeToggleBtn.attachEvent) {
    themeToggleBtn.attachEvent('onclick', toggleTheme);
}

function toggleTheme() {
    if (themeLink.getAttribute('href') === lightTheme) {
        themeLink.setAttribute('href', darkTheme);
    } else {
        themeLink.setAttribute('href', lightTheme);
    }
}
