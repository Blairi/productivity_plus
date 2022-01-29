<?php
require "../../includes/functions.php";
$auth = user_authenticated();
$auth_admin = admin_authenticated();

if(!$auth_admin || !$auth){
    header("Location: /");
}

$session_id = $_SESSION["id"];


// Data base
require "../../includes/config/database.php";
$db = conectarDB();
mysqli_query($db,"SET NAMES 'utf8'");

$errors = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $phrase = mysqli_real_escape_string( $db, $_POST['phrase']);
    $autor = mysqli_real_escape_string( $db, $_POST['autor']);

    $errors = "";

    // Commit the query
    
    if(!strlen($phrase) < 10 || !strlen($autor) < 4){
        $query = "INSERT INTO phrase (phrase_content, autor, adminId) VALUES ('$phrase', '$autor', '$session_id');";

        $consult = mysqli_query($db, $query);
        header("Location: phrases.php");
    }
    else{
        $errors = "La FRASE debe tener al menos 10 caracters y el AUTOR al menos 4 caracteres";
    }
}

include "../../includes/templates/header.php";

?>


<main class="margin-top-bar">
    <header class="header-phrase container">
        <h2 class="center-text">Agregar Frase</h2>
        <a href="../phrases/phrases.php" class="btn-orange center-section">Volver</a>
    </header>
    <?php if($errors): ?>
    <div class="alert error center-section">
        <p><?php echo $errors; ?></p>
    </div>
    <?php endif; ?>
    <form action="" class="form-phrase center-section" method="POST">
        <label for="phrase">Frase:</label>
        <textarea name="phrase" id="phrase"></textarea>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor">
        <input type="submit" value="Guardar" class="btn-green-block">
    </form>
</main>

<?php

include "../../includes/templates/footer.php";

?>