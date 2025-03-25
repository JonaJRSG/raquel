<?php
// Conectar a la base de datos 'humanR'
$servername = "localhost";
$username = "root";
$password = "";
// Nombre para crear la base de datos
$dbname = "humanr";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Valores D
$unpopular_decisions = $_POST['unpopular_decisions']; // D 4 - Habilidad para tomar decisiones impopulares
$cope_with_interruptions = $_POST['cope_with_interruptions']; // D 1 - Capacidad para hacer frente a interrupciones y cambios
$unprecedented_decision = $_POST['unprecedented_decision']; // D 4 - Decisión para actuar sin precedentes
$overcome_objections = $_POST['overcome_objections']; // D 3 - Habilidad para superar objeciones
$creativity = $_POST['creativity']; // D 2 - Creatividad para generar nuevas ideas
$vision_large_scale = $_POST['vision_large_scale']; // D 4 - Visión para planear a futuro en gran escala
$resolve_conflicts = $_POST['resolve_conflicts']; // D 4 - Habilidad para resolver conflictos humanos

// Valores I
$organize_people_1 = $_POST['organize_people_1']; // I 3 - Habilidad para organizar diferentes tipos de gente
$initiate_relationships = $_POST['initiate_relationships']; // I 3 - Habilidad para iniciar relaciones con extraños
$persuade_others = $_POST['persuade_others']; // I 4 - Habilidad para persuadir a otros hacia nuestro punto de vista
$confidence_language = $_POST['confidence_language']; // I 5 - Seguridad y dominio del idioma para expresarse con fluidez

// Valores S
$persistence = $_POST['persistence']; // S 4 - Persistencia para trabajar en forma continua en trabajo de rutina
$remain_same_place = $_POST['remain_same_place']; // S 4 - Necesidad de permanecer en un mismo lugar de trabajo
$rhythm_repetitive_work = $_POST['rhythm_repetitive_work']; // S 4 - Ritmo y coordinación en trabajo repetitivo
$consistency = $_POST['consistency']; // S 3 - Constancia de seguir un patrón de trabajo establecido
$patience = $_POST['patience']; // S 2 - Paciencia para seguir instrucciones detalladas
$satisfaction = $_POST['satisfaction']; // S 5 - Satisfacción para mantener al nivel del puesto actual

// Valores C
$concentration = $_POST['concentration']; // C 5 - Concentración en trabajos de detalle
$diplomatic_cooperative = $_POST['diplomatic_cooperative']; // C 1 - Necesidad de ser diplomático y cooperativo
$cautious_calculate_risks = $_POST['cautious_calculate_risks']; // C 2 - Ser cauteloso al calcular riesgos
$motivational_power = $_POST['motivational_power']; // C 3 - Poder motivacional para hacer que la gente actúe
$follow_system = $_POST['follow_system']; // C 2 - Capacidad de seguir un sistema a la perfección
$boss_available = $_POST['boss_available']; // C 5 - Necesidad de tener al jefe disponible para ayudar
$cautious_decisions = $_POST['cautious_decisions']; // C 3 - Cauteloso en la toma de decisiones que pueden sentar precedente

// Suma de los valores para cada letra
$D_R = $unpopular_decisions + $cope_with_interruptions + $unprecedented_decision + $overcome_objections + $creativity + $vision_large_scale + $resolve_conflicts;
$I_R = $organize_people_1 + $initiate_relationships + $persuade_others + $confidence_language;
$S_R = $persistence + $remain_same_place + $rhythm_repetitive_work + $consistency + $patience + $satisfaction;
$C_R = $concentration + $diplomatic_cooperative + $cautious_calculate_risks + $motivational_power + $follow_system + $boss_available + $cautious_decisions;

// Suma total de todas las entradas
$R = $D_R + $I_R + $S_R + $C_R;

// Promedio de los totales de D, I, S, C
$average = ($D_R + $I_R + $S_R + $C_R) / 4;

// Ajuste personalizado para el promedio
$fraction = $average - floor($average); // Obtener la fracción decimal
if ($fraction == 0.25) {
    $A = floor($average); // Redondear hacia abajo si la fracción es 0.25
} elseif ($fraction == 0.75) {
    $A = ceil($average); // Redondear hacia arriba si la fracción es 0.75
} else {
    $A = round($average); // Dejarlo igual si es 0.5 o redondear según sea necesario
}

// Restar el promedio de cada total y redondear
$D_D = round($D_R - $A);
$I_D = round($I_R - $A);
$S_D = round($S_R - $A);
$C_D = round($C_R - $A);

