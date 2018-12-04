<?php
session_start();
function createMenu() {
    if(isset($_SESSION['username'])) { // User is Logged in
        if($_SESSION['userrole'] == 1) {         // Employee
            ?>
            <!-- HTML for Employee Menu -->
            <nav class="navigation">
                <a href="userHome.php">Home</a>         <!-- Employee Home Page -->
                <a href="createNew.php">Create Purchase Request</a> <!-- Create Request Page -->
                <a href="logout.php">Sign Out</a>
            </nav>
            <!-- End Nav for Employee -->
            <?php
        } else if ($_SESSION['userrole'] == 2) { // Manager
            ?>
            <!-- HTML for Manager Menu -->
            <nav class="navigation">
                <a href="managerHome.php">Home</a>     <!-- Manager Home Page -->
                <a href="budget.php">View Budget</a>    <!-- Budget Page -->
                <a href="createNew.php">Create Purchase Request</a> <!-- Create Request Page -->
                <a href="logout.php">Sign Out</a>
            </nav>
            <!-- End Nav for Manager -->
            <?php
        } else if ($_SESSION['userrole'] == 3) { // Admin
            ?>
            <!-- HTML for Admin Menu -->
            <nav class="navigation">
                <a href="managerHome.php">Home</a>     <!-- Admin Home Page -->
                <a href="budget.php">View Budget</a>    <!-- Budget Page -->
                <a href="createNew.php">Create Purchase Request</a> <!-- Create Request Page -->
                <a href="admin.php">Admin Panel</a>     <!-- Admin Panel Page -->
                <a href="logout.php">Sign Out</a>
            </nav>
            <!-- End Nav for Admin -->
            <?php
    } else {
        header("Location: login.php"); // Redirect user to Login page
    }
}
}
?>

