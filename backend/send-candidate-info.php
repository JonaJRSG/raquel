<?php
// Configuración de la base de datos
$host = "localhost"; // Servidor de MySQL
$user = "root"; // Usuario de MySQL
$password = ""; // Contraseña de MySQL (déjala vacía si usas XAMPP)
$dbname = "humanr"; // Nombre de la base de datos

// Crear conexión con MySQL
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Error de conexión: " . $conn->connect_error]));
}

// Leer los datos enviados desde JavaScript (usando `axios`)
$data = json_decode(file_get_contents("php://input"), true);

// Verificar que los datos no estén vacíos
if (!$data) {
    echo json_encode(["status" => "error", "message" => "No se recibieron datos"]);
    exit;
}

// Extraer los valores
$name_candidate = $data['name'] ?? null;
$city = $data['city'] ?? null;
$identification = $data['identification'] ?? null;

// Convertir a enteros los valores numéricos
$D_M = isset($data['D_M']) ? intval($data['D_M']) : null;
$D_L = isset($data['D_L']) ? intval($data['D_L']) : null;
$I_M = isset($data['I_M']) ? intval($data['I_M']) : null;
$I_L = isset($data['I_L']) ? intval($data['I_L']) : null;
$S_M = isset($data['S_M']) ? intval($data['S_M']) : null;
$S_L = isset($data['S_L']) ? intval($data['S_L']) : null;
$C_M = isset($data['C_M']) ? intval($data['C_M']) : null;
$C_L = isset($data['C_L']) ? intval($data['C_L']) : null;
$D = isset($data['D']) ? intval($data['D']) : null;
$I = isset($data['I']) ? intval($data['I']) : null;
$S = isset($data['S']) ? intval($data['S']) : null;
$C = isset($data['C']) ? intval($data['C']) : null;

// Table
// CREATE TABLE candidates (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     city VARCHAR(100) NOT NULL,
//     identification VARCHAR(50) NOT NULL,
//     D_M INT,
//     D_L INT,
//     I_M INT,
//     I_L INT,
//     S_M INT,
//     S_L INT,
//     C_M INT,
//     C_L INT,
//     D INT,
//     I INT,
//     S INT,
//     C INT,
//     fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );

// Insertar los datos en la base de datos
$sql = "INSERT INTO candidates (name, city, identification, D_M, D_L, I_M, I_L, S_M, S_L, C_M, C_L, D, I, S, C) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiiiiiiiiiiii", $name_candidate, $city, $identification, $D_M, $D_L, $I_M, $I_L, $S_M, $S_L, $C_M, $C_L, $D, $I, $S, $C);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Datos guardados correctamente"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al guardar los datos: " . $stmt->error]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>