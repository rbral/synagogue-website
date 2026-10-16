<head>
    <meta charset="UTF-8">
    <title>ShulFlow</title>
    <link rel="stylesheet" href="/ShulFlow/style.css?v=2" >
    <link rel="icon" type="image/png" href="ShulFlow logo.png">
</head>
    
<body class="login-page"> 
    <main class="log-in">

        <h1>Register</h1>

            <p>Please fill in this form to become a member of our Shul.</p>

            <form action="login_response.php" method="post">

                <label for="firstName">First Name:</label><br>
                <input type="text" name="firstName" id="firstName" required>
                <br><br>

                <label for="lastName">Last Name:</label><br>
                <input type="text" name="lastName" id="lastName" required>
                <br><br>
                
                <label for="email">Email Address:</label><br>
                <input type="email" name="email" id="email" required>
                <br><br>
                
                <label for="tel">Telephone Number:</label><br>
                <input type="tel" name="tel" id="tel">
                <br><br>
                
                <label for="password">New Password:</label><br>
                <input type="password" name="password" id="password" required>
                <br><br>
                
                <label for="check">By registering, you agree to receive email communications from our admins.</label><br>
                <input type="checkbox" name="check" id="check" required>
                <br><br>

                <input type="submit" value="Register" class="log-in-button">

            </form>
    </main> 
</body>
