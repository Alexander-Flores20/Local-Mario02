<?php
// config.php
define('DB_HOST', 'bmrvk3xgp69zcwarurmw-mysql.services.clever-cloud.com');
define('DB_USER', 'aumrahcddss0bezxd');
define('DB_PASS', 'rWMmeOyXnHjOLdBnujGf');
define('DB_NAME', 'DB-Nube');

// Crear conexión
function conectarDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    
    // Establecer charset
    $conn->set_charset("utf8");
    
    return $conn;
}
?>