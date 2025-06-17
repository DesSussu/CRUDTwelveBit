<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
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
                <img src="img\logo.png" alt="logo TwelveBit" class="logo">
            </div>
        </div>
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-10 p-5 d-flex flex-column align-items-center contenedor">
            <h1 class="fs18 bold fsMono mb-4">Editar producto</h1>
            <?php if ($row) { ?>
            <form action="../controllers/productosController.php?accion=editar" method="POST"
                <input type="hidden" name="id" value="<?php echo $row['Codigo']; ?>">
                <div>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['Nombre']; ?>" required>
                </div>
                <div class="mt-3">
                    <input type="text" id="precio" name="precio" placeholder="Precio" value="<?php echo $row['Precio']; ?>" required>
                </div>
                <div class="mt-3">
                    <input type="number" id="stock" name="stock" placeholder="Stock" value="<?php echo $row['Stock']; ?>" required>
                </div>
                <button type="submit" class="boton mt-5 w-100">Actualizar producto</button>
                <a href="index.php" class="mt-3 fs12 text-center">Volver a la lista de productos</a>
            </form>
            <?php } else { ?>
                <p>Producto no encontrado.</p>
            <?php } ?>
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