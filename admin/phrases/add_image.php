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

// Max size of image
$size = 4000 * 1000; // 4mb

$errors = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";
    
    $image = $_FILES["image"];
    // Upload images

    // Create dir
    $dir_image = "../../images/";

    // If the dir doesnt exist
    if(!is_dir($dir_image)){
        mkdir($dir_image);
    }

    if($image["size"] > $size){
        $errors = "La imagen debe pesar menos de 4mb.";
    }
    else if($image["tmp_name"] === ""){
        $errors = "¡No has subido ninguna imagen!";
    }

    else{
        $image_name = md5(uniqid(rand(), true)) . ".png";
        $query = "INSERT INTO images_phrase (images, adminId) VALUES ('$image_name', '$session_id');";
        // Upload the image
        move_uploaded_file($image['tmp_name'], $dir_image . $image_name);
        
        // Commit the query
        $consult = mysqli_query($db, $query);
        header("Location: phrases.php");
    }


}


include "../../includes/templates/header.php";

?>


<main class="margin-top-bar">
    <header class="header-phrase container">
        <h2 class="center-text">Agregar Imagen</h2>
        <a href="../phrases/phrases.php" class="btn-orange center-section">Volver</a>
    </header>
    <?php if($errors !== ""): ?>
    <div class="alert error center-section">
        <p><?php echo $errors; ?></p>
    </div>
    <?php endif; ?>
    <form action="" class="form-phrase center-section" method="POST" enctype="multipart/form-data">
        <label for="image">Imagen:</label>
        <input type="file" name="image" id="image">
        <input type="submit" value="Guardar" class="btn-green-block">
    </form>
</main>



<?php

include "../../includes/templates/footer.php";

?>