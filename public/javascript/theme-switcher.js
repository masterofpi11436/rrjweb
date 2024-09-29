var themeToggleBtn = document.getElementById('theme-toggle');
var themeLink = document.getElementById('theme-link');
var lightTheme = "/css/water-light.css";
var darkTheme = "/css/water-dark.css";

// Function to toggle the theme
function toggleTheme() {
    if (themeLink.getAttribute('href') === lightTheme) {
        themeLink.setAttribute('href', darkTheme);
        localStorage.setItem('theme', 'dark'); // Store the dark theme preference
    } else {
        themeLink.setAttribute('href', lightTheme);
        localStorage.setItem('theme', 'light'); // Store the light theme preference
    }
}

// Add event listener for the theme toggle button
if (themeToggleBtn.addEventListener) {
    themeToggleBtn.addEventListener('click', toggleTheme);
} else if (themeToggleBtn.attachEvent) {
    themeToggleBtn.attachEvent('onclick', toggleTheme);
}

// Function to set the theme based on system preference or stored preference
function setTheme() {
    var storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
        // Apply the stored theme preference
        if (storedTheme === 'dark') {
            themeLink.setAttribute('href', darkTheme);
        } else {
            themeLink.setAttribute('href', lightTheme);
        }
    } else {
        // If no theme is stored, follow system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            themeLink.setAttribute('href', darkTheme);
        } else {
            themeLink.setAttribute('href', lightTheme);
        }
    }
}

// Apply the theme on page load
setTheme();

// For older browsers, use 'addListener' instead of 'addEventListener'
if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addListener(function () {
        setTheme();
    });
}