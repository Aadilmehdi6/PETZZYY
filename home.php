<?php
session_start();

// Check if the username is set in the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petzzyy Homepage</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo" id="logoWrapper">
                <a href="home.php">
                    <img src="Image/p2.png" alt="Petzzyy">
                    <h1>Petzzyy</h1>
                </a>
            </div>
            <nav class="nav">
                <div class="nav-icons">
                    <a href="#" id="menuToggle">☰</a>
                    <a href="#" id="searchToggle"><i class="fas fa-search"></i> Search</a>
                    <a href="cart.html"><i class="fas fa-shopping-cart"></i> Cart</a>
                    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                </div>
            </nav>
        </div>
    </header>
    
    <div class="side-menu" id="sideMenu">
        <div class="side-menu-header">
            <h2>Hi, <?php echo $username; ?></h2> <!-- Display username -->
        </div>
        <ul>
            <li><a href="adopt.html"><img src="icon1.png" alt=""> Instant Adoption!</a></li>
            <li><a href="donate.html"><img src="icon2.png" alt=""> Donate Today!</a></li>
            <li><a href="purchase.html"><img src="icon3.png" alt=""> Quick Purchase</a></li>
            <li><a href="pag2.html"><img src="icon3.png" alt=""> Shop For Your Pets</a></li>
        </ul>
    </div>
    
    <div class="banner">
        <div class="slider">
            <div class="slide">
                <img src="Image/p5.png" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="Image/p6.jpeg" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="Image/p7.jpg" alt="Slide 3">
            </div>
        </div>
        <div class="banner-content"></div>
    </div>
    
    <main class="main-content">
        <div class="container">
            <h2>Find Your Furry Friend On Petzzyy!</h2>
            <div class="adopt-section">
                <div class="adopt-img">
                    <img src="Image/p4.png" alt="Adopt me!">
                </div>
                <div class="adopt-info">
                    <h3>Adopt Pets And Save Their Lives</h3>
                    <p>Why bother shopping for pets when there are thousands of homeless puppies and kittens looking for a family? Adopt animals from our shelters and make a change in the lives of animals in your area.</p>
                    <a href="adopt.html" class="adopt-now-btn">Adopt Now</a>
                </div>
            </div>
        </div>
    </main>

    <div id="searchContainer" class="search-container">
        <input type="text" id="searchInput" placeholder="Search..." />
        <div id="searchResults" class="search-results"></div>
    </div>

    <script src="home.js"></script>
</body>
</html>
