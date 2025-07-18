<?php
session_start(); // Start session to access user data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - Petzzyy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('Image/p1.png');
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #0c5dfe;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }
        .header img {
            height: 40px;
            margin-right: 10px;
        }
        .header h1 {
            color: black;
            font-size: 16px;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .profile-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 800px;
            padding: 30px;
            position: relative;
        }
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #0c5dfe;
            object-fit: cover;
            margin: 0 auto;
            display: block;
        }
        .profile-card h2 {
            text-align: center;
            color: #333;
            margin-top: 10px;
        }
        .profile-card .profile-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding: 10px 0;
        }
        .profile-card .profile-info div {
            width: 45%;
        }
        .profile-card .profile-info div label {
            font-weight: bold;
            color: #555;
        }
        .profile-card .profile-info div p {
            margin: 5px 0;
            color: #333;
        }
        .profile-card .actions {
            margin-top: 20px;
            text-align: center;
        }
        .profile-card .actions button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            transition: background-color 0.3s;
        }
        .profile-card .actions button:hover {
            background-color: #0056b3;
        }
        .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .edit-form {
            display: none; /* Initially hidden */
            margin-top: 20px;
        }
        .edit-form input[type="text"], .edit-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .profile-photo-upload {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        .profile-photo-upload input[type="file"] {
            display: none;
        }
        .profile-photo-upload label {
            cursor: pointer;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="home.php" style="display: flex; align-items: center; text-decoration: none; color: inherit;">
            <img src="Image/p2.png" alt="Petzzyy Logo">
            <h1>Petzzyy</h1>
        </a>
    </div>
    <div class="container">
        <div class="profile-card">
            <img src="Image/default-profile.png" alt="Profile Photo" class="profile-photo" id="profilePhoto"> <!-- Placeholder for profile photo -->
            <div class="profile-photo-upload">
                <input type="file" id="photoUpload" accept="image/*">
                <label for="photoUpload">Change Photo</label>
            </div>
            <h2>User Profile</h2>
            <div class="profile-info">
                <div>
                    <label>Username:</label>
                    <p id="username">Loading...</p> <!-- Placeholder for username -->
                </div>
                <div>
                    <label>Email:</label>
                    <p id="email">Loading...</p> <!-- Placeholder for email -->
                </div>
            </div>
            <div class="profile-info">
                <div>
                    <label>Mobile:</label>
                    <p id="mobile">Loading...</p> <!-- Placeholder for mobile -->
                </div>
            </div>
            <div class="edit-form" id="editForm">
                <h3>Edit Your Profile</h3>
                <label>Address:</label>
                <input type="text" id="address" placeholder="Enter your address">
                <label>About Me:</label>
                <textarea id="about" rows="4" placeholder="Tell us about yourself"></textarea>
                <button id="saveChanges">Save Changes</button>
            </div>
            <div class="actions">
                <button id="edit-btn">Edit Profile</button>
                <button id="logout-btn">Log Out</button>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 Petzzyy. All rights reserved.</p>
    </div>
    <script>
    // Log out button functionality
    document.getElementById('logout-btn').addEventListener('click', function() {
        window.location.href = 'login.html';
    });

    // Edit button functionality
    document.getElementById('edit-btn').addEventListener('click', function() {
        const editForm = document.getElementById('editForm');
        editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
    });

    // Save changes functionality
    document.getElementById('saveChanges').addEventListener('click', function() {
        const address = document.getElementById('address').value;
        const about = document.getElementById('about').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_user_data.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('editForm').style.display = 'none';
                fetchUserData();
            }
        };
        xhr.send('address=' + encodeURIComponent(address) + '&about=' + encodeURIComponent(about));
    });

    // Fetch and display user data using AJAX
    function fetchUserData() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_user_data.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if (!data.error) {
                    document.getElementById('username').textContent = data.username;
                    document.getElementById('email').textContent = data.email;
                    document.getElementById('mobile').textContent = data.mobile;
                    document.getElementById('address').value = data.address || '';
                    document.getElementById('about').value = data.about || '';
                }
            }
        };
        xhr.send();
    }

    window.onload = fetchUserData;

    // Profile photo upload functionality
    document.getElementById('photoUpload').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('profilePhoto').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>
</html>
