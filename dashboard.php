<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<html>
    <body>
        <h1>Dashboard</h1>
        <p>Bienvenido, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
        <p>Session ID: <?php echo session_id(); ?></p>
        
        <a href="logout.php">Cerrar Sesión</a>
    </body>
</html>