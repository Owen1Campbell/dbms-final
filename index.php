<?php include_once 'header.php'; ?>

    <h3>COP 4710 Final Project</h3>
    <?php 
        if (isset($_SESSION["userid"])) {
            echo "<p>Welcome <b>" . $_SESSION["useruid"] . "!</b></p>";
        }
    ?>
    <p>Website Content</p>
    

<?php include_once 'footer.php'; ?>    