<?php 
    require_once 'config.php';

    $mensaje = "";
    if($_POST){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        if($user){
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
        }else{
            $mensaje = "Login fallido";
        }
    }
?>
<html>
    <body>
        <h1><?php echo $mensaje; ?></h1>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Login">
        </form>
    </body>
</html>