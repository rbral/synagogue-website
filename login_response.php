<?php

session_start();

// Connect to database
require_once 'db_connect.php';

// Get submitted information
$username = $_POST['username'];
$password = $_POST['password'];

// Assume login failed until a match is found
$_SESSION['LoggedIn'] = FALSE;

// check username in DB
$sql = "SELECT email, password_hash FROM user_info WHERE email = ?";

$stmt = $conn->prepare($sql);

// Bind the entered username to the SQL statement
$stmt->bind_param("s", $username);

// Execute the query
$stmt->execute();

// Get the results
$result = $stmt->get_result();

// Check if a matching username was found
if ($result->num_rows == 1)
{
    $user = $result->fetch_assoc();

    // Check if the password matches the saved hash
    if (password_verify($password, $user['password_hash']))
    {
        $_SESSION['LoggedIn'] = TRUE;
    }
}
  
$stmt->close();
$conn->close();






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
        
        //TODO: eventually we need to check the user's role to see if memnber or admin
        echo "<a href='admin_dashboard.php'>Go to Admin Dashboard</a>";

    }
    else
    {
        echo "Invalid username or password.<br><br>";
        echo "<a href='login.php'>Try Again</a>";
    }

    ?>

</main>

<?php include 'footer.php'; ?>