



<footer class="principal-footer">
        <div class="container">
            <div class="center-text">
                <a href="/"><h3>Productivity +</h3></a>
            </div>
            <div class="center-text">
                <a href="/">Inicio</a>
                <?php

                if($auth && !$auth_admin):?>
                    
                <a href="/home.php">Mis tareas</a>

                <?php endif; ?>


                <?php

                if($auth && $auth_admin):?>
                    
                <a href="/admin/">Administrar</a>

                <?php endif; ?>
            </div>
        </div>
        <p class="center-text">Productivity + &copy; Todos los derechos reservados. 2022</p>
    </footer>
    <script src="/build/js/bundle.js"></script>
</body>
</html>