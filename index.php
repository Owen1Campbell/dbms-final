<?php include_once 'header.php'; ?>

    <h2>COP 4710 Final Project</h2>
    <?php 
        if (isset($_SESSION["userid"])) {
            echo "<p class='welcome'>Welcome <b>" . $_SESSION["userfullname"] . "!</b></p>";
        }
    ?>
    <p>Website Content</p>
    

<?php include_once 'footer.php'; ?>    