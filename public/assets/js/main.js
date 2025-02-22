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


// Column visibility toggles
function toggleDropdown() {
    document.getElementById("dropdownMenu").classList.toggle("active");
}

function toggleColumn(button, columnIndex) {
    console.log("Toggling column:", columnIndex);
    let icon = button.querySelector("i");
    if (icon.classList.contains("fa-check")) {
        icon.classList.remove("fa-check");
        icon.classList.add("fa-times");
    } else {
        icon.classList.remove("fa-times");
        icon.classList.add("fa-check");
    }
}

document.addEventListener("click", function (event) {
    const dropdown = document.getElementById("dropdownMenu");
    const button = document.querySelector(".dropdown-button");

    if (!dropdown.contains(event.target) && !button.contains(event.target)) {
        dropdown.classList.remove("active");
    }
});


// Initialize Dropify
$(document).ready(function () {
    $('.dropify').dropify();
});

// Toggle Between Table to Card
function toggleView() {
    let cardView = document.getElementById("cardView");
    let tableView = document.getElementById("tableView");
    let button = document.querySelector(".toggle-btn");
    let icon = button.querySelector("i");

    // If Card View is active, switch to Table View
    if (cardView.classList.contains("show", "active")) {
        // Hide Card View and Show Table View
        cardView.classList.remove("show", "active");
        tableView.classList.add("show", "active");

        // Update Button Text and Icon to Table View
        button.innerHTML = '<i class="fa-solid fa-id-card"></i> Grid View';  // Change to Card View
    } else {
        // Hide Table View and Show Card View
        tableView.classList.remove("show", "active");
        cardView.classList.add("show", "active");

        // Update Button Text and Icon to Table View
        button.innerHTML = '<i class="fa-solid fa-table-list"></i> List View';  // Change to Table View
    }
}

// Data Table
$(document).ready(function () {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        "language": {
            "paginate": {
                "previous": "<i class='fa-solid fa-angle-left'></i>", // Font Awesome left arrow
                "next": "<i class='fa-solid fa-angle-right'></i>" // Font Awesome right arrow
            }
        }
    });
    // Add event listener for column visibility toggles
    $('button.toggle-vis').on('click', function (e) {
        e.preventDefault();
        var column = table.column($(this).attr('data-column'));
        column.visible(!column.visible());
    });
});