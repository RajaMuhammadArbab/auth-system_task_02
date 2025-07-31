#  PHP & MySQL User Authentication System

##  How to Set Up the Project

1. **Install XAMPP** (or any PHP-MySQL server environment).
2. **Start Apache and MySQL** from XAMPP Control Panel.
3. **Place the project folder** (e.g., `auth-system`) in the `htdocs` directory of XAMPP (usually `C:/xampp/htdocs/`).
4. **Create the Database**:
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a database named `auth_system`
   - Run the SQL script below to create the users table:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

5. **Access the project in browser**:
   - Visit [http://localhost/auth-system](http://localhost/auth-system)
   - Register, then login to test the system

---

##  Structure of the Code

```
auth-system/
│
├── db.php                 → Database connection file
├── register.php           → Handles user registration logic
├── login.php              → Handles user login & session start
├── logout.php             → Destroys session and logs out
├── dashboard.php          → Protected dashboard page
├── profile.php            → User profile update form
├── change_password.php    → Change password functionality
├── style.css              → Optional CSS styling
├── README.md              → Project documentation
```

---

##  Brief Explanation of the Implementation

###  Authentication Flow
- User registers with username, email, and password.
- Passwords are hashed using `password_hash()` before storage.
- On login, credentials are validated using `password_verify()`.
- A session is created to manage user authentication.
- Protected pages check for session variables before access.

###  Security Features
- Input sanitization using `filter_input()` and `mysqli_real_escape_string()`
- SQL Injection prevention via prepared statements
- Passwords stored securely with `password_hash()`
- Sessions used to maintain authentication state

---

