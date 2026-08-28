# Students System

A simple CRUD web application to manage student records — add, edit, delete, search, and paginate through students — built with vanilla **PHP**, **MySQL**, and **jQuery/AJAX** for a smooth, no-reload experience.

## Features

- **Add Student** — register a new student (first name, last name, email, password, age, phone) with server-side validation.
- **Edit Student** — update an existing student's data, including an optional password change.
- **Delete Student** — remove a student instantly via AJAX (no page reload).
- **Live Search** — search students by name, email, age, or phone using AJAX as you type.
- **Pagination** — results are paginated (10 students per page).
- **Validation**
  - All fields are required (except password on edit).
  - Email must be a valid `@gmail.com` address and unique.
  - Phone must match the Egyptian phone number format and be unique.
  - Age must be between 7 and 99.
- **Secure Passwords** — passwords are hashed with PHP's `password_hash()` (bcrypt) before being stored.
- **UI Feedback** — success/error toasts via SweetAlert2, and animated UI (WOW.js / Animate.css).

## Tech Stack

| Layer      | Technology                              |
| ---------- | ---------------------------------------- |
| Backend    | PHP (vanilla, PDO for MySQL)             |
| Database   | MySQL                                    |
| Frontend   | HTML, CSS, Bootstrap                     |
| Scripting  | JavaScript, jQuery, AJAX                 |
| UI Extras  | SweetAlert2, Font Awesome, WOW.js        |

## Project Structure

```
Students-System/
├── assets/
│   ├── css/            # Bootstrap, custom & responsive styles
│   ├── images/         # Logo and images
│   ├── js/
│   │   ├── functions.js      # Form/UI helper functions
│   │   ├── searchAJAX.js     # AJAX search & pagination logic
│   │   └── plugins/          # jQuery, SweetAlert2, WOW.js
│   └── webfonts/       # Font Awesome fonts
├── backend/
│   ├── register.php          # Handles "Add Student" form submission
│   ├── editStudentProcess.php# Handles "Edit Student" form submission
│   ├── getStudent.php        # Fetches a single student for editing
│   ├── getStudents.php       # Fetches paginated/search student lists
│   ├── deleteStudent.php     # Handles AJAX delete requests
│   ├── search.php            # AJAX endpoint for live search
│   ├── validation.php        # Server-side validation rules
│   └── helpers.php           # Shared helper functions (errors, old input, etc.)
├── components/
│   ├── trOfStudents.php # Renders the students table rows
│   └── pagination.php   # Renders pagination links
├── database/
│   ├── connection.php             # PDO database connection
│   └── create_students_table.php  # Creates the `students` table
├── index.php          # Main page (Add form + students table + search)
├── editStudent.php    # Edit student page
└── README.md
```

## Requirements

- PHP **8.0+** (uses PHP 8 syntax such as typed properties/union types)
- MySQL / MariaDB
- A local server environment such as **XAMPP**, **WAMP**, or **Laragon**

## Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/MA-reh/Students-System.git
   ```
2. **Move the project** into your server's web root (e.g. `htdocs` for XAMPP, or `www` for WAMP).
3. **Create the database.**
   By default, the app connects to a database called `register`. Create it in phpMyAdmin/MySQL:
   ```sql
   CREATE DATABASE register;
   ```
4. **Configure the connection.**
   Open `database/connection.php` and update the credentials if needed:
   ```php
   $DSN = "mysql:host=localhost;dbname=register";
   $username = "root";
   $password = "";
   ```
5. **Create the `students` table.**
   Run `database/create_students_table.php` once in your browser (or include it manually) to create the table:
   ```
   http://localhost/Students-System/database/create_students_table.php
   ```
6. **Run the project.**
   Open the app in your browser:
   ```
   http://localhost/Students-System/
   ```

## Usage

- Fill in the **Add New Students** form on the left and click **Add** to insert a new student.
- Use the **Search** box to filter students live (matches name, email, age, or phone).
- Click **Edit** next to any student to update their data.
- Click **Delete** to remove a student (handled instantly via AJAX).
- Use the pagination links at the bottom of the table to browse more results.

## Notes

- This project is intended for learning/demo purposes. If you plan to deploy it publicly, consider:
  - Using prepared statements everywhere (some queries build SQL with string interpolation).
  - Not displaying the hashed password column in the UI.
  - Adding authentication/authorization before exposing add/edit/delete actions.

## Live Demo

🔗 [http://ma-reh-system-students.atwebpages.com/](http://ma-reh-system-students.atwebpages.com/)
