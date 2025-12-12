<nav class="navbar">
    <div class="navbar-container">
        
        <div class="navbar-brand">
            <a href="menu.php">Registro de Cursos</a>
            <span class="navbar-welcome">
                ¡Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!
            </span>
        </div>

        <div class="navbar-links">
            <a href="../index.php" class="navbar-link">Home</a>
            <a href="perfil.php" class="navbar-link">Mi Perfil</a>
            <a href="cursosApp/wallet.php" class="navbar-link">Mi wallet</a>
            <a href="../logout.php" class="navbar-logout">Cerrar Sesión</a>
        </div>

    </div>
</nav>

