<?php
require "../../includes/functions.php";
$auth = user_authenticated();
$auth_admin = admin_authenticated();

if(!$auth_admin || !$auth){
    header("Location: /");
}

// Data base
require "../../includes/config/database.php";
$db = conectarDB();
mysqli_query($db,"SET NAMES 'utf8'");

// echo "<pre>";
// var_dump($_GET);
// echo "</pre>";
$id = mysqli_real_escape_string( $db, $_GET["id"]);

// Get phrase data
$query = "SELECT * FROM phrase WHERE id = '$id'";
$consult = mysqli_query($db, $query);
$phrase_data = mysqli_fetch_assoc($consult);

$phrase = $phrase_data["phrase_content"];
$autor = $phrase_data["autor"];

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

        $query = "UPDATE phrase SET phrase_content = '$phrase', autor = '$autor', adminId = '1' WHERE id = '$id';";

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
        <h2 class="center-text">Editar Frase</h2>
        <a href="../phrases/phrases.php" class="btn-orange center-section">Volver</a>
    </header>
    <?php if($errors): ?>
    <div class="alert error center-section">
        <p><?php echo $errors; ?></p>
    </div>
    <?php endif; ?>
    <form action="" class="form-phrase center-section" method="POST">
        <label for="phrase">Frase:</label>
        <textarea name="phrase" id="phrase"><?php echo $phrase; ?></textarea>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" value="<?php echo $autor; ?>">
        <input type="submit" value="Guardar" class="btn-green-block">
    </form>
    </main>

<?php

include "../../includes/templates/footer.php";

?>