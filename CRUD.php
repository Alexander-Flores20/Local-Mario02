<?php
// crud.php
require_once 'config.php';

header('Content-Type: application/json');

$conn = conectarDB();

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Leer productos
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $result = $conn->query($sql);
        $productos = [];
        
        while($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        
        echo json_encode($productos);
        break;

    case 'POST':
        // Crear producto
        $data = json_decode(file_get_contents('php://input'), true);
        
        $nombre = $conn->real_escape_string($data['nombre']);
        $precio = floatval($data['precio']);
        
        $sql = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', $precio)";
        
        if($conn->query($sql)) {
            echo json_encode(['id' => $conn->insert_id, 'mensaje' => 'Producto creado']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al crear producto']);
        }
        break;

    case 'PUT':
        // Actualizar producto
        $data = json_decode(file_get_contents('php://input'), true);
        
        $id = intval($data['id']);
        $nombre = $conn->real_escape_string($data['nombre']);
        $precio = floatval($data['precio']);
        
        $sql = "UPDATE productos SET nombre='$nombre', precio=$precio WHERE id=$id";
        
        if($conn->query($sql)) {
            echo json_encode(['mensaje' => 'Producto actualizado']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al actualizar producto']);
        }
        break;

    case 'DELETE':
        // Eliminar producto
        $id = intval($_GET['id']);
        
        $sql = "DELETE FROM productos WHERE id=$id";
        
        if($conn->query($sql)) {
            echo json_encode(['mensaje' => 'Producto eliminado']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Error al eliminar producto']);
        }
        break;
}

$conn->close();
?>