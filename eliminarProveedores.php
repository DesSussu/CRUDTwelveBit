<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro específico
    $stmt = $conn->prepare("DELETE FROM proveedores WHERE ID_Proveedor = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Ajustar los IDs de los registros restantes
        $conn->query("SET @count = 0");
        $conn->query("UPDATE proveedores SET ID_Proveedor = @count:= @count + 1");
        $conn->query("ALTER TABLE proveedores AUTO_INCREMENT = 1");

        echo "<script>alert('proveedor eliminado con éxito');
            location.assign('index.php'); </script>";
    } else {
        echo "<script>alert('Error al eliminar el proveedor');
            location.assign('index.php'); </script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID no especificado');
        location.assign('index.php'); </script>";
}

$conn->close();
?>