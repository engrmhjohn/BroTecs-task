<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BroTecs - Employee Management</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/all.min.css">
    <!-- Box Icons -->
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/boxicons.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/images/favicon.ico">
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/dropify.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/bootstrap-datatable.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/style.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/styles/responsive.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow">
        <div class="container d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('/') }}">
                <img src="{{ asset('assets') }}/images/logo.png" alt="Logo">
            </a>
            <div class="d-flex align-items-center">
                <!-- Color Mode Toggle -->
                <div class="theme-switch-wrapper me-3">
                    <label class="theme-switch">
                        <input type="checkbox" id="theme-toggle">
                        <span class="slider round"></span>
                    </label>
                </div>

                <!-- Profile Dropdown -->
                <div class="dropdown profile-nav">
                    <a class="nav-link d-flex align-items-center profile-toggle" href="#" role="button">
                        <img src="{{ asset('assets') }}/images/avatar.png" alt="Profile" class="rounded-circle" width="32" height="32">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <li class="px-3 py-2 text-center">
                            <strong>Mehedi Hasan John</strong><br>
                            <small class="text-muted">Super Admin <img src="{{ asset('assets') }}/images/verified.png" alt=""></small>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Sign Out</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>



    <!-- Mobile Dropdown for Color Toggle & Profile -->
    <div id="mobileMenu" class="d-lg-none position-absolute end-0 bg-white shadow-sm rounded p-3 d-none">
        <div class="mb-2">
            <label class="theme-switch">
                <input type="checkbox" id="mobile-theme-toggle">
                <span class="slider round"></span> <span>Dark Mode</span>
            </label>
        </div>
        <a href="#" class="d-block text-dark"><i class="fas fa-user me-2"></i> Profile</a>
        <a href="#" class="d-block text-danger mt-2"><i class="fas fa-sign-out-alt me-2"></i> Sign Out</a>
    </div>


    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-lg-2 col-md-3 col-sm-4 col-2 d-flex flex-column pt-3">
                <ul class="nav flex-column w-100">
                    <li class="nav-item">
                        <a href="{{ route('/') }}" data-bs-toggle="tab" class="nav-link active">
                            <i class="fa-solid fa-users"></i> <span class="d-sm-inline d-none">Employees</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-lg-10 col-md-9 col-sm-8 col-10 pt-2">
                <button class="btn toggle-btn view-change-btn mt-2" onclick="toggleView()">
                    <i class="fa-solid fa-id-card"></i> Grid View
                </button>
                <div class="tab-content">
                    <div id="tableView" class="tab-pane fade show active mb-3">
                        <div class="container mt-2">
                            <!-- Toggle Buttons for Column Visibility -->
                            <div class="custom-dropdown d-flex justify-content-end">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addEmployeeModal" class="add-icon btn add-employee-btn mb-2 me-2"><i class="fa-solid fa-user-plus"></i> Employee</a>
                                <button class="btn column-manage-btn mb-2" onclick="toggleDropdown()">
                                    <i class="fas fa-sliders-h"></i> Column Visibility
                                </button>
    
                                <div class="dropdown-menu" id="dropdownMenu">
                                    <div class="dropdown-header">Toggle columns</div>
                                    <button class="dropdown-item toggle-vis" data-column="1" onclick="toggleColumn(this, 1)">
                                        <span>Profile Picture</span>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="dropdown-item toggle-vis" data-column="2" onclick="toggleColumn(this, 2)">
                                        <span>Name</span>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="dropdown-item toggle-vis" data-column="3" onclick="toggleColumn(this, 3)">
                                        <span>Phone</span>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="dropdown-item toggle-vis" data-column="4" onclick="toggleColumn(this, 4)">
                                        <span>Email</span>
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="dropdown-item toggle-vis" data-column="5" onclick="toggleColumn(this, 5)">
                                        <span>Address</span>
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
    
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ asset('uploads/employees/' . $employee->profile_picture) }}" alt="Profile" class="employee-img me-2"></td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>
                                            <a href="#" class="edit-icon" data-id="{{ $employee->id }}" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <a href="#" class="delete-icon" data-id="{{ $employee->id }}">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="cardView" class="tab-pane fade">
                        <div class="row">
                            @foreach($employees as $employee)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3">
                                <div class="employee-card" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    <span class="shape"></span>
                                    <img class="card-img-top" src="{{ asset('uploads/employees/' . $employee->profile_picture) }}" alt="Profile">
                                    <div class="card-body">
                                        <h4 class="employee-title">{{ $employee->name }}</h4>
                                        <small><i class="fas fa-phone-alt me-1"></i> {{ $employee->phone }}</small> <br>
                                        <small><i class="fas fa-envelope me-1"></i> {{ $employee->email }}</small>
                                    </div>
                                    <div class="collapse" id="collapse5">
                                        <div class="employee-address">
                                            <p><i class="fas fa-map-marker-alt me-1"></i> {{ $employee->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>


    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="employeeForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                            <small class="text-danger error-name"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" required>
                            <small class="text-danger error-phone"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                            <small class="text-danger error-email"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" required>
                            <small class="text-danger error-address"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea name="description" class="form-control"></textarea>
                            <small class="text-danger error-description"></small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_picture" class="dropify" data-height="150">
                            <small class="text-danger error-profile_picture"></small>
                        </div>
                        <button type="submit" class="btn add-employee-btn float-end">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        @csrf
                        <input type="hidden" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name">
                            <span class="text-danger error-name"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edit_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone">
                            <span class="text-danger error-phone"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email">
                            <span class="text-danger error-email"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edit_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="edit_address" name="address">
                            <span class="text-danger error-address"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                            <span class="text-danger error-description"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edit_profile_picture" class="form-label">Choose New Profile</label>
                            <input type="file" class="dropify" id="edit_profile_picture" name="profile_picture" required>
                            <img id="edit_preview_image" src="" alt="Profile" class="mt-2" width="100">
                        </div>
                        <button type="submit" class="btn add-employee-btn float-end">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="{{ asset('assets') }}/js/dataTables.min.js"></script>
    <script src="{{ asset('assets') }}/js/dataTables.bootstrap5.min.js"></script>
    <!-- Sweet Alert JS -->
    <script src="{{ asset('assets') }}/js/sweetalert2.js"></script>
    <!-- Dropify JS -->
    <script src="{{ asset('assets') }}/js/dropify.min.js"></script>
    <script src="{{ asset('assets') }}/js/main.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

    <!-- Delete Employee with SweetAlert Confirmation -->
    <script>
        $(document).on("click", ".delete-icon", function(e) {
            e.preventDefault();
            let id = $(this).data("id"); // Get employee ID

            Swal.fire({
                title: "Are you sure?"
                , text: "This employee will be permanently deleted."
                , icon: "warning"
                , showCancelButton: true
                , confirmButtonColor: "#d33"
                , cancelButtonColor: "#3085d6"
                , confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/delete-employee/" + id
                        , type: "DELETE"
                        , data: {
                            _token: "{{ csrf_token() }}" 
                        }
                        , success: function(response) {
                            Swal.fire({
                                icon: "success"
                                , title: "Deleted!"
                                , text: response.success
                                , timer: 2000
                                , showConfirmButton: false
                            });

                            fetchEmployees(); // Reload the employee list dynamically
                            window.location.href = "{{ route('/') }}";
                        }
                        , error: function(xhr, status, error) {
                            Swal.fire("Error!", "Something went wrong.", "error");
                            console.error("Delete Error:", xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>


    <!-- save employee -->
    <script>
        $("#employeeForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('save_employee') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    $("#addEmployeeModal").modal('hide'); // Hide modal
                    $("#employeeForm")[0].reset(); // Reset form
                    fetchEmployees(); // Reload employees dynamically
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                $(".text-danger").text(""); // Clear previous errors
                $.each(errors, function(key, value) {
                    $(".error-" + key).text(value[0]);
                });
            }
        });
    });
    </script>


    <!-- Fetch Employee -->
    <script>
    function fetchEmployees() {
        $.ajax({
            url: "{{ route('fetch_employees') }}", // Fetch employees from the backend
            type: "GET",
            success: function(response) {
                $("#dataTable tbody").html(""); // Clear existing table
                $("#cardView .row").html(""); // Clear existing cards
                
                $.each(response.employees, function(index, employee) {
                    let profileImage = employee.profile_picture ? "/uploads/employees/" + employee.profile_picture : "/assets/images/avatar.png";

                    // Append to table
                    $("#dataTable tbody").append(`
                        <tr>
                            <td>${employee.id}</td>
                            <td><img src="${profileImage}" alt="Profile" class="employee-img me-2"></td>
                            <td>${employee.name}</td>
                            <td>${employee.phone}</td>
                            <td>${employee.email}</td>
                            <td>${employee.address}</td>
                            <td>
                                <a href="#" class="edit-icon" data-id="${employee.id}" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a href="#" class="delete-icon" data-id="${employee.id}">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </td>
                        </tr>
                    `);

                    // Append to card view
                    $("#cardView .row").append(`
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-3">
                            <div class="employee-card" data-bs-toggle="collapse" data-bs-target="#collapse${employee.id}"
                                aria-expanded="false" aria-controls="collapse${employee.id}">
                                <span class="shape"></span>
                                <img class="card-img-top" src="${profileImage}" alt="Profile">
                                <div class="card-body">
                                    <h4 class="employee-title">${employee.name}</h4>
                                    <small><i class="fas fa-phone-alt me-1"></i> ${employee.phone}</small> <br>
                                    <small><i class="fas fa-envelope me-1"></i> ${employee.email}</small>
                                </div>
                                    <div class="collapse" id="collapse${employee.id}">
                                        <div class="employee-address">
                                            <p><i class="fas fa-map-marker-alt me-1"></i> ${employee.address}</p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    `);
                });
            }
        });
    }

    $(document).ready(function() {
        fetchEmployees(); // Load employees on page load
    });
    </script>


    <!-- Fetch Employee Data for Editing -->
    <script>
        $(document).on("click", ".edit-icon", function(e) {
            e.preventDefault();
            let id = $(this).data("id"); // Get employee ID

            $.ajax({
                url: "/edit-employee/" + id
                , type: "GET"
                , success: function(employee) {
                    $("#edit_id").val(employee.id);
                    $("#edit_name").val(employee.name);
                    $("#edit_phone").val(employee.phone);
                    $("#edit_email").val(employee.email);
                    $("#edit_address").val(employee.address);
                    $("#edit_description").val(employee.description);

                    let profileImage = employee.profile_picture ? "/uploads/employees/" + employee.profile_picture : "/assets/images/avatar.png";
                    $("#edit_preview_image").attr("src", profileImage);

                    $("#editEmployeeModal").modal("show");
                }
            });
        });
    </script>


    <!-- Update Employee Data via AJAX -->
    <script>
        $("#editEmployeeForm").submit(function(e) {
            e.preventDefault();
            let id = $("#edit_id").val();
            var formData = new FormData(this);

            $.ajax({
                url: "/update-employee/" + id
                , type: "POST"
                , data: formData
                , processData: false
                , contentType: false
                , success: function(response) {
                    Swal.fire({
                        icon: "success"
                        , title: "Updated!"
                        , text: response.success
                        , timer: 2000
                        , showConfirmButton: false
                    });

                    $("#editEmployeeModal").modal("hide");
                    fetchEmployees();
                }
                , error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    $(".text-danger").text("");
                    $.each(errors, function(key, value) {
                        $(".error-" + key).text(value[0]);
                    });
                }
            });
        });

    </script>

</body>

</html>
