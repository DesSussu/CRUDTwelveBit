<?php
require_once "conexion.php";

if (!isset($_GET['cod_factura'])) {
    echo "<p>Factura no especificada.</p>";
    exit();
}
$cod_factura = intval($_GET['cod_factura']);

// Cabecera de la factura
$sqlFactura = "
SELECT f.*, c.Nombre AS NombreCliente 
FROM facturas_venta f 
JOIN clientes c ON f.ID_Cliente = c.ID_Cliente 
WHERE f.Cod_Factura = $cod_factura
";
$resFactura = $conn->query($sqlFactura);
$factura = $resFactura->fetch_assoc();

// Líneas de factura
$sqlLineas = "
SELECT lv.Num_Linea, p.Nombre AS NombreProducto, lv.Cantidad, lv.Precio, lv.TotalLinea
FROM lineas_venta lv
JOIN productos p ON lv.Codigo = p.Codigo
WHERE lv.Cod_Factura = $cod_factura
ORDER BY lv.Num_Linea
";
$resLineas = $conn->query($sqlLineas);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle factura de venta</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-azul p-4">
    <div class="contenedor2 w-100">
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-md-3 bg-bco p-4 pl-5 ">
                <img src="img/notia.png" class="logo mb-4">
                <p class="fs18 bold fsMono mt-5">Menu</p>
                <nav class="d-flex flex-column pl-2">
                    <a href="index.php" class="negro bold">Clientes</a>
                    <a href="index.php#productos" class="negro bold mt-3">Productos</a>
                    <a href="index.php#proveedores" class="negro bold mt-3">Proveedores</a>
                    <a href="index.php#empleados" class="negro bold mt-3">Empleados</a>
                </nav>
            </div>
            <div class="col-md-9 p-4 pl-5 ">
                <h1 class="fs18 bold fsMono mb-4">Detalle factura de venta</h1>
                <p><strong>Nº Factura:</strong> <?= $factura['Cod_Factura'] ?></p>
                <p><strong>Cliente:</strong> <?= htmlspecialchars($factura['NombreCliente']) ?></p>
                <p><strong>Fecha:</strong> <?= $factura['Fecha'] ?></p>
                <p><strong>Importe total:</strong> <?= number_format($factura['Importe'], 2) ?> €</p>

                <h5 class="fs18 mt-4">Líneas de la factura</h5>
                <table class="table table-striped w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Línea</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total línea</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($l = $resLineas->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $l['Num_Linea'] ?></td>
                            <td><?= htmlspecialchars($l['NombreProducto']) ?></td>
                            <td><?= $l['Cantidad'] ?></td>
                            <td><?= number_format($l['Precio'], 2) ?> €</td>
                            <td><?= number_format($l['TotalLinea'], 2) ?> €</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-light mt-2">Volver al inicio</a>
            </div>
        </div>
    </div>
</body>
</html>
