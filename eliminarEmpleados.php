<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro específico
    $stmt = $conn->prepare("DELETE FROM empleados WHERE Cod_Empleado = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Ajustar los IDs de los registros restantes
        $conn->query("SET @count = 0");
        $conn->query("UPDATE empleados SET Cod_Empleado = @count:= @count + 1");
        $conn->query("ALTER TABLE empleados AUTO_INCREMENT = 1");

        echo "<script>alert('empleado eliminado con éxito');
            location.assign('index.php'); </script>";
    } else {
        echo "<script>alert('Error al eliminar el empleado');
            location.assign('index.php'); </script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID no especificado');
        location.assign('index.php'); </script>";
}

$conn->close();
?>