<?php
session_start();

#Este condicional comprueba si tiene algo (el nombre de usuario del usuario), por lo tanto, eso nos indicia que si ha cruazo el inicio de sesión . 
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$nombreUsuario = $_SESSION['usuario'];


// 1. Conexión a la base de datos
require_once "lib/funciones.php"; #Importamos la librería
$conexion = conectarBD(); #Usamos la función para ahorrarnos código de la biblioteca de funciones creada.

// 2. Consulta para obtener todos los productos
$sql = "SELECT * FROM productos";
$resultado = mysqli_query($conexion, $sql);

 # -------------------------- HTML ------------------------------------------

?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sesión Iniciada</title>
    <link rel="stylesheet" href="./css/estilo.css">

    </head>

    <body>

    <header>
        <h1>Bienvenido/a, <?php echo $_SESSION['usuario']; ?></h1>
        <a href="./phpBackend/logout.php">Cerrar Sesión</a>
    </header>

    <main>
        <!-- SECCIÓN 1: Menú desplegable dinámico -->
        <section>
            <h3>Selecciona un producte (Menú desplegable)</h3>
            <select name="productes_lista">
                <option value="">-- Elige un producto --</option>

                <?php
                mysqli_data_seek($resultado, 0); 
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='{$fila['id']}'>{$fila['nombre']} - {$fila['talla']}</option>";
                }
                ?>

            </select>
        </section>

        <br><hr><br>

        <!-- SECCIÓN 2: Tabla con registros de la base de datos -->
        <section>
            <h3>Llistat complet de productes</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Talla</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Volvemos a recorrer el resultado para la tabla
                    mysqli_data_seek($resultado, 0); 
                    while ($producto = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>" . $producto['id'] . "</td>";
                        echo "<td>" . $producto['nombre'] . "</td>";
                        echo "<td>" . $producto['talla'] . "</td>";
                        echo "<td>" . $producto['precio'] . "€</td>";
                        echo "<td>" . $producto['stock'] . "</td>";
                        echo "<td>";

                    if ($nombreUsuario == "admin") {
                            echo "<a href='editar_producto.php?id={$producto['id']}'>Editar</a> | ";
                            echo "<a href='eliminar_producto.php?id={$producto['id']}' onclick=\"return confirm('Estás seguro?')\">Eliminar</a>";
                        }
                    }
                    ?>

                    
                </tbody>
            </table>
        </section>
    </main>
    
<?php 
# ------------------------ PRIVILEGIOS DEL ADMIN -----------------------------
if ($nombreUsuario == "admin"){
?>
    <br><hr><br>
    <h1>Privilegios del administrador</h1>

     <h2>Añadir un nuevo producto</h2>
        <form action="./phpBackend/insertar_producto.php" method="POST">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" required>

            <label>Descripción:</label>
            <textarea name="descripcion"></textarea>

            <label>Talla:</label>
            <select name="talla">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>

            <label>Precio:</label>
            <input type="number" name="precio" required>

            <label>Stock:</label>
            <input type="number" name="stock" required>

            <button type="submit">Guardar Producte</button>
        </form>

<?php
}
# ------------------------ RESTO DEL HTML ------------------------------------
?>

    </body>
</html>