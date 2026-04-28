<?php
session_start();

require_once "../lib/funciones.php"; #Importamos la librería
$conexion = conectarBD(); #Usamos la función para ahorrarnos código de la biblioteca de funciones creada.

// 2. Recoger datos del formulario
$user = $_POST['usuario'];
$pass = $_POST['password'];

// 3. Consulta "a la antigua"
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$user' AND password = '$pass'";
$resultado = mysqli_query($conexion, $sql);

// 4. Comprobar si hay alguna fila que coincida
if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['usuario'] = $user; #Estamos guardando el nombre de usuario del usuario en una variable global, que siempre que esté la sesión iniciada, podremos leerla.
    header("Location: ../home.php");
} else {
    header("Location: ../index.php?error=1");
}
?>
