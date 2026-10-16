


<?php
include 'header.php';
?>

<main class="main-content">

<?php
echo "<h1>Registration Submitted</h1>";

echo "<p>Thank you for registering with ShulFlow!</p>";


// notes:
// htmlspecialchars() makes sure that any HTML code entered by the user
// is displayed as regular text instead of being executed by the browser.
// The ?? '' means that if the form field is missing or null,
// PHP will use an empty string instead to avoid errors.

echo "<strong>First Name:</strong><br>";
echo htmlspecialchars($_POST['firstName'] ?? '') . "<br><br>";

echo "<strong>Last Name:</strong><br>";
echo htmlspecialchars($_POST['lastName'] ?? '') . "<br><br>";

echo "<strong>Email Address:</strong><br>";
echo htmlspecialchars($_POST['email'] ?? '') . "<br><br>";

echo "<strong>Telephone Number:</strong><br>";
echo htmlspecialchars($_POST['tel'] ?? '') . "<br><br>";

if (isset($_POST['check']))
{
    echo "You agreed to receive email communications from our admins.<br><br>";
}
?>

</main>

<?php
include 'footer.php';
