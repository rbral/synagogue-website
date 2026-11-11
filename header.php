
<!DOCTYPE html>
<html class="site-header">
    <head>
        <meta charset="UTF-8">
        <title>ShulFlow</title>
        
        <!-- SlimMenu CSS -->
        <link rel="stylesheet" href="css/slimmenu.min.css" type="text/css">
        
        <!-- our css -->
        <link rel="stylesheet" href="style.css?v=4" >
                
        <link rel="icon" type="image/png" href="ShulFlow logo.png">
        
        <script   src="https://code.jquery.com/jquery-3.6.0.min.js"   integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="   crossorigin="anonymous"></script>

        
        <?php if (!empty($includeSlideshowScripts)): ?>
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
            <!--<script src="responsiveslides.min.js"></script>-->
        
            <script src="ResponsiveSlides.js-master/responsiveslides.min.js"></script>
        <?php endif; ?>
    </head>
    <body>
        <header>            
            <a href="index.php" >
                <img src="ShulFlow logo.png" alt="ShulFlow Logo" class="site-logo">
            </a>
            
            <?php include 'menu.php' ?>
        </header>
   
        