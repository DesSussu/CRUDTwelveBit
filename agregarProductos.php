<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Verificar si ya existe un producto con ese nombre
    $check = $conn->prepare("SELECT Codigo FROM productos WHERE Nombre = ?");
    $check->bind_param("s", $nombre);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Ya existe un producto con ese nombre');
            location.assign('index.php'); </script>";
        $check->close();
        $conn->close();
        exit;
    }
    $check->close();

    // Insertar nuevo producto si el nombre no está repetido
    $sql = "INSERT INTO productos (Nombre, Precio, Stock) VALUES ('$nombre', '$precio', '$stock')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Producto agregado');
            location.assign('index.php'); </script>";
    } else {
        echo "<script>alert('Producto NO se ha agregado');
            location.assign('index.php'); </script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-azul overflow-hidden">
    <div class="w-100">
            <!-- header -->
            <div class="row">
                <div class="col-md-12 p-4 pl-5">
                <img src="img\notiaBlanco.png" alt="logo TwelveBit" class="logo">
                </div>
            </div>
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-10 p-5 d-flex flex-column align-items-center contenedor">
            <h1 class="fs18 bold fsMono mb-4">Agregar Producto</h1>
                <form action="agregarProductos.php" method="POST" class="d-flex flex-column align-items-center mt-1">
                    <div>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="mt-3">
                        <input type="number" step="0.01" id="precio" name="precio" placeholder="Precio" required>
                    </div>
                    <div class="mt-3">
                        <input type="stock" id="stock" name="stock" placeholder="Stock" required>
                    </div>
                    <button type="submit" class="boton mt-5 w-100">Agregar Producto</button>
                    <a href="index.php" class="mt-3 fs12 text-center">Volver a la lista de productos</a>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>