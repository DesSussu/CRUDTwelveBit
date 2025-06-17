<?php
require_once __DIR__ . '/../config/database.php';

$accion = $_GET['accion'] ?? '';

/* =================== AGREGAR PROVEEDOR =================== */
if ($accion === 'agregar' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cif = $_POST['CIF'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO proveedores (Nombre, CIF, Direccion, Telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $cif, $direccion, $telefono);

    if ($stmt->execute()) {
        echo "<script>alert('Proveedor agregado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al agregar el proveedor'); location.assign('../index.php');</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}

/* =================== EDITAR PROVEEDOR =================== */
if ($accion === 'editar' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $cif = $_POST['CIF'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE proveedores SET Nombre=?, CIF=?, Direccion=?, Telefono=? WHERE ID_Proveedor=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $cif, $direccion, $telefono, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Proveedor actualizado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al actualizar el proveedor'); location.assign('../index.php');</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}

/* =================== ELIMINAR PROVEEDOR =================== */
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM proveedores WHERE ID_Proveedor = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $conn->query("SET @count = 0");
        $conn->query("UPDATE proveedores SET ID_Proveedor = @count:= @count + 1");
        $conn->query("ALTER TABLE proveedores AUTO_INCREMENT = 1");

        echo "<script>alert('Proveedor eliminado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar el proveedor'); location.assign('../index.php');</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
