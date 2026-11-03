
<!DOCTYPE html>
<html class="site-header">
    <head>
        <meta charset="UTF-8">
        <title>ShulFlow</title>
        <link rel="stylesheet" href="style.css?v=3" >
        <link rel="icon" type="image/png" href="ShulFlow logo.png">
        <?php if (!empty($includeSlideshowScripts)): ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
            <script src="responsiveslides.min.js"></script>
        <?php endif; ?>
    </head>
    <body>
        <header>            
            <a href="index.php" >
                <img src="ShulFlow logo.png" alt="ShulFlow Logo" class="site-logo">
            </a>
            
            <?php include 'menu.php' ?>
        </header>
   
        