<?php

session_start();

?>

<?php include 'header.php'; ?>

<main class="main-content">

    <h1>Admin Dashboard</h1>

    <?php

    if (isset($_SESSION['LoggedIn']) &&
        $_SESSION['LoggedIn'] == TRUE)
    {
        $username = $_SESSION['username'] ?? ($_COOKIE['username'] ?? '');

        echo "Hello, " . htmlspecialchars($username) . "!<br><br>";

        echo "Welcome to the ShulFlow Admin Dashboard.<br><br>";

        // Links to the admin pages
        echo "<h2>Admin Options</h2>";

        echo "<a href='mass_email.php'>Send Mass Email</a><br><br>";

        echo "<a href='members.php'>Member Directory</a>";
    }
    else
    {
        echo "Error: You must log in to access this page.<br><br>";

        echo "<a href='login.php'>Return to Login Page</a>";
    }

    ?>

</main>

<?php include 'footer.php'; ?>