<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

$cliente = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la base y la colección
$coleccion = $cliente->formulario_db->usuarios;

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$edad = (int)$_POST['edad'];
$direccion = $_POST['direccion'];

// Insertar en MongoDB
$resultado = $coleccion->insertOne([
    'nombre' => $nombre,
    'email' => $email,
    'edad' => $edad,
    'direccion' => $direccion
]);

if ($resultado->getInsertedCount() === 1) {
    echo "<p>✅ Datos guardados correctamente.</p><p>ID: " . $resultado->getInsertedId() . "</p>";
} else {
    echo "❌ Error al guardar los datos.";
}
?>
