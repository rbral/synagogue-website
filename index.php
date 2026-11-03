
    
    <?php 
    $includeSlideshowScripts = true;
    include 'header.php' ?>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="ResponsiveSlides.js-master/responsiveslides.min.js"></script>
    
    
    <main class = "main-content">
        <h1>Welcome to our shul website</h1>
        <p>
            Here you can view our minyan schedules and information about our shul.
            <br> <br>
            Login or create your account to access your member information, 
            view pledges and donations, and sign up for upcoming events.
            <br> <br>    
        </p>
        <script>
            $(function() {
                $(".rslides").responsiveSlides({
                    speed: 500,            // Integer: Speed of the transition, in milliseconds
                    timeout: 4000          // Integer: Time between slide transitions, in milliseconds
                });
            });
        </script>
        <ul class="rslides">
            <li><img src="outside_shul.png" alt=""></li>
            <li><img src="inside_shul.png" alt=""></li>
            <li><img src="hall_shul.png" alt=""></li> 
        </ul>
    </main>
    
    <?php include 'footer.php' ?>
    

