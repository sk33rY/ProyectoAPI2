<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('conexion.php');

// Realiza la consulta a la base de datos
$sql = "SELECT nombre, descripcion, lat, lng, tipo FROM mascotas";
$result = $conn->query($sql);

$mascotas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mascotas[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($mascotas);
?>
