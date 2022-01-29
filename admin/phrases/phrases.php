<?php
// Data base
require "../../includes/config/database.php";
$db = conectarDB();
mysqli_query($db,"SET NAMES 'utf8'");

require "../../includes/functions.php";
$auth = user_authenticated();
$auth_admin = admin_authenticated();

if(!$auth_admin || !$auth){
    header("Location: /");
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";


    $action = mysqli_real_escape_string( $db, $_POST['action']);

    // Max size of image
    $size = 4000 * 1000; // 4mb

    switch ($action){


        case "delete_phrase":

            $id = mysqli_real_escape_string( $db, $_POST['id']);

            $query = "DELETE FROM phrase WHERE id = '$id';";
            // var_dump($query);

            // Commit the query
            $consult = mysqli_query($db, $query);

        break;

        case "delete_image":
            $id = mysqli_real_escape_string( $db, $_POST['id']);

            $query = "SELECT images FROM images_phrase WHERE id = '$id'";
            $consult = mysqli_query($db, $query);
            $image = mysqli_fetch_assoc($consult);

            
            $dir_image = "../../images/";
            
            unlink($dir_image . $image["images"]);

            $query = "DELETE FROM images_phrase WHERE id = '$id';";
            // Commit the query
            $consult = mysqli_query($db, $query);

        default:
        # code...
        break;
    }
}





include "../../includes/templates/header.php";

?>

<main class="margin-top-bar">
    <header class="header-phrase container">
        <h2 class="center-text">Frases</h2>
        <div class="controls">
            <a href="../" class="btn-orange">Volver</a>
            <a href="add_phrase.php" class="btn-green">Agregar</a>

        </div>
    </header>
    <div class="container-phrases">
        <div class="container">
            <div class="control-panel-phrases">
                <!-- Insert phrases -->
                <?php
                $query = "SELECT * FROM phrase;";
                
                $consult = mysqli_query($db, $query);

                while($phrase = mysqli_fetch_assoc($consult)): 
                    
                    // Get the username of admin
                    $query = "SELECT username FROM admin WHERE id = '${phrase["adminId"]}';";
                    $consult_admin = mysqli_query($db, $query);
                    $admin = mysqli_fetch_assoc($consult_admin);
                
                ?>

                <div class="phrase">
                    <p>Agregada por: <?php echo $admin["username"]; ?></p>
                    <p><?php echo $phrase["phrase_content"]; ?></p>
                    <blockquote>- <?php echo $phrase["autor"]; ?></blockquote>
                    <div class="controls">
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $phrase["id"]; ?>">
                            <input type="hidden" name="action" value="delete_phrase">
                            <input type="submit" class="btn-red-block" value="Eliminar">
                        </form>
                        <a 
                        href="edit_phrase.php?id=<?php echo $phrase["id"]; ?>"
                        class="btn-orange">Editar</a>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <header class="header-images container">
        <h2 class="center-text">Imagenes</h2>
        <a href="add_image.php" class="btn-green">Agregar</a>
    </header>
    <div class="control-panel-images container">
        <!-- Insert images -->
        <?php
        $query = "SELECT * FROM images_phrase;";
        
        $consult = mysqli_query($db, $query);

        while($image = mysqli_fetch_assoc($consult)):

        // Get the username of admin
        $query = "SELECT username FROM admin WHERE id = '${image["adminId"]}';";
        $consult_admin = mysqli_query($db, $query);
        $admin = mysqli_fetch_assoc($consult_admin);
        
        ?>


        <div class="image">
            <p>Agregada por: <?php echo $admin["username"]; ?></p>
            <img src="../../images/<?php echo $image["images"]; ?>" alt="">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $image["id"]; ?>">
                <input type="hidden" name="action" value="delete_image">
                <input type="submit" class="btn-red-block" value="Eliminar">
            </form>
        </div>


        <?php endwhile; ?>
    </div>
</main>

<?php

include "../../includes/templates/footer.php";

?>