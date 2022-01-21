<?php
// Data base
require "../../includes/config/database.php";
$db = conectarDB();
mysqli_query($db,"SET NAMES 'utf8'");

include "../../includes/templates/header.php";

?>

<main class="margin-top-bar">
    <header class="header-phrase container">
        <h2 class="center-text">Frases</h2>
        <a href="add_phrase.php" class="btn-green">Agregar</a>
    </header>
    <div class="container-phrases">
        <div class="container">
            <div class="control-panel-phrases">
                <!-- Insert phrases -->
                <?php
                $query = "SELECT * FROM phrase;";
                
                $consult = mysqli_query($db, $query);

                while($phrase = mysqli_fetch_assoc($consult)): ?>

                <div class="phrase">
                    <p><?php echo $phrase["phrase_content"]; ?></p>
                    <blockquote>- <?php echo $phrase["autor"]; ?></blockquote>
                    <div class="controls">
                        <a href="" class="btn-red-block">Eliminar</a>
                        <a href="" class="btn-orange">Editar</a>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <header class="header-images container">
        <h2 class="center-text">Imagenes</h2>
        <a href="" class="btn-green">Agregar</a>
    </header>
    <div class="control-panel-images container">
        <div class="image">
            <img src="../../build/img/undraw_online_organizer_re_156n.svg" alt="">
            <a href="" class="btn-red-block">Eliminar</a>
        </div>
    </div>
</main>

<?php

include "../../includes/templates/footer.php";

?>