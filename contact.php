
<?php include 'header.php'; ?>

<main class="main-content">

    <h1>Contact Us</h1>

    <p>Have a question or comment? Please fill out the form below
       to contact the ShulFlow office.</p>

    <form action="contact_response.php" method="post" class="contact-form">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" maxlength="100" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" maxlength="254" required>

        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="6" maxlength="5000" required></textarea>

        <input type="submit" value="Send Message" class="submit-button">

    </form>

</main>

<?php include 'footer.php'; ?>