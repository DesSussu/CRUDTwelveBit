<?php
require_once __DIR__ . '/../config/database.php';


$accion = $_GET['accion'] ?? '';

/* ===============================
    CREAR CLIENTE
   =============================== */
if ($accion === 'crear' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO clientes (Nombre, Apellidos, Email, Telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $apellidos, $email, $telefono);

    if ($stmt->execute()) {
        echo "<script>alert('Cliente agregado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Cliente NO se ha agregado'); location.assign('../index.php');</script>";
    }

    $stmt->close();
}

/* ===============================
    ELIMINAR CLIENTE
   =============================== */
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM clientes WHERE ID_Cliente = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $conn->query("SET @count = 0");
        $conn->query("UPDATE clientes SET ID_Cliente = @count:= @count + 1");
        $conn->query("ALTER TABLE clientes AUTO_INCREMENT = 1");

        echo "<script>alert('Cliente eliminado con éxito'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar el cliente'); location.assign('../index.php');</script>";
    }

    $stmt->close();
}

/* ===============================
    EDITAR CLIENTE
   =============================== */
if ($accion === 'editar' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE clientes SET Nombre = ?, Apellidos = ?, Email = ?, Telefono = ? WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $apellidos, $email, $telefono, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cliente actualizado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al actualizar el cliente'); location.assign('../index.php');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
