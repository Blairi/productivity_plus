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

$id = mysqli_real_escape_string($db, $_GET["id"]);

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id_task = mysqli_real_escape_string( $db, $_POST['id']);

    $query = "SELECT image FROM task WHERE id = '$id_task'";
    $consult = mysqli_query($db, $query);
    $task = mysqli_fetch_assoc($consult);

    // var_dump($task["image"]);

    // If the image of task exist, we deleted it
    if($task["image"] !== NULL){
        $dir_image = "../../images/";
        unlink($dir_image . $task['image']);
    }

    $query = "DELETE FROM task WHERE id = '$id_task'';";
    // var_dump($query);

    // Commit the query
    $consult = mysqli_query($db, $query);
}


include "../../includes/templates/header.php";

?>

<main class="margin-top-bar">

    <header class="header-users container">

        <?php
        
        $query = "SELECT username FROM user WHERE id = ${id}";
        $consult = mysqli_query($db, $query);
        $username = mysqli_fetch_assoc($consult);
        
        ?>

        <h2 class="center-text">Tareas de <?php echo $username["username"]; ?></h2>
        <a href="users.php" class="btn-orange center-section">Volver</a>
    </header>
    <div class="task-container container">
        <?php

        $query = "SELECT * FROM task WHERE userId = ${id};";

        $consult = mysqli_query($db, $query);

        while($task = mysqli_fetch_assoc($consult)):
        
        ?>
        <div class="task"
            style='background-image: url("../../images/<?php echo $task["image"]; ?>");'>
            <div class="task-content" id="<?php echo $task["id"]; ?>">
                <p class="title-task">
                    <?php echo $task["title"]; ?>
                </p>
                <form action="" method="POST">
                    <input 
                    type="hidden" 
                    name="id" 
                    value="<?php echo $task["id"]; ?>">

                    <input type="submit" value="Eliminar" class="btn-red-block">
                </form>
            </div>
        </div><!--.task-->

        <?php endwhile; ?>
    </div>

</main>

<?php


include "../../includes/templates/footer.php";


?>