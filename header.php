<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Homepage</title>
    </head>
    <body>
        <nav>
            <div class="header">
                <a href="index.php"><h1>HOME</h1>
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
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
        <div class="body">