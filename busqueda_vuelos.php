<?php
// Include database configuration
require_once 'config.php';

// Initialize variables
$search_term = '';
$flights = [];
$error_message = '';

// Check if form was submitted
if (isset($_POST['search_term'])) {
    $search_term = $_POST['search_term'];
    
    try {
        // VULNERABLE SQL QUERY - Direct concatenation without prepared statements
        // This allows SQL injection attacks
        $sql = "SELECT * FROM flights WHERE departure_station LIKE '%$search_term%'";

        echo $sql;
        
        // Execute the vulnerable query
        $result = $conn->query($sql);
        $flights = $result->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        $error_message = "Error en la consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Búsqueda de Vuelos</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; }
        h1 { text-align: center; }
        form { margin: 20px 0; }
        input, button { padding: 8px; margin: 5px; }
        input { width: 300px; }
        button { background: #007bff; color: white; border: none; cursor: pointer; }
        .flight { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Búsqueda de Vuelos</h1>
        <form method="POST">
        <label>Ciudad de Origen:</label><br>
        <input type="text" name="search_term" value="<?php echo $search_term; ?>" placeholder="Ej: Madrid" required>
        <button type="submit">Buscar</button>
    </form>
        
    <?php if (!empty($flights)): ?>
        <h2>Resultados (<?php echo count($flights); ?> vuelos):</h2>
        <?php foreach ($flights as $flight): ?>
            <div class="flight">
                <strong>Origen:</strong> <?php echo $flight['departure_station']; ?> |
                <strong>Destino:</strong> <?php echo $flight['arrival_station']; ?> |
                <strong>Fecha:</strong> <?php echo $flight['flight_date']; ?> |
                <strong>Hora:</strong> <?php echo $flight['flight_time']; ?>
            </div>
        <?php endforeach; ?>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No se encontraron vuelos para: <strong><?php echo $search_term; ?></strong></p>
    <?php endif; ?>    
</body>
</html>
