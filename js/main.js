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

// Data Table
$(document).ready(function () {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        columnDefs: [{
            targets: 0, // First column (expand/collapse)
            orderable: false, // Disable sorting for this column
            searchable: false // Disable search for this column
        }],
        "language": {
            "paginate": {
                "previous": "<i class='fa-solid fa-angle-left'></i>", // Font Awesome left arrow
                "next": "<i class='fa-solid fa-angle-right'></i>" // Font Awesome right arrow
            }
        }
    });

    // Add event listener for opening and closing details
    $('#dataTable tbody').on('click', '.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // Close the row
            row.child.hide();
            tr.removeClass('shown');
            $(this).html('<i class="fa-solid fa-circle-plus"></i>');
        } else {
            // Open the row
            row.child(formatDetails(row.data())).show();
            tr.addClass('shown');
            $(this).html('<i class="fa-solid fa-circle-minus"></i>');
        }
    });

    // Function to create the details row content
    function formatDetails(data) {
        return (
            '<div class="details-row p-3">' +
            '<p><strong>Additional Details:</strong> This is some plain text about ' + data[2] + '.</p>' +
            '<p><strong>Phone:</strong> ' + data[3] + '</p>' +
            '<p><strong>Email:</strong> ' + data[4] + '</p>' +
            '<p><strong>Address:</strong> ' + data[5] + '</p>' +
            '</div>'
        );
    }

    // Add event listener for column visibility toggles
    $('button.toggle-vis').on('click', function (e) {
        e.preventDefault();
        var column = table.column($(this).attr('data-column'));
        column.visible(!column.visible());
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


 // Delete Confirm
$('.delete_confirm').click(function(event) {
    var form = $(this).closest("form");
    event.preventDefault();

    Swal.fire({
        title: 'Do you want to delete this?'
        , text: "Once deleted, you will not be able to recover this!"
        , icon: 'warning'
        , showCancelButton: true
        , confirmButtonColor: '#3085d6'
        , cancelButtonColor: '#d33'
        , confirmButtonText: 'Yes, delete it'
        , reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});


 // Toastr Alert
document.addEventListener("DOMContentLoaded", function () {
    // Check if a message is stored in localStorage
    let message = localStorage.getItem('message');

    if (message) {
        toastr.options = {
            "progressBar": true,
            "closeButton": true
        };
        toastr.success(message);

        // Remove message after displaying it
        localStorage.removeItem('message');
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
        button.innerHTML = '<i class="fa-solid fa-id-card"></i> Card View';  // Change to Card View
    } else {
        // Hide Table View and Show Card View
        tableView.classList.remove("show", "active");
        cardView.classList.add("show", "active");

        // Update Button Text and Icon to Table View
        button.innerHTML = '<i class="fa-solid fa-table-list"></i> Table View';  // Change to Table View
    }
}