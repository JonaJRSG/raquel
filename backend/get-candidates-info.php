<?php
// Configuración de la base de datos
$host = "localhost"; 
$user = "root"; 
$password = ""; 
$dbname = "humanr"; 

// Crear conexión con MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error]));
}

// Consulta para obtener los datos de la tabla 'candidates'
$sql = "SELECT * FROM candidates";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Crear un array para almacenar los datos
    $candidates = [];
    
    // Recorrer los resultados y agregar cada fila al array
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }

    // Devolver los datos como JSON
    echo json_encode(["status" => "success", "data" => $candidates]);
} else {
    echo json_encode(["status" => "error", "message" => "No se encontraron candidatos"]);
}

// Cerrar la conexión
$conn->close();
?>