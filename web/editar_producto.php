<?php
session_start();
require_once 'lib/funciones.php'; #Importamos la librería
$conexion = conectarBD(); #Usamos la función para ahorrarnos código de la biblioteca de funciones creada.

// 1. Pillamos el ID que viene por la URL
$id = $_GET['id'];

// 2. Buscamos los datos actuales de ese producto
$sql = "SELECT * FROM productos WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);
$p = mysqli_fetch_assoc($resultado); #Conjunto de los datos a actualizar
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Editar Producte</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="form-container">
        <h2>Editar Producte: <?php echo $p['nombre']; ?></h2>
        
        <form action="./phpBackend/actualizar_producto.php" method="POST">
            <!-- Campo oculto para enviar el ID sin que el usuario lo vea -->
            <input type="hidden" name="id" value="<?php echo $p['id']; ?>">

            <label>Nom:</label>
            <input type="text" name="nombre" value="<?php echo $p['nombre']; ?>" required>

            <label>Talla:</label>
            <input type="text" name="talla" value="<?php echo $p['talla']; ?>">

            <label>Preu:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $p['precio']; ?>" required>

            <button type="submit">Actualizar Cambios</button>
            <a href="home.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
