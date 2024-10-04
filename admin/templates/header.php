<?php
include('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Navbar</title>
    <link rel="stylesheet" href="css/styles10.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
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
            <a href="" class="company-name">Company Name</a>
        </div>

        <ul class="nav-links">
            <li><a href="#">Dashboard</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="manage.category.php">Category</a></li>
            <li><a href="manage.food.php">Food</a></li>
            <li><a href="#">Order</a></li>
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
    <div class="search-bar">
        <input type="text" placeholder="Search..." aria-label="Search">
        <button type="submit" aria-label="Search Button"><i class="fas fa-search"></i></button>
    </div>

    <!-- Sidebar for mobile screens -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Menu</h2>
            <button class="close-btn" aria-label="Close Sidebar">&times;</button>
        </div>
        <ul class="sidebar-links">
            <li><a href="#">Dashboard</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="manage.category.php">Category</a></li>
            <li><a href="manage.food.php">Food</a></li>
            <li><a href="#" class="icon-wrapper cart-link" aria-label="Cart">
                <i class="fas fa-shopping-cart nav-icon cart"></i>
            </a></li>
            <li><a href="logout.php" class="btn sidebar-btn" aria-label="Log out">Log out</a></li>
        </ul>
    </div>
</header>