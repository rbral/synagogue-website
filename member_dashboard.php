<?php

session_start();

?>

<?php include 'header.php'; ?>

<main class="main-content">

    <h1>Member Dashboard</h1>

    <?php

    if (isset($_SESSION['LoggedIn']) &&
        $_SESSION['LoggedIn'] == TRUE)
    {
        $username = $_SESSION['username'] ?? ($_COOKIE['username'] ?? '');

        echo "Hello, " . htmlspecialchars($username) . "!<br><br>";

        echo "Welcome to the ShulFlow Member Dashboard.<br><br>";

        // Links to the member pages
        echo "<h2>Member Options</h2>";

        // TODO: Add relevant pages 
       // echo "<a href='mass_email.php'>Send Mass Email</a><br><br>";

       // echo "<a href='members.php'>My Pledges</a>";
    }
    else
    {
        echo "Error: You must log in to access this page.<br><br>";

        echo "<a href='login.php'>Return to Login Page</a>";
    }

    ?>

</main>

<?php include 'footer.php'; ?>