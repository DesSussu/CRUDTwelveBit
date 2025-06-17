<?php
require_once __DIR__ . '/../config/database.php';


$accion = $_GET['accion'] ?? '';

/* =================== AGREGAR PRODUCTO =================== */
if ($accion === 'agregar' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO productos (Nombre, Precio, Stock) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $nombre, $precio, $stock);

    if ($stmt->execute()) {
        echo "<script>alert('Producto agregado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Producto NO se ha agregado'); location.assign('../index.php');</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}

/* =================== EDITAR PRODUCTO =================== */
if ($accion === 'editar' && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "UPDATE productos SET Nombre=?, Precio=?, Stock=? WHERE Codigo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Producto actualizado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al actualizar el producto'); location.assign('../index.php');</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}

/* =================== ELIMINAR PRODUCTO =================== */
if ($accion === 'eliminar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM productos WHERE Codigo = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Reorganizar los Ids
        $conn->query("SET @count = 0");
        $conn->query("UPDATE productos SET Codigo = @count:= @count + 1");
        $conn->query("ALTER TABLE productos AUTO_INCREMENT = 1");

        echo "<script>alert('Producto eliminado'); location.assign('../index.php');</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto'); location.assign('../index.php');</script>";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
