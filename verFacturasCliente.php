<?php
require_once "conexion.php";

if (!isset($_GET['id'])) {
    echo "<p>Cliente no especificado.</p>";
    exit();
}
$id_cliente = intval($_GET['id']);

// Obtener datos del cliente
$resCliente = $conn->query("SELECT * FROM clientes WHERE ID_Cliente = $id_cliente");
$cliente = $resCliente->fetch_assoc();

// Obtener facturas de ese cliente
$resFacturas = $conn->query(
    "SELECT Cod_Factura, Fecha, Importe 
     FROM facturas_venta 
     WHERE ID_Cliente = $id_cliente 
     ORDER BY Fecha DESC"
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Facturas de <?= htmlspecialchars($cliente['Nombre']) ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-azul p-4">
    <div class="contenedor2 w-100">
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-md-3 bg-bco p-4 pl-5 ">
                <img src="img/logoAzul.png" class="logo mb-4">
                <p class="fs18 bold fsMono mt-5">Menu</p>
                <nav class="d-flex flex-column pl-2">
                    <a href="index.php" class="negro bold">Clientes</a>
                    <a href="index.php#productos" class="negro bold mt-3">Productos</a>
                    <a href="index.php#proveedores" class="negro bold mt-3">Proveedores</a>
                    <a href="index.php#empleados" class="negro bold mt-3">Empleados</a>
                </nav>
            </div>
            <div class="col-md-9 p-4 pl-5 ">
                <h1 class="fs18 bold fsMono mb-4">Facturas de <?= htmlspecialchars($cliente['Nombre']) ?></h1>
                <table class="table table-striped w-100">
                    <thead class="thead-dark">
                        <tr>
                            <th>Código factura</th>
                            <th>Fecha</th>
                            <th>Importe</th>
                            <th class="text-center">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tiene = false;
                        while ($f = $resFacturas->fetch_assoc()) {
                            $tiene = true;
                            echo "<tr>
                                <td>{$f['Cod_Factura']}</td>
                                <td>{$f['Fecha']}</td>
                                <td>" . number_format($f['Importe'], 2) . " €</td>
                                <td class='text-center'>
                                    <a href='detalleFacturaVenta.php?cod_factura={$f['Cod_Factura']}'>
                                        <i class='fa-solid fa-magnifying-glass negro fs18' title='Ver detalle'></i>
                                    </a>
                                </td>
                            </tr>";
                        }
                        if (!$tiene) {
                            echo "<tr><td colspan='4' class='text-center'>Este cliente no tiene facturas.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn btn-light mt-2">Volver a clientes</a>
            </div>
        </div>
    </div>
</body>
</html>
