<?php
session_start(); // Start session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";  // Your MySQL password, if any
$dbname = "petzzyy_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Query to fetch user info by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user data in the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['mobile'] = $user['mobile'];

            // Redirect to home.php after successful login
            header("Location: home.php");
            exit();
        } else {
            // Redirect to login page with an error
            header("Location: login.html?error=incorrect_password");
            exit();
        }
    } else {
        // Redirect to login page with an error
        header("Location: login.html?error=user_not_found");
        exit();
    }
}

// Close connection
$conn->close();
?>
