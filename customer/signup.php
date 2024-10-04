<?php
// Include database connection
include("config/config.php");



// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get and sanitize form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $delivery_address = $_POST['delivery_address'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $dob = $_POST['dob']; // Make sure this is in YYYY-MM-DD format
    $password = $_POST['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Password strength check
    function checkPasswordStrength($password) {
        return preg_match('/[A-Z]/', $password) && // Uppercase letter
               preg_match('/[a-z]/', $password) && // Lowercase letter
               preg_match('/[0-9]/', $password) && // Number
               preg_match('/[\W_]/', $password);   // Special character
    }

    if (!checkPasswordStrength($password)) {
        die("Password does not meet complexity requirements");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO customer (first_name, last_name, email, phone, address, delivery_address, city, region, dob, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $first_name, $last_name, $email, $phone, $address, $delivery_address, $city, $region, $dob, $hashed_password);

    if ($stmt->execute()) {
        // Redirect to index.php after successful signup
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/signup2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<style>
        /* Styling for valid and invalid input borders */
        .input-valid {
            border: 2px solid green !important;
        }

        .input-invalid {
            border: 2px solid red !important;
        }

        /* Initially hide validation messages */
        .validation-message {
            color: red;
            display: none;
        }

        /* Password requirements styling */
        .password-requirements ul {
            list-style-type: none;
            padding-left: 0;
        }

        .password-requirements ul li {
            color: #555;
        }

        /* Submit button styles */
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>

<form action="" class="formClass" id="signUpForm" method="POST">
    <h2 class="form-header">Sign Up</h2>

    <div class="formGrid">
        <!-- First Name -->
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required minlength="2" maxlength="50" pattern="[A-Za-z ]+" title="First name should only contain letters and spaces">
            <small class="validation-message">First name should be 2-50 characters long and contain only letters and spaces.</small>
        </div>

        <!-- Last Name -->
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required minlength="2" maxlength="50" pattern="[A-Za-z ]+" title="Last name should only contain letters and spaces">
            <small class="validation-message">Last name should be 2-50 characters long and contain only letters and spaces.</small>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <small class="validation-message">Enter a valid email address.</small>
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required pattern="\+?[0-9]{10,15}" title="Phone number should be between 10 and 15 digits and can include a leading +">
            <small class="validation-message">Phone number should be 10-15 digits long and can include a leading +.</small>
        </div>

        <!-- Address -->
        <div class="form-group full-width">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" placeholder="Enter your address" required minlength="5" maxlength="100" title="Address should be between 5 and 100 characters">
            <small class="validation-message">Address should be 5-100 characters long.</small>
        </div>

        <!-- Delivery Address -->
        <div class="form-group full-width">
            <label for="delivery_address">Delivery Address</label>
            <input type="text" name="delivery_address" id="delivery_address" placeholder="Enter delivery address" required minlength="5" maxlength="100" title="Delivery address should be between 5 and 100 characters">
            <small class="validation-message">Delivery address should be 5-100 characters long.</small>
        </div>

        <!-- City -->
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" placeholder="Enter your city" required minlength="2" maxlength="50" pattern="[A-Za-z ]+" title="City should only contain letters and spaces">
            <small class="validation-message">City should be 2-50 characters long and contain only letters and spaces.</small>
        </div>

        <!-- Region -->
        <div class="form-group">
            <label for="region">Region</label>
            <input type="text" name="region" id="region" placeholder="Enter your region" required minlength="2" maxlength="50" pattern="[A-Za-z ]+" title="Region should only contain letters and spaces">
            <small class="validation-message">Region should be 2-50 characters long and contain only letters and spaces.</small>
        </div>

        <!-- Date of Birth -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" placeholder="Enter your date of birth" required>
            <small class="validation-message">You must enter a valid date of birth.</small>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required minlength="8" maxlength="20" pattern=".{8,}" title="Password should be at least 8 characters long">
            <small class="validation-message">Password should be at least 8 characters long.</small>
            <div class="password-requirements">
                <p><strong>Password Requirements:</strong></p>
                <ul>
                    <li>Minimum length: 8 characters</li>
                    <li>Maximum length: 20 characters</li>
                    <li>Must include at least one uppercase letter</li>
                    <li>Must include at least one lowercase letter</li>
                    <li>Must include at least one number</li>
                    <li>Must include at least one special character (e.g., @, #, $, %)</li>
                </ul>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required minlength="8" maxlength="20" pattern=".{8,}" title="Password should be at least 8 characters long">
            <small class="validation-message">Confirm password should match the password and be at least 8 characters long.</small>
        </div>
    </div>

    <!-- Sign Up with Gmail -->
    <div class="form-group button-group">
        <a href="https://accounts.google.com/signin" class="gmail-btn" aria-label="Sign Up with Gmail">
            <i class="fab fa-google gmail-icon"></i> Sign Up with Gmail
        </a>
    </div>

    <!-- Privacy Policy and Submit Button -->
    <div class="form-footer">
        <p class="privacy-policy">
            By signing up, you agree to our <a href="path/to/privacy-policy.html">Privacy Policy</a>.
        </p>
        <div class="form-group button-group">
            <input name="submit" type="submit" value="Sign Up" class="submit-btn">
        </div>
    </div>
</form>

    <script>
        document.querySelectorAll('.form-group input').forEach(input => {
    input.addEventListener('input', validateInput);
});

function validateInput(event) {
    const input = event.target;
    const errorMessage = input.nextElementSibling;
    const isValid = input.checkValidity();

    // Validation for all other fields
    if (isValid) {
        input.classList.add('input-valid');
        input.classList.remove('input-invalid');
        errorMessage.style.display = 'none';
    } else {
        input.classList.add('input-invalid');
        input.classList.remove('input-valid');
        errorMessage.style.display = 'block';
    }

    // Custom validation for Date of Birth
    if (input.id === 'dob') {
        const today = new Date();
        const dob = new Date(input.value);
        const age = today.getFullYear() - dob.getFullYear();
        const monthDiff = today.getMonth() - dob.getMonth();

        // Adjust age if the birthday hasn't occurred yet this year
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
        }

        if (dob > today) {
            input.classList.add('input-invalid');
            input.classList.remove('input-valid');
            errorMessage.textContent = 'Date of birth cannot be in the future.';
            errorMessage.style.display = 'block';
        } else if (age < 18) {
            input.classList.add('input-invalid');
            input.classList.remove('input-valid');
            errorMessage.textContent = 'You must be at least 18 years old.';
            errorMessage.style.display = 'block';
        } else {
            input.classList.add('input-valid');
            input.classList.remove('input-invalid');
            errorMessage.textContent = '';
            errorMessage.style.display = 'none';
        }
    }

    // Check password match for the confirm_password field
    if (input.id === 'confirm_password') {
        const password = document.getElementById('password').value;
        if (input.value !== password) {
            input.classList.add('input-invalid');
            input.classList.remove('input-valid');
            errorMessage.textContent = 'Passwords do not match';
            errorMessage.style.display = 'block';
        } else {
            input.classList.add('input-valid');
            input.classList.remove('input-invalid');
            errorMessage.textContent = '';
            errorMessage.style.display = 'none';
        }
    }
}

    </script>



</body>
</html>











