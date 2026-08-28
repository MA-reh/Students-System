<div align="center">

# 🎓 Students System

**A clean CRUD web app to manage student records — add, edit, delete, search & paginate — with a smooth AJAX experience.**

[![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![jQuery](https://img.shields.io/badge/jQuery-AJAX-0769AD?style=for-the-badge&logo=jquery&logoColor=white)](https://jquery.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-UI-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

[🔗 Live Demo](http://ma-reh-system-students.atwebpages.com/) · [🐛 Report a Bug](https://github.com/MA-reh/Students-System/issues) · [✨ Request a Feature](https://github.com/MA-reh/Students-System/issues)

</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Requirements](#-requirements)
- [Installation & Setup](#-installation--setup)
- [Usage](#-usage)
- [Validation Rules](#-validation-rules)
- [Security Notes](#-security-notes)
- [Live Demo](#-live-demo)

---

## 🧭 Overview

**Students System** is a lightweight student-management CRUD app built with vanilla **PHP** and **MySQL** on the backend, and **jQuery/AJAX** on the frontend so students can be added, searched, edited, and deleted without ever reloading the page.

> Built as a practical PHP + MySQL + AJAX learning project — simple architecture, no frameworks, easy to read and extend.

---

## ✨ Features

| | Feature | Description |
|---|---|---|
| ➕ | **Add Student** | Register a new student with first/last name, email, password, age & phone |
| ✏️ | **Edit Student** | Update any student's data, with an optional password change |
| 🗑️ | **Delete Student** | Remove a student instantly via AJAX — no page reload |
| 🔍 | **Live Search** | Search by name, email, age, or phone as you type |
| 📄 | **Pagination** | Results are split 10-per-page automatically |
| 🔐 | **Hashed Passwords** | Passwords stored using PHP's `password_hash()` (bcrypt) |
| 🔔 | **Toast Alerts** | Success/error feedback via SweetAlert2 |
| ✅ | **Server-side Validation** | Required fields, unique email/phone, Egyptian phone format, age range |

---

## 🛠️ Tech Stack

<div align="center">

| Layer | Technologies |
|---|---|
| **Backend** | PHP (vanilla) · PDO |
| **Database** | MySQL |
| **Frontend** | HTML5 · CSS3 · Bootstrap |
| **Scripting** | JavaScript · jQuery · AJAX |
| **UI Extras** | SweetAlert2 · Font Awesome · WOW.js / Animate.css |

</div>

---

## 📂 Project Structure

```
Students-System/
├── assets/
│   ├── css/                    # Bootstrap, custom & responsive styles
│   ├── images/                 # Logo & static images
│   ├── js/
│   │   ├── functions.js        # Form/UI helper functions
│   │   ├── searchAJAX.js       # AJAX search & pagination logic
│   │   └── plugins/            # jQuery, SweetAlert2, WOW.js
│   └── webfonts/               # Font Awesome fonts
│
├── backend/
│   ├── register.php            # Handles "Add Student"
│   ├── editStudentProcess.php  # Handles "Edit Student"
│   ├── getStudent.php          # Fetches a single student for editing
│   ├── getStudents.php         # Fetches paginated / searched students
│   ├── deleteStudent.php       # AJAX delete endpoint
│   ├── search.php              # AJAX search endpoint
│   ├── validation.php          # Server-side validation rules
│   └── helpers.php             # Shared helper functions
│
├── components/
│   ├── trOfStudents.php        # Renders the students table rows
│   └── pagination.php          # Renders pagination links
│
├── database/
│   ├── connection.php              # PDO database connection
│   └── create_students_table.php   # Creates the `students` table
│
├── index.php                   # Main page (Add form + table + search)
├── editStudent.php              # Edit student page
└── README.md
```

---

## ⚙️ Requirements

- PHP **8.0+**
- MySQL / MariaDB
- A local server stack — **XAMPP**, **WAMP**, or **Laragon**

---

## 🚀 Installation & Setup

**1. Clone the repository**
```bash
git clone https://github.com/MA-reh/Students-System.git
```

**2. Move the project** into your server's web root (`htdocs` for XAMPP, `www` for WAMP).

**3. Create the database**
```sql
CREATE DATABASE register;
```

**4. Configure the connection** in `database/connection.php`:
```php
$DSN = "mysql:host=localhost;dbname=register";
$username = "root";
$password = "";
```

**5. Create the `students` table** by opening this once in your browser:
```
http://localhost/Students-System/database/create_students_table.php
```

**6. Run the project**
```
http://localhost/Students-System/
```

---

## 💡 Usage

- Fill in the **Add New Students** form and click **Add** to insert a new student.
- Type in the **Search** box to filter results live (name, email, age, or phone).
- Click **Edit** next to any row to update that student's data.
- Click **Delete** to remove a student instantly.
- Browse more results using the pagination bar at the bottom of the table.

---

## ✅ Validation Rules

| Field | Rule |
|---|---|
| First / Last Name | Required |
| Email | Required · must end with `@gmail.com` · must be unique |
| Password | Required on add · optional on edit |
| Age | Required · between 7 and 99 |
| Phone | Required · valid Egyptian format · must be unique |

---

## 🔒 Security Notes

This project was built for learning purposes. Before using it in production, consider:

- Replacing string-interpolated SQL queries with **prepared statements** everywhere.
- Removing the raw password column from the students table view in the UI.
- Adding **authentication/authorization** before exposing add/edit/delete actions.

---

## 🌐 Live Demo

<div align="center">

### 🔗 [http://ma-reh-system-students.atwebpages.com/](http://ma-reh-system-students.atwebpages.com/)

</div>
