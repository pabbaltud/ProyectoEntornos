<?php
// 1. Siempre debemos abrir la sesión para poder manipularla
session_start();

// 2. Vaciamos todas las variables de la sesión (limpiamos la "mochila")
$_SESSION = array();

// 3. Destruimos la sesión en el servidor por completo
session_destroy();

// 4. Redirigimos al usuario al login
header("Location: ../index.php");
exit();
?>

