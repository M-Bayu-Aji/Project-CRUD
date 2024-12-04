/*=============== SHOW MENU ===============*/
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId);

    toggle.addEventListener("click", () => {
        // Add show-menu class to nav menu
        nav.classList.toggle("show-menu");

        // Add show-icon to show and hide the menu icon
        toggle.classList.toggle("show-icon");
    });
};

showMenu("nav-toggle", "nav-menu");

// Close hamburger menu when clicking outside
document.addEventListener("click", (event) => {
    const nav = document.getElementById("nav-menu");
    const toggle = document.getElementById("nav-toggle");

    if (!nav.contains(event.target) && !toggle.contains(event.target)) {
        nav.classList.remove("show-menu");
        toggle.classList.remove("show-icon");
    }
});

