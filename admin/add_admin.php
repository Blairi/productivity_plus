<?php
require "../includes/functions.php";
$auth = user_authenticated();
$auth_admin = admin_authenticated();

if(!$auth_admin || !$auth){
    header("Location: /");
}

//Import db
require '../includes/config/database.php';
$db = conectarDB();

// mysqli_query($db, $query);

$errors = [];

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $name = mysqli_real_escape_string( $db, $_POST['name']);
    $last_name = mysqli_real_escape_string( $db, $_POST['last_name']);
    $user_name = strtolower(mysqli_real_escape_string( $db, $_POST['user_name']));
    $email = mysqli_real_escape_string( $db, $_POST['email']);
    $password = password_hash( mysqli_real_escape_string( $db, $_POST['password']), PASSWORD_BCRYPT);

    if(!$name){
        $errors[] = "¡El nombre es obligatorio!";
    }
    if(!$last_name){
        $errors[] = "¡El apellido es obligatorio!";
    }
    if(!$user_name){
        $errors[] = "¡El nombre de usuario es obligatorio!";
    }
    if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "¡El email es obligatorio o es invalido!";
    }
    if(!$_POST['password']){
        $errors[] = "¡El password es obligatorio!";
    }


    // We verify if the email or username already exists
    $query = "SELECT email, username FROM admin";
    $consult = mysqli_query($db, $query);

    while($validate_user = mysqli_fetch_assoc($consult)){

        if($user_name === $validate_user["username"]){
            $errors[] = "¡El nombre de usuario ya existe!";
        }

        if($email === $validate_user["email"]){
            $errors[] = "¡El correo ya existe!";
        }
    }

    if(empty($errors)){
        $query = "INSERT INTO admin (name, last_name, username, email, password) VALUES ('${name}', '${last_name}', '${user_name}', '${email}', '${password}');";

        // Execute query
        mysqli_query($db, $query);

        header("Location: /admin");
        
    }
}

include "../includes/templates/header.php";
?>
<main class="margin-top-bar">
    <header class="header-phrase container">
        <h2 class="center-text">Agregar Administrador</h2>
        <a href="/admin/" class="btn-orange center-section">Volver</a>
    </header>

    <?php foreach($errors as $error): ?>
        <div class="alert error center-section">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="" class="form-phrase center-section" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name">

        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" id="last_name">

        <label for="user_name">Nombre de usuario:</label>
        <input type="text" name="user_name" id="user_name">

        <label for="email">Correo:</label>
        <input type="email" name="email" id="email">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Guardar" class="btn-green-block">
    </form>
</main>

<?php


include "../includes/templates/footer.php";


?>