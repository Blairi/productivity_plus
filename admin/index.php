<?php

require "../includes/functions.php";
$auth = user_authenticated();
$auth_admin = admin_authenticated();

if(!$auth_admin || !$auth){
    header("Location: /");
}

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

include "../includes/templates/header.php";
?>

<main class="margin-top-bar admin">
    <h2 class="center-text">Bienvenido, <?php echo $_SESSION['username']; ?></h2>
    <section class="control-panel-container">
        <div class="container">
            <h3>Administrar...</h3>
            <div class="control-panel">
                <a href="phrases/phrases.php" class="admin-phrases">
                    <h4>Frases e Imagenes</h4>
                </a>
                <a href="users/users.php" class="admin-users">
                    <h4>Usuarios</h4>
                </a>
                <a href="add_admin.php" class="admin-add">
                    <h4>Agregar administrador</h4>
                </a>
            </div>
        </div>
    </section>
</main>

<?php

include "../includes/templates/footer.php";

?>