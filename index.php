<?php


// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// Data base
require "includes/config/database.php";
$db = conectarDB();


// Execute the code when the user make some change
if($_SERVER["REQUEST_METHOD"] === "POST"){

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";
    
    $action = mysqli_real_escape_string( $db, $_POST['action']);
    
    // Max size of image
    $size = 4000 * 1000; // 4mb
    
    switch ($action) {
        case "task_completed":
            
            $id = mysqli_real_escape_string( $db, $_POST['id']);

            $query = "SELECT image FROM task WHERE id = '$id'";
            $consult = mysqli_query($db, $query);
            $task = mysqli_fetch_assoc($consult);

            // var_dump($task["image"]);

            // If the image of task exist, we deleted it
            if($task["image"] !== NULL){
                $dir_image = "images/";
                unlink($dir_image . $task['image']);
            }

            $query = "DELETE FROM task WHERE id = '$id';";
            // var_dump($query);

            // Commit the query
            $consult = mysqli_query($db, $query);

            break;
        
        case "create_task":

            $title = mysqli_real_escape_string( $db, $_POST['title']);

            $image = $_FILES["image"];

            // Upload images

            // Create dir
            $dir_image = "images/";

            // If the dir doesnt exist
            if(!is_dir($dir_image)){
                mkdir($dir_image);
            }

            
            // echo "<pre>";
            // var_dump($image["name"]);
            // echo "</pre>";
            
            $query = "";

            // If the user upload a image, we upload it
            if($image["name"] !== ""){

                // Generate a unique name for the image
                $image_name = md5(uniqid(rand(), true)) . ".jpg";
    
                // Upload the image
                move_uploaded_file($image['tmp_name'], $dir_image . $image_name);

                $query = "INSERT INTO task (title, image, userId) VALUES ('$title', '$image_name', 2);";
            }

            // Else, we just insert the task without a image
            else{
                $query = "INSERT INTO task (title, userId) VALUES ('$title', 2);";
            }


            // var_dump($query);

            // We validate the form in case where the user has inspect and make a some change

            if(strlen($title) < 4 || strlen($title) > 45 || $image["size"] > $size){
                header('Location: /');
            }
            else{
                // Commit the query
                $consult = mysqli_query($db, $query);
            }

            break;
        
        case "update_task":

            $id = mysqli_real_escape_string( $db, $_POST['id']);
            $title = mysqli_real_escape_string( $db, $_POST['title']);

            $image = $_FILES["image"];

            // Update image

            // Create dir
            $dir_image = "images/";

            // If the dir doesnt exist
            if(!is_dir($dir_image)){
                mkdir($dir_image);
            }
            
            // Update image code
            // echo "<pre>";
            // var_dump($_FILES);
            // echo "</pre>";
            
            $query = "SELECT image FROM task WHERE id = '$id'";
            $consult = mysqli_query($db, $query);
            $task = mysqli_fetch_assoc($consult);

            // echo "<pre>";
            // var_dump($task["image"]);
            // echo "</pre>";

            $image_name = "";
            
            // If exist a new image
            if($image["name"]){
                //Eliminate the image prev if exists

                if($task["image"] !== NULL){
                    var_dump($dir_image . $task['image']);
                    unlink($dir_image . $task['image']);
                }

                // Generate a unique name for the image
                $image_name = md5(uniqid(rand(), true)) . ".jpg";

                // Upload the image
                move_uploaded_file($image['tmp_name'], $dir_image . $image_name);
            }
            // Else overwrite with the same name
            else{
                $image_name = $task['image'];
            }



            if(strlen($title) < 4 || strlen($title) > 45 || $image["size"] > $size){
                header('Location: /');
            }
            else{

                $query = "UPDATE task SET title = '$title', image = '$image_name' WHERE id = '$id';";
                // var_dump($query);
    
                // Commit the query
                $consult = mysqli_query($db, $query);
            }


            break;
        
        default:
            # code...
        break;
    }

}


