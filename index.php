<?php
include "includes/templates/header.php";
?>


<main class="">
    
    <header class="hero">
        <div>
            <h1 class="center-text">Aumenta tu productividad y alcanza tus metas.</h1>
            <div class="controls container">
                <a href="login.php" class="btn-transparent">Iniciar Sesíon</a>
                <a href="register.php" class="btn-transparent">Registrate</a>
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
                <a href="login.php" class="btn-transparent">Iniciar Sesíon</a>
                <a href="register.php" class="btn-transparent">Registrate</a>
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
        <p class="container">Mide tus tiempos de trabajo y descanso</p>
        <span class="span-giant">25:5</span>
    </section>

</main>

<?php


include "includes/templates/footer.php";


?>