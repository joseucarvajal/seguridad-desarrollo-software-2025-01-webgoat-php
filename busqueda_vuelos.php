<?php
    require_once 'config.php';
    $search_term = '';
    $flights = [];

    if($_POST){
        $search_term = $_POST['search_term'];
        $sql = "SELECT * FROM flights WHERE departure_station LIKE '%$search_term%'";
        $result = $conn->query($sql);
        $flights = $result->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Búsqueda de vuelos</title>
        <style>
            body {font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; padding: 20px;}
            h1 { text-align: center; }
            form { margin: 20px 0; }
            input, button { padding: 8px; margin: 5px; }
            input { width: 300px; }
            button { background: #007dff; color: white; border: none; padding: 10px; margin: 10px 0;}
            .flight { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <h1>Búsqueda de vuelos</h1>
        <form method="POST">
            <label>Ciudad de origen:</label>
            <input type="text" name="search_term" value="<?php echo $search_term; ?>" placeholder="Ej: Madrid">
            <button type="submit">Buscar</button>
        </form>

        <?php if(!empty($flights)): ?>
            <h2>Resultados (<?php echo count($flights); ?> vuelos encontrados:)</h2>
            <?php foreach($flights as $flight): ?>
                <div class="flight">
                    <strong>Origen:</strong> <?php echo $flight['departure_station']; ?>
                    <strong>Destino:</strong> <?php echo $flight['arrival_station']; ?>
                    <strong>Fecha:</strong> <?php echo $flight['flight_date']; ?>
                    <strong>Hora:</strong> <?php echo $flight['flight_time']; ?>
                </div>
            <?php endforeach; ?>
        <?php elseif ($_POST): ?>
            <p>No se encontraron vuelos para la ciudad de origen:  <strong><?php echo $search_term; ?></strong></p>
        <?php else: ?>
            <p>Por favor, ingrese una ciudad de origen para buscar vuelos.</p>
        <?php endif; ?>
    </body>
</html>