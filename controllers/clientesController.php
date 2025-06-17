<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO clientes (Nombre, Apellidos, Email, Telefono) VALUES ('$nombre', '$apellidos', '$email', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cliente agregado');
            location.assign('index.php'); </script>";
    } else {
        echo "<script>alert('Cliente NO se ha agregado');
            location.assign('index.php'); </script>";
    }

    $conn->close();
}
?>
<?php
include 'conexion.php';
$row = null;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    // Linea de datos del cliente
    $sql = "SELECT * FROM clientes WHERE ID_Cliente = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Cliente no encontrado');
            location.assign('index.php'); </script>";
        exit();
    }
}
?>
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