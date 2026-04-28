<?php
// 1. Conexión

require_once '../lib/funciones.php'; #Importamos la librería
$conexion = conectarBD(); #Usamos la función para ahorrarnos código de la biblioteca de funciones creada.

// 2. Recoger datos
$nuevo_user = $_POST['reg_usuario']; 
$nuevo_pass = $_POST['reg_password'];

// 3. Intentar insertar con TRY-CATCH para capturar el error de duplicado
try {
    $sql = "INSERT INTO usuarios (nombre_usuario, password) VALUES ('$nuevo_user', '$nuevo_pass')";
    
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../index.php?registrado=1");
        exit();
    }
    
} catch (mysqli_sql_exception $e) {
    // Si entramos aquí, es porque MySQL ha lanzado el error de duplicado
    // El código 1062 es específicamente para "Entrada duplicada"
    if ($e->getCode() == 1062) {
        header("Location: ../index.php?error=duplicado");
    } else {
        header("Location: index.php?error=otro");
    }
    exit();
}
?>
