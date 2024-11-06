<?php
session_start();  // Correctamente iniciar sesión

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// Validar si los campos están vacíos
if (empty($correo) || empty($contraseña)) {
    echo json_encode(['success' => false, 'message' => 'Por favor, complete todos los campos']);
    exit();
}

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'DiagnosticoDiabetes');
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Consulta preparada para evitar inyección SQL
$query = "SELECT id, nombre, apellido, edad, genero, correo, contraseña FROM pacientes WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $correo);  
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verificar la contraseña usando password_verify
    if ($contraseña === $row['contraseña']) {
        // Iniciar sesión y almacenar los datos del usuario en la sesión
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellido'] = $row['apellido'];
        $_SESSION['edad'] = $row['edad'];
        $_SESSION['genero'] = $row['genero'];
        $_SESSION['correo'] = $row['correo'];

        // Respuesta exitosa en JSON
        echo json_encode(['success' => true]);
        header("Location: index.php");
    } else {
        // Contraseña incorrecta
        echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
    }
} else {
    // Usuario no encontrado
    echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
