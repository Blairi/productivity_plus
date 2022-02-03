<?php

require "includes/functions.php";
$auth = user_authenticated();
$auth_admin = admin_authenticated();

include "includes/templates/header.php";

?>


<main class="">
    
    <header class="hero">
        <div>
            <h1 class="center-text">Aumenta tu productividad y alcanza tus metas.</h1>
            <div class="controls container">
                <?php

                if($auth && !$auth_admin):?>
                    
                <a href="home.php" class="btn-transparent">Mis tareas</a>
                <a href="/logout.php" class="btn-transparent">Cerrar sesión.</a>

                <?php endif; ?>


                <?php

                if($auth && $auth_admin):?>
                    
                <a href="admin/" class="btn-transparent">Administrar</a>
                <a href="/logout.php" class="btn-transparent">Cerrar sesión.</a>

                <?php endif; ?>

                <?php

                if(!$auth && !$auth_admin):?>

                <a href="login.php" class="btn-transparent">Iniciar Sesión</a>
                <a href="register.php" class="btn-transparent">Registrate</a>

                <?php endif; ?>

            </div>
        </div>
    </header>

    <section class="section-info container">
        <h2 class="center-text">¡Escribe tus tareas con nosotros!</h2>
        <div class="info-img">
            <p>Un solo lugar para organizar tus tareas diarias, ¡a un solo click!</p>
            <img src="build/img/tasks.png" alt="">
        </div>
    </section>

    <section class="section-info background-login">
        <div>
            <h3 class="center-text">¡Empezar ya!</h3>
            <div class="controls container">
            <?php

            if($auth && !$auth_admin):?>
                
            <a href="home.php" class="btn-transparent">Mis tareas</a>
            <a href="/logout.php" class="btn-transparent">Cerrar sesión.</a>

            <?php endif; ?>


            <?php

            if($auth && $auth_admin):?>
                
            <a href="admin/" class="btn-transparent">Administrar</a>
            <a href="/logout.php" class="btn-transparent">Cerrar sesión.</a>

            <?php endif; ?>

            <?php

            if(!$auth && !$auth_admin):?>

            <a href="login.php" class="btn-transparent">Iniciar Sesión</a>
            <a href="register.php" class="btn-transparent">Registrate</a>

            <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section-info container">
        <h2 class="center-text">En cualquier dispositivo, ¡Avanza!</h2>
        <img src="build/img/views.png" alt="">
    </section>

    <section class="section-info container">
        <h2 class="center-text">Agrega, edita o completa.</h2>
        <div class="info-img-2">
            <p>¡Edita tus tareas y completalas!</p>
            <img src="build/img/edit_task.png" alt="">
        </div>
    </section>

    <section class="section-info background-pomodoro">
        <h3 class="center-text">¡Con Pomodoro!</h3>
        <p class="">Mide tus tiempos de trabajo y descanso</p>
        <span class="span-giant">25:5</span>
    </section>

</main>

<?php


include "includes/templates/footer.php";


?>