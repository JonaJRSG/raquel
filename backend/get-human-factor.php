<?php
header('Content-Type: application/json');

// Conexión a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$database = "humanr";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Consulta SQL para obtener el último registro basado en el ID (ajusta el nombre de la columna de ID)
$sql = "SELECT D_final, I_final, S_final, C_final FROM human_factor_t ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No se encontraron datos"]);
}

$conn->close();
?>