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

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $id = mysqli_real_escape_string( $db, $_POST['id']);

    $action = mysqli_real_escape_string( $db, $_POST['action']);

    $query = "";

    // Delete users

    if($action === "delete-user"){

        // Delete all images of user

        // Consult all images that user has add
        $query = "SELECT * FROM task WHERE userId = '${id}'";
        $consult = mysqli_query($db, $query);

        $dir_image = "../../images/";

        // and we delete all files that user uploaded
        while($task = mysqli_fetch_assoc($consult)):

            // If the task has a image we delete it
            if($task["image"]){
                // echo "<pre>";
                // var_dump($dir_image . $task["image"]);
                // echo "</pre>";

                unlink($dir_image . $task["image"]);

            }

            
        endwhile;


        // Delete all register of task
        $query = "DELETE FROM task WHERE userId = '${id}'";
        $consult = mysqli_query($db, $query);

        $query = "DELETE FROM user WHERE id = '${id}';";
        $consult = mysqli_query($db, $query);

    }

    if($action === "delete-admin"){

        // Delete all phrases of admin
        $query = "DELETE FROM phrase WHERE adminId = '${id}'";
        $consult = mysqli_query($db, $query);

        // Delete all images of admin

        // Consult all images that admin has add
        $query = "SELECT * FROM images_phrase WHERE adminId = '${id}'";
        $consult = mysqli_query($db, $query);

        $dir_image = "../../images/";

        // and we delete all files that admin uploaded
        while($image = mysqli_fetch_assoc($consult)):

            // echo "<pre>";
            // var_dump($dir_image . $image["images"]);
            // echo "</pre>";

            unlink($dir_image . $image["images"]);
            
        endwhile;


        // Delete all register of images
        $query = "DELETE FROM images_phrase WHERE adminId = '${id}'";
        $consult = mysqli_query($db, $query);

        // Finally, we delete the admin
        $query = "DELETE FROM admin WHERE id = '${id}';";
        $consult = mysqli_query($db, $query);
    }

}


include "../../includes/templates/header.php";

?>

<main class="margin-top-bar">
    <header class="header-users container">
        <h2 class="center-text">Administrar...</h2>
        <a href="/admin" class="btn-orange center-section">Volver</a>
    </header>

    <div class="controls container">
        <a href="#users" class="btn-green">Usuarios</a>
        <a href="#admins" class="btn-red-block">Administradores</a>
    </div>

    <div class="container" id="users">
        <h2 class="center-text">Usuarios</h2>

        <div class="users-container">

            <?php

            $query = "SELECT * FROM user;";
            $consult = mysqli_query($db, $query);

            while($user = mysqli_fetch_assoc($consult)):

            ?>

            <div class="user">
                <p>UsuarioId: <?php echo $user["id"] ?></p>
                <p><?php echo $user["username"] ?></p>
                <p><?php echo $user["name"] ?> <?php echo $user["last_name"] ?></p>
                <p><?php echo $user["email"] ?></p>
                <div class="controls">
                    <a href="user_tasks.php?id=<?php echo $user["id"] ?>" 
                    class="btn-orange">Tareas</a>

                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $user["id"] ?>">
                        <input type="hidden" name="action" value="delete-user">
                        <input type="submit" value="Eliminar" class="btn-red-block">
                    </form>
                </div>
            </div> <!-- .user -->

            <?php endwhile; ?>

        </div><!-- .users-container -->

    </div><!-- users -->

    <div class="container" id="admins">
        <h2 class="center-text">Administradores</h2>

        <div class="users-container">
            
        <?php

            $query = "SELECT * FROM admin;";
            $consult = mysqli_query($db, $query);

            while($user = mysqli_fetch_assoc($consult)):

            ?>
        
            <div class="user">
                <p><?php echo $user["username"] ?></p>
                <p><?php echo $user["name"] ?> <?php echo $user["last_name"] ?></p>
                <p><?php echo $user["email"] ?></p>

                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?php echo $user["id"] ?>">
                    <input type="hidden" name="action" value="delete-admin">
                    <input type="submit" value="Eliminar" class="btn-red-block">
                </form>

            </div> <!-- .user -->
            
            <?php endwhile; ?>
        </div><!-- .users-container -->

    </div><!-- users -->

</main>


<?php


include "../../includes/templates/footer.php";


?>