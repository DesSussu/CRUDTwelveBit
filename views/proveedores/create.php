<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
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
                <img src="img/logo.png" alt="logo TwelveBit" class="logo">
            </div>
        </div>
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-10 p-5 d-flex flex-column align-items-center contenedor">
                <h1 class="fs18 bold fsMono mb-4">Agregar Proveedor</h1>
                <form action="controllers/proveedoresController.php?accion=agregar" method="POST" class="d-flex flex-column align-items-center mt-1">
                    <div>
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="mt-3">
                        <input type="text" id="CIF" name="CIF" placeholder="CIF" required>
                    </div>
                    <div class="mt-3">
                        <input type="text" id="direccion" name="direccion" placeholder="Dirección" required>
                    </div>
                    <div class="mt-3">
                        <input type="text" id="telefono" name="telefono" placeholder="Teléfono" required>
                    </div>
                    <button type="submit" class="boton mt-5 w-100">Agregar Proveedor</button>
                    <a href="index.php" class="mt-3 fs12 text-center">Volver a la lista de proveedores</a>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
