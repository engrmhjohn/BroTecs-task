// Dark Night Toggle
document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById('theme-toggle');
    const rootElement = document.documentElement;
    const currentTheme = localStorage.getItem('theme') || 'light';

    // Apply saved theme
    rootElement.setAttribute('data-bs-theme', currentTheme);

    // Update toggle button state
    if (themeToggle) {
        themeToggle.checked = currentTheme === 'dark';

        // Listen for changes
        themeToggle.addEventListener('change', () => {
            const newTheme = themeToggle.checked ? 'dark' : 'light';
            rootElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }
});


// Profile Dropdown
document.addEventListener("DOMContentLoaded", function () {
    const profileToggle = document.querySelector(".profile-toggle");
    const profileDropdown = document.querySelector(".profile-dropdown");

    profileToggle.addEventListener("click", function (e) {
        e.preventDefault();
        // Toggle the 'show' class for the dropdown
        profileDropdown.classList.toggle("show");
    });

    document.addEventListener("click", function (e) {
        // Check if the clicked element is outside the profile toggle and dropdown
        if (!profileToggle.contains(e.target) && !profileDropdown.contains(e.target)) {
            // Remove 'show' class if the dropdown is open
            if (profileDropdown.classList.contains("show")) {
                profileDropdown.classList.remove("show");
            }
        }
    });
});

// Employee Card Address Expand



