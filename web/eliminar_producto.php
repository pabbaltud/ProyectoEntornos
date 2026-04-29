<?php
session_start();

// Seguridad: Solo si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// 1. Conexión a la base de datos
require_once 'lib/funciones.php';
$conexion = conectarBD();

// 2. Recogemos el ID que viaja por la URL (ej: eliminar.php?id=5)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 3. Consulta SQL para borrar el registro (Punto e)
    $sql = "DELETE FROM productos WHERE id = $id";

    if (mysqli_query($conexion, $sql)) {
        // Si sale bien, volvemos al home con un mensaje de éxito
        header("Location: home.php?msg=eliminado");
        exit();
    } else {
        echo "Error al eliminar: " . mysqli_error($conexion);
    }
} else {
    // Si alguien entra en eliminar.php sin pasar un ID, lo mandamos al home
    header("Location: home.php");
    exit();
}
?>
