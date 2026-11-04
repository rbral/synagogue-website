<?php

use PHPMailer\PHPMailer\PHPMailer;

// Only process submitted forms
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: contact.php');
    exit;
}

// Get information from the form
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

$sent = false;

// Check that the information is valid
if ($name == '' || $email == '' || $message == '') {
    $error = "Please complete all fields.";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
}
elseif (strlen($name) > 100 || strlen($message) > 5000) {
    $error = "One of the fields is too long.";
}
else {

    // Load PHPMailer
    require __DIR__ . '/PHPMailer-master/src/Exception.php';
    require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
    require __DIR__ . '/PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer;

    // Gmail settings
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;

    // Load Gmail credentials
    require_once 'C:/xampp/gmail_config.php';
    $mail->Username = $gmail_username;
    $mail->Password = $gmail_password;

    // Sender and recipient
    $mail->setFrom($gmail_username);
    $mail->addAddress($gmail_username);

    // Allow administrator to reply to the person
    $mail->addReplyTo($email, $name);

    // Email contents
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'New Message from ShulFlow Contact Us';

    $mail->Body = "Name: " . $name .
                  "\nEmail: " . $email .
                  "\n\nMessage:\n" . $message;

    // Send email
    try {
        $sent = $mail->send();
    }
    catch (Exception $e) {
        $sent = false;
    }
}

?>

<?php include 'header.php'; ?>

<main class="main-content">

    <h1>Contact Us</h1>

    <?php

    if (isset($error)) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }
    elseif ($sent) {
        echo "<p>Thank you! Your message has been sent successfully.</p>";
    }
    else {
        echo "<p>Sorry, your message could not be sent. Please try again.</p>";
    }

    ?>

    <a href="contact.php">Return to Contact Us</a>

</main>

<?php include 'footer.php'; ?>