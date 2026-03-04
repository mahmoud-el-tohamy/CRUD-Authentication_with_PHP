# 👥 User Management System (PHP)

A simple user management system built with **PHP**, **MySQL**, and **PDO**.  
The project demonstrates core backend concepts such as authentication, form validation, file uploads, and CRUD operations with a clean and user-friendly interface.

---

## 📋 Table of Contents

- [Features](#features)
- [Authentication](#authentication)
- [User Registration](#user-registration)
- [Form Validation](#form-validation)
- [Profile Picture Upload](#profile-picture-upload)
- [User Management](#user-management-crud)
- [User Profile Page](#user-profile-page)
- [Project Structure](#project-structure)
- [Database](#database)
- [UI Design](#ui-design)
- [Technologies](#technologies-used)
- [Security](#security-considerations)

---

## ✨ Features

### 🔐 Authentication

- ✅ Login using **username and password**
- ✅ Passwords stored securely using `password_hash()`
- ✅ Password verification using `password_verify()`
- ✅ Session-based authentication
- ✅ Protected pages (users cannot access them without logging in)
- ✅ Logout functionality

---

### 📝 User Registration

Users can create an account by providing:

| Field           | Requirement                   |
| --------------- | ----------------------------- |
| First Name      | Text only                     |
| Last Name       | Text only                     |
| Address         | Text input                    |
| Country         | Dropdown selection            |
| Gender          | Radio buttons                 |
| Skills          | Checkbox selection            |
| Username        | Unique identifier             |
| Password        | Custom rules (see validation) |
| Profile Picture | JPG/PNG format                |

All fields are validated to ensure correct input and improve security.

---

### ✔️ Form Validation

**Both client-side and server-side validation** are applied for maximum security and user experience.

**Validation Rules:**

| Rule                 | Details                         |
| -------------------- | ------------------------------- |
| Required Fields      | All fields must be filled       |
| Name Fields          | Do not accept numbers           |
| Skills               | At least one selection required |
| **Password**         |                                 |
| • Length             | Exactly 8 characters            |
| • Case               | Lowercase letters only          |
| • Numbers            | Allowed                         |
| • Special Characters | Only `_` allowed                |
| • No Capital Letters | Strictly enforced               |

Clear validation messages guide the user when input is invalid.

---

### 🖼️ Profile Picture Upload

Users can upload a profile picture during registration.

**Upload Restrictions:**

- ✅ Allowed formats: **JPG, PNG**
- ✅ Maximum file size limit applied
- ✅ Images stored in: `uploads/` directory
- ✅ File path saved to database and linked to user profile

---

### 🛠️ User Management (CRUD)

After logging in, users can manage the system through a dashboard:

- 👁️ **View** all users
- 📄 **View** user profile details
- ✏️ **Edit** user information
- 🗑️ **Delete** users

---

### 📊 User Profile Page

Each user has a detailed profile page displaying:

- 👤 Full name
- 🔑 Username
- 🌍 Country
- 🏠 Address
- ⚧️ Gender
- 🏢 Department
- 💼 Skills
- 📷 Profile picture
- 📅 Account creation date

---

### 📁 Project Structure

```
day2/
├── 📷 uploads/                    # Uploaded profile images
│
├── 🔐 Authentication
│   ├── login.php                  # Login page
│   ├── checkLogin.php             # Authentication logic
│   ├── logout.php                 # Logout
│   └── registration.php           # Registration form
│
├── 💾 User Data Management
│   ├── save.php                   # Handles registration logic
│   ├── usersTable.php             # Main dashboard
│   ├── view.php                   # User profile page
│   ├── edit.php                   # Edit user form
│   ├── update.php                 # Update user data
│   └── delete.php                 # Delete user
│
└── 📖 README.md                   # Documentation
```

---

## 🗄️ Database

**Table Name:** `emp`

**Key Fields:**

| Column       | Type      | Description            |
| ------------ | --------- | ---------------------- |
| `id`         | INT       | Primary key            |
| `fname`      | VARCHAR   | First name             |
| `lname`      | VARCHAR   | Last name              |
| `address`    | TEXT      | User address           |
| `country`    | VARCHAR   | Country of residence   |
| `gender`     | ENUM      | Male/Female/Other      |
| `skills`     | TEXT      | Comma-separated skills |
| `username`   | VARCHAR   | Unique username        |
| `password`   | VARCHAR   | Hashed password        |
| `department` | VARCHAR   | Department             |
| `image`      | VARCHAR   | Profile image path     |
| `created_at` | TIMESTAMP | Account creation date  |

---

## 🎨 UI Design

The interface emphasizes **simplicity, readability, and user-friendliness**:

- ✨ Clean and simple form layouts
- 📌 Navigation bar with welcome message
- 🚪 Logout button for easy access
- 💳 User profile card design
- 📋 Styled tables for user management

---

## 🛠️ Technologies Used

- **Backend:** PHP
- **Database:** MySQL
- **ORM/Query Builder:** PDO (PHP Data Objects)
- **Frontend:** HTML, CSS
- **Advanced Features:** Sessions, File Upload Handling

---

## 🔒 Security Considerations

The project implements **basic security best practices**:

- 🔐 Password hashing with `password_hash()`
- 🛡️ Prepared statements with PDO (prevents SQL injection)
- 👤 Session-based access control
- ✔️ Server-side input validation
- 📁 File type validation for uploads

---

## 👤 Author

**Mahmoud El-Tohamy**
