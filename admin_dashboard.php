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
        $username = $_COOKIE['username'];

        echo "Hello, " . $username . "!<br><br>";

        echo "Welcome to the ShulFlow Admin Dashboard.";
    }
    else
    {
        echo "Error: You must log in to access this page.<br><br>";

        echo "<a href='login.php'>Return to Login Page</a>";
    }

    ?>

</main>

<?php include 'footer.php'; ?>