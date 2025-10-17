<?php 
    require_once 'config.php';

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }
?>

<html>
    <body>
        <h1>Dashboard</h1>
        Bienvenido <strong><?php echo $_SESSION['username']; ?></strong>

        <a href="logout.php">Cerrar sesión</a>
    </body>
</html>