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
