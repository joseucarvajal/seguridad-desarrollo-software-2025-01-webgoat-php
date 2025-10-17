<?php 
    require_once 'config.php';

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }

    if($_POST){
        $comment = $_POST['comment'];
        $username = $_SESSION['username'];
        $sql = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
        $conn->query($sql);
        $mensaje = "Comentario publicado correctamente";
    }

    $sql = "SELECT * FROM comments ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $comments = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; }
        h1 { text-align: center; }
        form { margin: 20px 0; }
        textarea { width: 100%; height: 100px; padding: 10px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .comment { border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9; }
        .comment-header { font-weight: bold; color: #333; margin-bottom: 5px; }
        .comment-date { font-size: 12px; color: #666; }
        .message { background: #d4edda; padding: 10px; margin: 10px 0; border-radius: 4px; }
        a { color: #007bff; text-decoration: none; }
    </style>

    </head>
    <body>
        <h1>💬 Comentarios</h1>
        Bienvenido <strong><?php echo $_SESSION['username']; ?></strong>

        <?php if(isset($mensaje)): ?>
            <div class="message"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <h2>Comenta el vuelo</h2>
        <form method="post">
            <textarea name="comment" placeholder="Escribe tu comentario"></textarea>
            <button type="submit">Comentar</button>
        </form>

        <h2>Comentarios Recientes</h2>
        <?php if(empty($comments)): ?>
            <p>No hay comentarios recientes. !Sé el primero en comentar!</p>
        <?php else: ?>
            <?php foreach($comments as $comment): ?>
                <div class="comment">
                    <div class="comment-header">
                    👤<?php echo $comment['username']; ?>
                        <span class="comment-date"><?php echo $comment['created_at']; ?></span>
                    </div>
                    <div class="comment-content">
                        <?php echo $comment['comment']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>