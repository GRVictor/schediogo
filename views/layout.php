<?php
    $isCenteredPage = in_array($_SERVER['REQUEST_URI'], ['/', '/sign-up', '/forgot', '/activate', '/recover']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHEDIO / GO</title>
    <link rel="icon" type="image/png" sizes="16x16"  href="/favicons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=New+Rocker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="build/css/app.css">
</head>
<body>
    <div class="container-app">
        <div class="image"></div>
        <div class="app <?php echo $isCenteredPage ? 'centered' : ''; ?>">
            <?php
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $redirectUrl = '';
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                    $redirectUrl = '/admin';
                } elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == 0) {
                    $redirectUrl = '/appointment';
                }
            ?>
            <a href="<?php echo $redirectUrl; ?>">
                <img class="logo" src="../build/img/logo.webp" alt="logo">
            </a>
            <?php echo $content; ?>
        </div>
    </div>

    <?php 
        echo $script ?? '';
    ?>
            
</body>
</html>