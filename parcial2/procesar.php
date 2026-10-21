<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedido recibido - Salteñeria El Horno</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <header>
    <h1>Pedido recibido en Salteñeria El Horno</h1>
  </header>

  <main>
    <section class="tarjeta">
<?php
// Guarda el nombre y recibimos el formulario 
$nombre = htmlspecialchars($_POST["nombre"] ?? "");
$correo = htmlspecialchars($_POST["correo"] ?? "");
$pedido = htmlspecialchars($_POST["pedido"] ?? "");

if ($pedido === "") {
  $pedido = "No indicó pedido";
}
echo "<h2>Datos del cliente</h2>";
echo "<p><strong>Nombre:</strong> $nombre</p>";
echo "<p><strong>Correo:</strong> $correo</p>";
echo "<p><strong>Pedido:</strong> $pedido</p>";
// Lista de productos y sus precios
$carta = [
  "Salteña de pollo"        => "Bs 6",
  "Docena de salteñas"      => "Bs 65",
  "Refresco de mocochinchi" => "Bs 5"
];

echo "<h2>Nuestra carta</h2>";
echo "<table>";
echo "<tr><th>Producto</th><th>Precio</th></tr>";
foreach ($carta as $producto => $precio) {
  echo "<tr><td>$producto</td><td>$precio</td></tr>";
}
echo "</table>";

echo "<p class=\"atiende\">Te atiende Juan David Copa Gutierrez</p>";

?>
      <p><a href="index.html">Volver al formulario</a></p>
    </section>
  </main>

  <footer>
    <p>Juan David Copa Gutierrez - FECHA 20 de octubre del  2026</p>
  </footer

</body>
</html>
