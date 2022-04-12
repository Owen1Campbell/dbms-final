<?php include_once 'header.php'; ?>

    <section class="signup">
        <h2>Sign Up</h2>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="name" placeholder="Full Name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pass" placeholder="Password">
            <input type="password" name="passrpt" placeholder="Confirm Password">
            <button type="submit" name="submit">Sign Up!</button>
        </form>
    </section>

<?php include_once 'footer.php'; ?>    