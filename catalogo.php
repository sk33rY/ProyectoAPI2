<?php
include('conexion.php');

$sql = "SELECT nombre, descripcion, raza, tamano, color, sexo, imagen, lat, lng, tipo FROM mascotas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Mascotas</title>
    <!-- Incluir Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .catalogo {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .mascota {
            border: 1px solid #ccc;
            padding: 20px;
            width: 250px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .mascota img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Catálogo de Mascotas</h1>

    <div class="catalogo">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="mascota bg-white">';
                echo '<h3>' . $row["nombre"] . '</h3>';
                echo '<p><strong>Raza:</strong> ' . $row["raza"] . '</p>';
                echo '<p><strong>Tamaño:</strong> ' . $row["tamano"] . '</p>';
                echo '<p><strong>Color:</strong> ' . $row["color"] . '</p>';
                echo '<p><strong>Sexo:</strong> ' . $row["sexo"] . '</p>';
                echo '<p><strong>Descripción:</strong> ' . $row["descripcion"] . '</p>';
                echo '<p><strong>Estado:</strong> ' . $row["tipo"] . '</p>';
                if ($row["imagen"]) {
                    echo '<img src="data:image/jpeg;base64,' . $row["imagen"] . '" alt="Imagen de ' . $row["nombre"] . '">';
                } else {
                    echo '<p>Sin imagen disponible</p>';
                }
                echo '</div>';
            }
        } else {
            echo "<p>No hay mascotas registradas.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
