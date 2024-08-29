<?php
include('conexion.php');

// Recuperar y escapar las variables
$nombre = $conn->real_escape_string($_POST['nombre']);
$descripcion = $conn->real_escape_string($_POST['descripcion']);
$raza = $conn->real_escape_string($_POST['raza']);
$tamano = $conn->real_escape_string($_POST['tamano']); 
$color = $conn->real_escape_string($_POST['color']);
$sexo = $conn->real_escape_string($_POST['sexo']);
$lat = isset($_POST['lat']) ? floatval($_POST['lat']) : 0.0;
$lng = isset($_POST['lng']) ? floatval($_POST['lng']) : 0.0;
$tipo = $conn->real_escape_string($_POST['tipo']);
$tipo_animal = $conn->real_escape_string($_POST['tipo_animal']);

// Manejo de la imagen
$imagen = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $fileInfo = getimagesize($_FILES['imagen']['tmp_name']);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (in_array($fileInfo['mime'], $allowedTypes)) {
        $imagen = base64_encode(file_get_contents($_FILES['imagen']['tmp_name']));
    } else {
        die("Error: Solo se permiten imágenes en formato JPEG, PNG o GIF.");
    }
}

// Construir la consulta SQL
$sql = "INSERT INTO mascotas (nombre, descripcion, raza, tamano, color, sexo, tipo_animal, imagen, lat, lng, tipo, fecha_registro) 
        VALUES ('$nombre', '$descripcion', '$raza', '$tamano', '$color', '$sexo', '$tipo_animal', '$imagen', $lat, $lng, '$tipo', CURRENT_TIMESTAMP())";

// Verificar el SQL generado
echo "<pre>SQL: $sql</pre>";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro creado con éxito";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
