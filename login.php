<?php include 'header.php'; ?>

<main class="main-content">

    <h1>ShulFlow Login</h1>

    <p>Please enter your username and password.</p>

    <form action="login_response.php" method="post">

        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" required>
        <br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required>
        <br><br>

        <input type="submit" value="Log In">

    </form>

</main>

<?php include 'footer.php'; ?>