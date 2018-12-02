<?php
function createMenu() {
    if(isset($_SESSION['username'])) { // User is Logged in
        if($_SESSION['role'] == 1) {         // Employee
            ?>
            <!-- HTML for Employee Menu -->
            <nav class="navigation">
                <a href="userHome.php">Home</a>         <!-- Employee Home Page -->
                <a href="createNew.php">View Budget</a> <!-- Create Request Page -->
                <a href="login.html">Sign Out</a>
            </nav>
            <!-- End Nav for Employee -->
            <?php
        } else if ($_SESSION['role'] == 2) { // Manager
            ?>
            <!-- HTML for Manager Menu -->
            <nav class="navigation">
                <a href="managerHome.html">Home</a>     <!-- Manager Home Page -->
                <a href="budget.php">View Budget</a>    <!-- Budget Page -->
                <a href="createNew.php">View Budget</a> <!-- Create Request Page -->
                <a href="login.html">Sign Out</a>
            </nav>
            <!-- End Nav for Manager -->
            <?php
        } else if ($_SESSION['role'] == 3) { // Admin
            ?>
            <!-- HTML for Admin Menu -->
            <nav class="navigation">
                <a href="managerHome.html">Home</a>     <!-- Admin Home Page -->
                <a href="budget.php">View Budget</a>    <!-- Budget Page -->
                <a href="createNew.php">View Budget</a> <!-- Create Request Page -->
                <a href="admin.php">Admin Panel</a>     <!-- Admin Panel Page -->
                <a href="login.html">Sign Out</a>
            </nav>
            <!-- End Nav for Admin -->
            <?php
    } else {
        header("Location: login.php"); // Redirect user to Login page
    }
}
?>

