<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Homepage</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <nav>
            <div class="header">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="list.php">Events</a></li>
                    <?php 
                        if (isset($_SESSION["userid"])) {
                            echo "<li><a href='profile.php'>Profile</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
                        }
                        else {
                            echo "<li><a href='signup.php'>Sign Up</a></li>";
                            echo "<li><a href='login.php'>Login</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </nav>
        <div class="sitebody">