<?php

session_start();

// Valid usernames and passwords
$usernames = array("admin", "rivka", "sarah");
$passwords = array("admin123", "rivka123", "sarah123");

// Get submitted information
$username = $_POST['username'];
$password = $_POST['password'];

// Assume login failed until a match is found
$_SESSION['LoggedIn'] = FALSE;

// Check each username and password
for ($ix = 0; $ix < count($usernames); $ix++)
{
    if ($username == $usernames[$ix] &&
        $password == $passwords[$ix])
    {
        $_SESSION['LoggedIn'] = TRUE;
        break;
    }
}

// Set Cookie if logged in successfully
if ($_SESSION['LoggedIn'] == TRUE)
{
    setcookie("username", $username, time() + 3600, "/");
}

?>

<?php include 'header.php'; ?>

<main class="main-content">

    <h1>Login Result</h1>

    <?php

    if ($_SESSION['LoggedIn'] == TRUE)
    {
        echo "Login successful!<br><br>";

    }
    else
    {
        echo "Invalid username or password.<br><br>";
    }

    echo "<a href='admin_dashboard.php'>Go to Admin Dashboard</a>";

    ?>

</main>

<?php include 'footer.php'; ?>