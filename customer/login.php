<?php
// Database connection details
include("config/config.php");

if (isset($_POST['login'])) {
    // Sanitize and validate form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($stored_hashed_password);
        $stmt->fetch();

        // Verify the entered password against the stored hashed password
        if (password_verify($password, $stored_hashed_password)) {
            // Start a session and redirect
            session_start();
            $_SESSION['user_email'] = $email;

            // Redirect to index page
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="CSS/login1.css">
</head>
<body>
    <div class="form-container">
        <form action="" class="loginForm" method="POST">
            <h2 class="form-header">Login</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <div class="button-group">
                <input type="submit" value="Login" class="submit-btn" name="login">
            </div>
            
            <!-- Gmail Login Button -->
            <div class="external-login">
                <a href="#" class="gmail-login">
                    <span class="material-icons icon">mail</span> <!-- Gmail Icon -->
                    Log in with Gmail
                </a>
            </div>

            <!-- Privacy Policy Link -->
            <div class="privacy-policy">
                <a href="#" class="policy-link">Privacy Policy</a>
            </div>
        </form>
    </div>
</body>
</html>




