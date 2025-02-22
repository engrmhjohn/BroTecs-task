##Employee Management System
#Project Overview
This is a CRUD-based Employee Management System developed as part of an assignment for BroTecs Technologies Limited. The project includes an intuitive and interactive UI for managing employees efficiently. It follows best practices in frontend and backend development, ensuring a clean structure, responsiveness, and modern UI/UX design.

#Features
CRUD Operations: Add, Edit, Delete, and View Employees.
Card & Table View: Employees can be viewed in either a Card Layout or a Table Layout.
Ajax-Based Operations: Employee addition and editing happen in a Bootstrap modal, reducing page reloads.
SweetAlert for Deletion: Confirmation alerts before deletion using SweetAlert2.

#Bootstrap DataTable:
Pagination
Column Visibility Toggle
Sorting
Dark & Light Mode: Users can toggle between dark and light themes.
Fully Responsive: Works seamlessly on mobile, tablet, and desktop.

#Technologies Used
Frontend: Bootstrap, jQuery, AJAX, SweetAlert2, DataTables
Backend: Laravel
Database: MySQL
#Live Demo
🔗 https://brotecs-task.onesky.com.bd/

---------------------
Steps to Run the Project Locally
---------------------
1. Clone the Repository - git clone https://github.com/your-username/your-repo.git or download as zip
2. Navigate to the project folder: cd your-repo
3. Install Dependencies: composer install or composer update
4. Set Up Environment Variables - cp .env.example .env
5. Generate an application key: php artisan key:generate
6. Configure Database: Open the .env file and update the database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
