<?php 
session_start();

// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'DiagnosticoDiabetes';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener los datos del formulario
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$correo = trim($_POST['correo']);
$edad = $_POST['edad'];
$genero = $_POST['genero'];
$contraseña = $_POST['contraseña'];

// Validación de campos
if (empty($nombre) || empty($apellido) || empty($correo) || empty($edad) || empty($genero) || empty($contraseña)) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: registro.php");
    exit;
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "El correo electrónico no es válido.";
    header("Location: registro.php");
    exit;
}

if (!is_numeric($edad) || $edad <= 0) {
    $_SESSION['error'] = "La edad debe ser un número válido mayor que cero.";
    header("Location: registro.php");
    exit;
}

// Verificar si el correo ya está registrado
$sql = "SELECT id FROM Pacientes WHERE correo = :correo";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $_SESSION['error'] = "El correo electrónico ya está registrado. Por favor, usa otro.";
    header("Location: registro.php");
    exit;
}

// **Guardar la contraseña como texto claro**
$contraseñaTextoClaro = $contraseña;  // No se aplica ninguna encriptación

// Insertar el nuevo paciente en la base de datos
$sql = "INSERT INTO Pacientes (nombre, apellido, correo, edad, genero, contraseña) 
        VALUES (:nombre, :apellido, :correo, :edad, :genero, :contraseña)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':edad', $edad);
$stmt->bindParam(':genero', $genero);
$stmt->bindParam(':contraseña', $contraseñaTextoClaro);  // Se guarda la contraseña sin encriptar

try {
    $result = $stmt->execute();
    if ($result) {
        $_SESSION['success'] = "Registro exitoso. Puedes iniciar sesión ahora.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Hubo un error al registrar el usuario. Inténtalo de nuevo.";
        header("Location: registrer.php");
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error al ejecutar la consulta: " . $e->getMessage();
    header("Location: registrer.php");
    exit;
}
