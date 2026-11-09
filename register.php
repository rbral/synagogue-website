<?php
    // Connect to database
    require_once 'db_connect.php';

    // Get membership types from database
    $membership_sql = "SELECT membership_type_id, membership_type_name
                       FROM membership_type";
    $membership_result = $conn->query($membership_sql);

    // Get nusach types from database
    $nusach_sql = "SELECT nusach_id, nusach_name
                   FROM nusach_type";
    $nusach_result = $conn->query($nusach_sql);
?>


<head>
    <meta charset="UTF-8">
    <title>ShulFlow</title>
    <link rel="stylesheet" href="style.css?v=4" >
    <link rel="icon" type="image/png" href="ShulFlow logo.png">
</head>
    
<body class="forms-page"> 
    <main class="forms">

        <h1>Register</h1>

            <p>Please fill in this form to become a member of our Shul.</p>

            <form action="register_response.php" method="post">

                <label for="first_name">First Name:</label><br>
                <input type="text" name="first_name" id="first_name" required>
                <br><br>

                <label for="last_name">Last Name:</label><br>
                <input type="text" name="last_name" id="last_name" required>
                <br><br>
                
                <label for="email">Email Address:</label><br>
                <input type="email" name="email" id="email" required>
                <br><br>
                              
                <label for="tel">Telephone Number:</label><br>
                <input type="tel" id="tel" name="tel"
                    pattern="[0-9]{10}"
                    maxlength="10"
                    inputmode="numeric"
                    title="Please enter exactly 10 digits without dashes or parentheses."
                    required>
                <br><br>
                
                <label for="password">New Password:</label><br>
                <input type="password" name="password" id="password" required>
                <br><br>
                
                <!-- Membership Type dropdown: options come from the database -->
                <label for="membership_type_id">Membership Type:</label><br>

                <select name="membership_type_id" id="membership_type_id" required>
                    <option value="">Select Membership Type</option>

                    <?php
                    // Loop through membership types returned by SQL
                    while ($row = $membership_result->fetch_assoc())
                    {
                        echo "<option value='" . (int)$row['membership_type_id'] . "'>"
                            . htmlspecialchars($row['membership_type_name'])
                            . "</option>";
                    }
                    ?>

                </select>
                <br><br>

                <!-- Nusach dropdown: options come from the database -->
                <label for="nusach_id">Preferred Nusach:</label><br>

                <select name="nusach_id" id="nusach_id" required>
                    <option value="">Select Nusach</option>

                    <?php
                    // Loop through nusach types returned by SQL
                    while ($row = $nusach_result->fetch_assoc())
                    {
                        echo "<option value='" . (int)$row['nusach_id'] . "'>"
                            . htmlspecialchars($row['nusach_name'])
                            . "</option>";
                    }
                    ?>

                </select>
                <br><br>
                
                <label for="check">By registering, you agree to receive email communications from our admins.</label><br>
                <input type="checkbox" name="email_communications" id="check" required>
                <br><br>

                <input type="submit" value="Register" class="submit-button">

            </form>
    </main> 
</body>

<?php
$conn->close();
?>