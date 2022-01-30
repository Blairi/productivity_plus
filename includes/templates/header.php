<?php



    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productivity +</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="principal-header">
        <div class="bar container center-text">
            <a href="/"><h2>Productivity +</h2></a>
            <?php if($auth): ?>
                <a href="/logout.php">Cerrar sesión. <?php echo $_SESSION['username'] ?></a>
            <?php endif; ?>
            <!-- <h1>Aumenta tu productividad y alcanza tus metas.</h1> -->
        </div>
    </header>