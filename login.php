<?php

require "includes/functions.php";
$auth = user_authenticated();

if($auth){
    header("Location: /");
}

//Import db
require 'includes/config/database.php';
$db = conectarDB();

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));

	$password = mysqli_real_escape_string( $db, $_POST['password']);

    if(!$email){
        $errores[] = "¡El email es obligatorio o no es válido!";
    }

    if(!$password){
        $errores[] = "¡El password es obligatorio!";
    }

    if(empty($errors)){

        $query_user = "SELECT * FROM user WHERE email = '${email}'";
        $consult_user = mysqli_query($db, $query_user);

        $query_admin = "SELECT * FROM admin WHERE email = '${email}'";
        $consult_admin = mysqli_query($db, $query_admin);

        // If the user is just a normal user
        if( $consult_user->num_rows ){
            $user = mysqli_fetch_assoc($consult_user);

            // Check the password
            $auth = password_verify($password, $user['password']);

            if($auth){

				session_start();

				// Fill array session
				$_SESSION["username"] = $user["username"];
                $_SESSION["id"] = $user["id"];
				$_SESSION['login'] = true;
                $_SESSION["admin"] = false;

				header('Location: home.php');
            }
            else{
                $errors[] = "El password es incorrecto";
            }
        }

        // If the user is a admin
        else if( $consult_admin->num_rows ){
            $user = mysqli_fetch_assoc($consult_admin);

            // Check the password
            $auth = password_verify($password, $user['password']);

            if($auth){

				session_start();

				// Fill array session
				$_SESSION["username"] = $user["username"];
                $_SESSION["id"] = $user["id"];
				$_SESSION['login'] = true;
                $_SESSION["admin"] = true;

				header('Location: /admin');
            }
            else{
                $errors[] = "El password es incorrecto";
            }

        }

        else{
            $errors[] = "El usuario no existe";
        }
    }
}

include "includes/templates/header.php";
?>


<main class="margin-top-bar">
    <header class="header-phrase">
        <h2 class="center-text">Iniciar sesión</h2>
        <?php if(isset($_GET["alert"]) && $_GET["alert"] === "sucesfully"): ?>

            <div class="alert exit center-section">
                <p>!Registro exitoso!</p>
            </div>

        <?php endif; ?>
    </header>
    <form action="" class=" form-phrase center-section" method="POST">
        
    <?php foreach($errors as $error): ?>
        <div class="alert error">
            <p><?php echo $error; ?></p>
        </div>
    <?php endforeach; ?>

        <label for="email">Introduce tu email</label>
        <input type="email" id="email" name="email">

        <label for="password">Introduce tu password</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Entrar" class="btn-green-block">
    </form>
</main>


<?php
include "includes/templates/footer.php";
?>