
<?php
include 'header.php';
?>

<main class="main-content">

<?php

    // Connect to database
    require_once 'db_connect.php';    
    
    // Save information from registration page to database
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $tel = $_POST['tel'] ?? '';
    // Check that telephone number contains exactly 10 digits
    if (!preg_match('/^[0-9]{10}$/', $tel))
    {
        echo "Error: Telephone number must contain exactly 10 digits.<br><br>";
        echo "<a href='register.php'>Try Again</a>";
        exit();
    }
    
    $password = $_POST['password'] ?? '';
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // safer to save a hashed version of password

    // Prepare sql statement
    $sql = "INSERT INTO user_info (first_name, last_name, email, tel, password_hash)
    VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    // connects the PHP variables to the five ? placeholders
    $stmt->bind_param(
        // all five submitted values are strings
        "sssss",
        $first_name,
        $last_name,
        $email,
        $tel,
        $hashedPassword
    );

    try
    {
        if ($stmt->execute()) {
            // Print a message to the member. 
            echo "<h1>Registration Submitted</h1>";
            echo "<p>Thank you for registering to ShulFlow!</p>";

            // notes:
            // htmlspecialchars() makes sure that any HTML code entered by the user
            // is displayed as regular text instead of being executed by the browser.
            // The ?? '' means that if the form field is missing or null,
            // PHP will use an empty string instead to avoid errors.

            echo "<strong>First Name:</strong><br>";
            echo htmlspecialchars($first_name) . "<br><br>";

            echo "<strong>Last Name:</strong><br>";
            echo htmlspecialchars($last_name) . "<br><br>";

            echo "<strong>Email Address:</strong><br>";
            echo htmlspecialchars($email) . "<br><br>";

            echo "<strong>Telephone Number:</strong><br>";
            echo htmlspecialchars($tel) . "<br><br>";

            if (isset($_POST['email_communications']))
            {
                echo "You agreed to receive email communications from our admins.<br><br>";
            }

            echo "<br><a href='login.php'>Log In</a> to access your dashboard.";
        }
    } catch (mysqli_sql_exception $e)
{
    if ($e->getCode() == 1062)
    {
        echo "This email address is already registered.<br>";
        echo "<a href='register.php'>Try Again</a><br><br>";
        echo "<a href='login.php'>Log In</a>";
    }
    else
    {
        error_log($e->getMessage());
        echo "An error occurred during registration. Please try again.";
    }
}

    $stmt->close();
    $conn->close();
?>

</main>

<?php
include 'footer.php';
