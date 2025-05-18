<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro específico
    $stmt = $conn->prepare("DELETE FROM clientes WHERE ID_Cliente = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Ajustar los IDs de los registros restantes
        $conn->query("SET @count = 0");
        $conn->query("UPDATE clientes SET ID_Cliente = @count:= @count + 1");
        $conn->query("ALTER TABLE clientes AUTO_INCREMENT = 1");

        echo "<script>alert('Cliente eliminado con éxito');
            location.assign('index.php'); </script>";
    } else {
        echo "<script>alert('Error al eliminar el cliente');
            location.assign('index.php'); </script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID no especificado');
        location.assign('index.php'); </script>";
}

$conn->close();
?>