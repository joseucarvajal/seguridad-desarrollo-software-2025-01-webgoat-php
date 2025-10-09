<?php
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $username = $_SESSION['username'];
    $comment = $_POST['comment'];
    
    try {
        // VULNERABLE: Direct insertion without sanitization
        $sql = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
        $conn->exec($sql);
        $message = "Comentario agregado exitosamente!";
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

// Get all comments
try {
    $sql = "SELECT * FROM comments ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $comments = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $comments = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comentarios</title>
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
    
    <p>Bienvenido: <strong><?php echo $_SESSION['username']; ?></strong></p>
    
    <a href="dashboard.php">← Volver al Dashboard</a>
    
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <h2>Agregar Comentario</h2>
    <form method="POST">
        <textarea name="comment" placeholder="Escribe tu comentario aquí..." required></textarea><br>
        <button type="submit">Publicar Comentario</button>
    </form>
    
    <h2>Comentarios Recientes</h2>
    <?php if (empty($comments)): ?>
        <p>No hay comentarios aún. ¡Sé el primero en comentar!</p>
    <?php else: ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment-header">
                    👤 <?php echo $comment['username']; ?>
                    <span class="comment-date">- <?php echo $comment['created_at']; ?></span>
                </div>
                <div class="comment-content">
                    <?php echo $comment['comment']; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>    
</body>
</html>
