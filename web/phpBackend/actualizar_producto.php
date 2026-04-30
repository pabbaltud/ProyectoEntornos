<?php
require_once "../lib/funciones.php"; #Importamos la librería
$conexion = conectarBD(); #Usamos la función para ahorrarnos código de la biblioteca de funciones creada.

// Recogemos los datos del formulario
$id = $_POST['id'];
$nom = $_POST['nombre'];
$talla = $_POST['talla'];
$preu = $_POST['precio'];

// Consulta SQL para actualizar
$sql = "UPDATE productos SET 
        nombre = '$nom', 
        talla = '$talla', 
        precio = $preu 
        WHERE id = $id";

if (mysqli_query($conexion, $sql)) {
    header("Location: ../home.php");
} else {
    echo "Error en l'actualització: " . mysqli_error($conexion);
}
?>
