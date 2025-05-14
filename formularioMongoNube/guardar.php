<?php
require 'vendor/autoload.php'; // Cargar la librería de MongoDB

// URI de conexión a MongoDB Atlas
$uri = "mongodb+srv://Marcos:marcos@nube.bgr4eu8.mongodb.net/?retryWrites=true&w=majority&appName=nube";

// Crear cliente MongoDB
$cliente = new MongoDB\Client($uri);

// Seleccionar la base y la colección
$coleccion = $cliente->formulario_db->usuarios;

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$edad = (int)$_POST['edad'];
$direccion = $_POST['direccion'];

// Insertar en MongoDB Atlas
$resultado = $coleccion->insertOne([
    'nombre' => $nombre,
    'email' => $email,
    'edad' => $edad,
    'direccion' => $direccion
]);

if ($resultado->getInsertedCount() === 1) {
    echo "<p>✅ Datos guardados correctamente en la nube.</p><p>ID: " . $resultado->getInsertedId() . "</p>";
} else {
    echo "❌ Error al guardar los datos.";
}
?>
