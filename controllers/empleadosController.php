<?php
require_once __DIR__ . '/../config/database.php';

$accion = $_REQUEST['accion'] ?? null;

switch ($accion) {

    // -----------------------------
    // AGREGAR EMPLEADO
    // -----------------------------
    case 'agregar':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $sql = "INSERT INTO empleados (Nombre, Apellidos, Email, Telefono) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $apellidos, $email, $telefono);

            if ($stmt->execute()) {
                mensaje("Empleado agregado correctamente");
            } else {
                mensaje("Error al agregar el empleado");
            }

            $stmt->close();
        }
        break;

    // -----------------------------
    // ELIMINAR EMPLEADO
    // -----------------------------
    case 'eliminar':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            $stmt = $conn->prepare("DELETE FROM empleados WHERE Cod_Empleado = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Reordenar IDs (opcional)
                $conn->query("SET @count = 0");
                $conn->query("UPDATE empleados SET Cod_Empleado = @count:= @count + 1");
                $conn->query("ALTER TABLE empleados AUTO_INCREMENT = 1");

                mensaje("Empleado eliminado con éxito");
            } else {
                mensaje("Error al eliminar el empleado");
            }

            $stmt->close();
        } else {
            mensaje("ID no especificado");
        }
        break;

    // -----------------------------
    // EDITAR EMPLEADO
    // -----------------------------
    case 'editar':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = intval($_POST['id']);
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $sql = "UPDATE empleados SET Nombre=?, Apellidos=?, Email=?, Telefono=? WHERE Cod_Empleado=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $telefono, $id);

            if ($stmt->execute()) {
                mensaje("Empleado actualizado exitosamente");
            } else {
                mensaje("Error al actualizar el empleado");
            }

            $stmt->close();
        }
        break;

    default:
        mensaje("Acción no válida");
}

$conn->close();

// -----------------------------
// FUNCIÓN PARA MOSTRAR ALERTAS
// -----------------------------
function mensaje($texto) {
    echo "<script>alert('$texto'); location.assign('../views/empleados/index.php');</script>";
}