include "includes/templates/header.php";



?>

    <div class="body-div container">
        <aside>
            <div class="container phrase-container">
                <div class="user">
                    <h3>Hola, Fernanda.<span class="emoji">💖</span></h3>
                </div>
                <div class="text-phrase-container">
                    <p>La inteligencia consiste no sólo en el conocimiento, sino también en la destreza de aplicar los conocimientos en la práctica.</p>
                    <blockquote>- Aristóteles</blockquote>
                    <img src="build/img/undraw_advanced_customization_re_wo6h.svg" alt="" id="phrase-image" class="phrase-image">
                </div>
            </div>
        </aside>
        <main class="main">
            <div class="pomodoro">
                <div class="pomodoro-start">
                    <h3 class="title">Pomodoro.</h3>
                    <span>25:5</span>
                </div>
                <div class="pomodoro-counter">
                    <span id="timer">00:00</span>
                </div>
                <button class="btn-green-block" id="start-pomodoro">Iniciar</button>
                <div class="pomodoro-state"><span id="pomodoro-message"></span></div>
            </div>

            <div class="tasks">
                <header class="header-tasks">
                    <h3 class="title ">Mis Tareas</h3>
                    <button class="btn-green-block" id="btn-add">Agregar</button>
                </header>
                <div class="task-container">
                    
                <!-- print the tasks -->

                <?php

                // Write the query
                $query = "SELECT * FROM task";

                // Commit the query
                $consult = mysqli_query($db, $query);

                ?>

                <?php while($task = mysqli_fetch_assoc($consult)): ?>

                    <div class="task"
                    style='background-image: url("images/<?php echo $task["image"]; ?>");'>

                        <!-- View task -->
                        <div class="task-content" id="<?php echo $task["id"]; ?>">
                            <p class="title-task">
                                <?php echo $task["title"]; ?>
                            </p>
                            <div class="controls">
                                <form action="" method="POST" enctype="multipart/form-data">

                                    <input 
                                    type="hidden" 
                                    name="id" 
                                    value="<?php echo $task["id"]; ?>">

                                    <input type="hidden" name="action" value="task_completed">

                                    <input type="submit" value="✅" class="btn-green-block">
                                </form>

                                <button class="btn-orange edit" id="<?php echo $task["id"]; ?>">✏</button>
                            </div>
                        </div>

                        <!-- Edit task -->

                        <div class="task-edit hidden" id="<?php echo $task["id"]; ?>-edit">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <fieldset>
                                    <label>Titulo:</label>
                                    <input type="text"
                                    class="input-title"
                                    name="title"
                                    value="<?php echo $task["title"]; ?>">

                                    <label for="">Imagen:</label>
                                    <input type="file" name="image" id="" class="input-file">

                                    <input type="hidden" name="id" value="<?php echo $task["id"]; ?>">
                                    <input type="hidden" name="action" value="update_task">

                                </fieldset>
                                <div class="controls">

                                    <input type="submit" value="✅" class="btn-green-block save">
                                    <a href="#" class="btn-red-block cancel-edit" id="<?php echo $task["id"]; ?>">❌</a>
                                </div>
                            </form>
                        </div>
                    </div><!--.task-->
                    <?php endwhile; ?>
                </div>
            </div>
        </main>
    </div>
    <div class="overlay hidden">
        <div class="popup">
            <h3 class="center-text">Nueva Tarea</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <label for="title">Titulo:</label>
                    <input type="text" name="title" id="title" class="input-title">
                </fieldset>
                <fieldset>
                    <label for="image">Imagen:</label>
                    <input type="file" name="image" id="image" class="input-file">
                </fieldset>
                <div class="controls"> 
                    <input type="hidden" name="action" value="create_task">
                    <input type="submit" value="✅" class="btn-green-block save">
                    <a href="#" class="btn-red-block cancel">❌</a>
                </div>
            </form>
        </div>
    </div>
<?php


include "includes/templates/footer.php";


?>