<?php

include "../includes/templates/header.php";

?>

<main class="margin-top-bar admin">
    <h2 class="center-text">Bienvenido, Admin</h2>
    <section class="control-panel-container">
        <div class="container">
            <h3>Administrar...</h3>
            <div class="control-panel">
                <a href="phrases/phrases.php" class="admin-phrases">
                    <h4>Frases e Imagenes</h4>
                </a>
                <a href="" class="admin-users">
                    <h4>Usuarios</h4>
                </a>
                <a href="" class="admin-add">
                    <h4>Agregar administrador</h4>
                </a>
            </div>
        </div>
    </section>
</main>

<?php

include "../includes/templates/footer.php";

?>