<?php
// Step 1: Start the session
session_start(); // Start the session to use session variables

// Step 2: Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "petzzyy_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Get data from the form
$user_name = $_POST['username'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Step 4: Validate form data
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit; // Stop the script if passwords don't match
}

// Step 5: Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Step 6: Check if email already exists using a prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists!'); window.history.back();</script>";
    exit; // Stop the script if email exists
}

// Step 7: Insert data into the table using a prepared statement
$stmt = $conn->prepare("INSERT INTO users (username, mobile, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $user_name, $mobile, $email, $hashed_password);

if ($stmt->execute()) {
    // Store the username in session for future use
    $_SESSION['username'] = $user_name;

    // Redirect to the login page after successful registration
    echo "<script>
            sessionStorage.setItem('username', '$user_name');
            window.location.href='login.html'; // Redirect to login page
          </script>";
} else {
    echo "Error: " . $stmt->error; // Show error if insert fails
}

// Step 8: Close the statement and connection
$stmt->close();
$conn->close();
?>
