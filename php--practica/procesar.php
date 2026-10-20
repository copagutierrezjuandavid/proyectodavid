<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensaje Recibido - Lavado de Autos Apaza</title>
  <link rel="stylesheet" href="styles.css">
  <script>
   // Mantenemos el tema que eligio el usuario
    try {
      if (localStorage.getItem("tema-apaza") === "oscuro") {
        document.documentElement.setAttribute("data-tema", "oscuro");
      }
    } catch (error) {
   // Si ocurre un error usamos el tema claro
    }
  </script>
</head>
<body>

  <header>
    <p class="marca">Lavado de Autos Apaza</p>
  </header>

  <main>
    <section class="tarjeta">
<?php
// Guardar los datos del formulario 
$nombre   = $_POST["nombre"];
$correo   = $_POST["correo"];
$telefono = $_POST["telefono"];
$servicio = $_POST["servicio"];
$mensaje  = $_POST["mensaje"];

// Mostramos la informacion que envio el usuario 
echo "<h2>Mensaje recibido</h2>";
echo "<p>Nombre: $nombre</p>";
echo "<p>Correo: $correo</p>";
echo "<p>Teléfono: $telefono</p>";
echo "<p>Servicio: $servicio</p>";
echo "<p>Mensaje: $mensaje</p>";
?>
      <p><a href="index.html#contacto">Volver al formulario</a></p>
    </section>
  </main>

  <footer>
    <p>&copy; 2026 Lavado de Autos Apaza. Todos los derechos de Juan David Copa Gutierrez</p>
  </footer>

</body>
</html>