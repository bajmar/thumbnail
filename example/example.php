<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/../vendor/autoload.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Example page</title>
    </head>
    <body>

        <h1>Example page</h1>
        
        <div>
            <img src="<?= Thumbimg\Thumbimg::img(__DIR__ . '/image.jpeg', __DIR__ . '/thumbimg/', 'http://localhost:5555/example/thumbimg/', 100, 300) ?>" alt="">
            <!--  
            output: <img src="http://localhost:5555/example/thumbimg/100x300_95_image.jpeg" alt="">
            -->
        </div>
        <div>
            <img src="<?= Thumbimg\Thumbimg::img(__DIR__ . '/image.jpeg', __DIR__ . '/thumbimg/', 'http://localhost:5555/example/thumbimg/', 300, 100) ?>" alt="">
            <!-- 
            output: <img src="http://localhost:5555/example/thumbimg/300x100_95_image.jpeg" alt="">
            -->
        </div>
        <div>
            <img src="<?= Thumbimg\Thumbimg::img(__DIR__ . '/image.jpeg', __DIR__ . '/thumbimg/', 'http://localhost:5555/example/thumbimg/', 200, 200) ?>" alt="">
            <!-- 
            output: <img src="http://localhost:5555/example/thumbimg/200x200_95_image.jpeg" alt="">
            -->
        </div>
        <div>
            <img src="<?= Thumbimg\Thumbimg::img(__DIR__ . '/image.jpeg', __DIR__ . '/thumbimg/', 'http://localhost:5555/example/thumbimg/', 200, 200,50) ?>" alt="">
            <!-- 
            output: <img src="http://localhost:5555/example/thumbimg/200x200_50_image.jpeg" alt="">
            -->
        </div>
        
    </body>
</html>