<?php
session_start();
require_once '../lib/funciones.php'; #Importamos la librería
$conexion = conectarBD(); #Usamos la función para ahorrarnos código de la biblioteca de funciones creada.

// Recogemos los datos del POST
$nom = $_POST['nombre'];
$desc = $_POST['descripcion'];
$talla = $_POST['talla'];
$preu = $_POST['precio'];
$stock = $_POST['stock'];

// Consulta SQL para insertar los datos pasados desde el formulario de home
$sql = "INSERT INTO productos (nombre, descripcion, talla, precio, stock) 
        VALUES ('$nom', '$desc', '$talla', $preu, $stock)";

if (mysqli_query($conexion, $sql)) {
    // Si funciona, volvemos al home para ver el nuevo producto en la tabla
    header("Location: ../home.php");
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>