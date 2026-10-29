
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

    //Get selected dropdown values
    $membership_type_id = $_POST['membership_type_id'] ?? '';
    $nusach_id = $_POST['nusach_id'] ?? '';
    
    // Check that both dropdowns have a selection
    if ($membership_type_id == '' || $nusach_id == '')
    {
        echo "Error: Please select a membership type and nusach.<br><br>";
        echo "<a href='register.php'>Try Again</a>";
        exit();
    }
    
    
    // Prepare sql statement
    $sql = "INSERT INTO user_info
            (first_name, last_name, email, tel, password_hash,
             membership_type_id, nusach_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    // connects the PHP variables to the five ? placeholders
    // s = string, i = integer
    $stmt->bind_param(
        "sssssii",
        $first_name,
        $last_name,
        $email,
        $tel,
        $hashedPassword,
        $membership_type_id,
        $nusach_id
    );
    
    

    try
    {
        if ($stmt->execute()) {
            $sql = "SELECT membership_type_name, nusach_name
                    FROM user_info
                    JOIN membership_type
                    ON user_info.membership_type_id = membership_type.membership_type_id
                    JOIN nusach_type
                    ON user_info.nusach_id = nusach_type.nusach_id
                    WHERE user_info.user_id = ?";
            
            $details_stmt = $conn->prepare($sql);
            
            // Get ID of the user we just registered
            $user_id = $conn->insert_id;

            $details_stmt->bind_param("i", $user_id);
            $details_stmt->execute();

            $result = $details_stmt->get_result();
            $row = $result->fetch_assoc();
            
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
            
            // Display membership type and nusach from database
            echo "<strong>Membership Type:</strong><br>";
            echo htmlspecialchars($row['membership_type_name']) . "<br><br>";

            echo "<strong>Preferred Nusach:</strong><br>";
            echo htmlspecialchars($row['nusach_name']) . "<br><br>";

            if (isset($_POST['email_communications']))
            {
                echo "You agreed to receive email communications from our admins.<br><br>";
            }

            echo "<br><a href='login.php'>Log In</a> to access your dashboard.";
        
            $details_stmt->close();
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
