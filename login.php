<head>
    <meta charset="UTF-8">
    <title>ShulFlow</title>
    <link rel="stylesheet" href="style.css?v=3" >
    <link rel="icon" type="image/png" href="ShulFlow logo.png">
</head>
    
<body class="login-page"> 
    <main class="log-in">

        <h1>ShulFlow Login</h1>

            <p>Please enter your email and password.</p>

            <form action="login_response.php" method="post">

                <label for="username">Email:</label><br>
                <input type="text" name="username" id="username" required>
                <br><br>

                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" required>
                <br><br>

                <input type="submit" value="Log in" class="log-in-button">

            </form>
    </main> 
</body>