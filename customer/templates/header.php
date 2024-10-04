<?php
include("../config/config.php")
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document22</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/cat.carousel1.css">
    <link rel="stylesheet" href="CSS/navtab.css">
    <link rel="stylesheet" href="CSS/search.css">
    <link rel="stylesheet" href="CSS/order.css">
    <link rel="stylesheet" href="CSS/confirm.order3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<section id="main-content">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');
            const closeBtn = document.querySelector('.close-btn');

            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });

            closeBtn.addEventListener('click', function() {
                sidebar.classList.remove('show');
            });
        });

        
    </script>
   <header>
    <nav id="navbar">
        <div id="logo">
            <img src="images/goatmeat1.jpg" alt="Company Logo" class="logo-img">
            <a href="index.php" class="company-name">Foodie</a>
        </div>

        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
        </ul>

        <div class="nav-icons">
            <a href="#" class="icon-wrapper notification-link" aria-label="Notifications">
                <i class="fas fa-bell nav-icon notifications"></i>
                <span class="badge">3</span>
            </a>
            <a href="#" class="icon-wrapper cart-link" aria-label="Cart">
                <i class="fas fa-shopping-cart nav-icon cart"></i>
            </a>
        </div>

        <div class="nav-btn">
            <a href="logout.php" class="btn" aria-label="Log out">Log out</a>
        </div>

        <div class="menu-toggle" aria-label="Menu Toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
    
    <!-- Search bar below the navbar -->
    <form class="search-bar" action="search.php" method="POST">
        <input type="text" name="search" placeholder="Search..." aria-label="Search">
        <button type="submit" name="submit" aria-label="Search Button"><i class="fas fa-search"></i></button>
    </form>

    <!-- Sidebar for mobile screens -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Menu</h2>
            <button class="close-btn" aria-label="Close Sidebar">&times;</button>
        </div>
        <ul class="sidebar-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#" class="icon-wrapper cart-link" aria-label="Cart">
                <i class="fas fa-shopping-cart nav-icon cart"></i>
            </a></li>
            <li><a href="logout.php" class="btn sidebar-btn" aria-label="Log out">Log out</a></li>
        </ul>
    </div>
</header>