// Asignar el valor correspondiente a la variable D% según el promedio
if ($A >= 12 && $A < 13) {
    $D_percent = 8;
} elseif ($A >= 13.5 && $A < 15) {
    $D_percent = 7;
} elseif ($A >= 15.5 && $A < 17.5) {
    $D_percent = 6;
} elseif ($A >= 18 && $A <= 18.5) {
    $D_percent = 5.5;
} elseif ($A >= 19 && $A < 21.5) {
    $D_percent = 5;
} elseif ($A >= 22 && $A < 23) {
    $D_percent = 4.5;
} elseif ($A >= 23.5 && $A <= 26.5) {
    $D_percent = 4;
} elseif ($A >= 27 && $A < 28) {
    $D_percent = 3.5;
} else {
    $D_percent = 0; // Si el promedio no entra en ninguno de los rangos
}

// Multiplicar las variables ajustadas por D_percent y almacenar en nuevas variables
$D_final = $D_D * $D_percent;
$I_final = $I_D * $D_percent;
$S_final = $S_D * $D_percent;
$C_final = $C_D * $D_percent;

// Sumar o restar 50 dependiendo de si el valor es positivo o negativo
if ($D_final >= 0) {
    $D_final = $D_final + 50; // Si es positivo o 0, sumamos 50
} else {
    $D_final = $D_final + 50; // Si es negativo, restamos 50
}

if ($I_final >= 0) {
    $I_final = $I_final + 50; // Si es positivo o 0, sumamos 50
} else {
    $I_final = $I_final + 50; // Si es negativo, restamos 50
}

if ($S_final >= 0) {
    $S_final = $S_final + 50; // Si es positivo o 0, sumamos 50
} else {
    $S_final = $S_final + 50; // Si es negativo, restamos 50
}

if ($C_final >= 0) {
    $C_final = $C_final + 50; // Si es positivo o 0, sumamos 50
} else {
    $C_final = $C_final + 50; // Si es negativo, restamos 50
}

// Definir la consulta SQL para insertar los datos en la tabla 'human_factor'
// CREATE TABLE human_factor_t (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     D_R INT,
//     I_R INT,
//     S_R INT,
//     C_R INT,
//     R INT,
//     A INT,
//     D_D INT,
//     I_D INT,
//     S_D INT,
//     C_D INT,
//     D_percent INT,
//     D_final INT,
//     I_final INT,
//     S_final INT,
//     C_final INT
// );


// Definir la consulta SQL para insertar los datos en la tabla 'human_factor'
// CREATE TABLE human_factor (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     concentration INT,
//     unpopular_decisions INT,
//     persistence INT,
//     organize_people_1 INT,
//     diplomatic_cooperative INT,
//     unprecedented_decision INT,
//     creativity INT,
//     initiate_relationships INT,
//     consistency INT,
//     boss_available INT,
//     confidence_language INT,
//     follow_system INT,
//     resolve_conflicts INT,
//     remain_same_place INT,
//     rhythm_repetitive_work INT,
//     cope_with_interruptions INT,
//     cautious_calculate_risks INT,
//     motivational_power INT,
//     overcome_objections INT,
//     vision_large_scale INT,
//     persuade_others INT,
//     cautious_decisions INT,
//     patience INT,
//     satisfaction INT
// );

// SQL query para insertar los datos en la tabla
$sql = "INSERT INTO human_factor (
    concentration, unpopular_decisions, persistence, organize_people_1, diplomatic_cooperative, 
    unprecedented_decision, creativity, initiate_relationships, consistency, boss_available, 
    confidence_language, follow_system, resolve_conflicts, remain_same_place, rhythm_repetitive_work, 
    cope_with_interruptions, cautious_calculate_risks, motivational_power, overcome_objections, 
    vision_large_scale, persuade_others, cautious_decisions, patience, satisfaction
) VALUES (
    '$concentration', '$unpopular_decisions', '$persistence', '$organize_people_1', '$diplomatic_cooperative',
    '$unprecedented_decision', '$creativity', '$initiate_relationships', '$consistency', '$boss_available',
    '$confidence_language', '$follow_system', '$resolve_conflicts', '$remain_same_place', '$rhythm_repetitive_work',
    '$cope_with_interruptions', '$cautious_calculate_risks', '$motivational_power', '$overcome_objections',
    '$vision_large_scale', '$persuade_others', '$cautious_decisions', '$patience', '$satisfaction'
)";

// Ejecutar la consulta
if ($conn->query($sql) !== TRUE) {
    echo "<script type='text/javascript'>alert('Data inserted Failed. Try again.');</script>";
    echo "<script type='text/javascript'>window.location.href = '../human-factor.html';</script>";
}

// SQL query para insertar los datos en la tabla
$sql = "INSERT INTO human_factor_t (
    D_R, I_R, S_R, C_R, R, A, 
    D_D, I_D, S_D, C_D, 
    D_percent, 
    D_final, I_final, S_final, C_final
) VALUES (
    '$D_R', '$I_R', '$S_R', '$C_R', '$R', '$A', 
    '$D_D', '$I_D', '$S_D', '$C_D', 
    '$D_percent', 
    '$D_final', '$I_final', '$S_final', '$C_final'
)";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('Data inserted successfully');</script>";
    echo "<script type='text/javascript'>window.location.href = '../human-factor.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
