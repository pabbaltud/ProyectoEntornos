<?php
session_start();
require_once 'lib/funciones.php';

if(isset($_SESSION['usuario'])) {
    header("Location: home.php");
    exit();
}

if (isset($_GET['registrado']) && $_GET['registrado'] == '1') {
    echo '<p style="color: green; font-weight: bold; background: #eaffea; padding: 10px; border: 1px solid green;">';
    echo '¡Registro completado con éxito! Ya puedes iniciar sessión.';
    echo '</p>';
}

if (isset($_GET['error'])) {
    echo '<p style="color: red; font-weight: bold; background: #ffeaea; padding: 10px; border: 1px solid red;">';
    
    if ($_GET['error'] == 'duplicado') {
        echo 'Aquest usuari ja existeix.';
    } else {
        echo 'El usuario o la contraseña son incorrectos / El usuario no existe.';
    }
    echo '</p>';
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Registro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <div class="login-box">
        <h2>Inici de Sessió</h2>
        
        <!-- El formulario envía los datos a login_valida.php mediante POST -->
        <form action="./phpBackend/validacion.php" method="POST">
            <div class="input-group">
                <label for="usuario">Usuari:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <?php #IMPRIMIMOS el error que nos ha dado "Validación.php"
        if (isset($_GET['error'])) {
            echo '<p class="error-msg">L\'usuari o la contrasenya són incorrectes.</p>';
        }
        ?>
    </div>
    
        <br><hr><br>


    <div class="register-box" >
    <h2>Registra't</h2>
    <form action="./phpBackend/registro.php" method="POST">
        <div class="input-group">
            <label for="reg_usuari">Nou Usuari:</label>
            <input type="text" id="reg_usuario" name="reg_usuario" required>
        </div>

        <div class="input-group">
            <label for="reg_password">Contraseña:</label>
            <input type="password" id="reg_password" name="reg_password" required>
        </div>

        <button type="submit" class="btn-reg">Crear Compte</button>
    </form>
</div>

</body>
</html>