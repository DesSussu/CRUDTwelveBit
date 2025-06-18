<?php
require_once "conexion.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['crear_factura_venta'])) {
    $id_cliente = $_POST['cliente'];
    $fecha = $_POST['fecha'];

    // Calcular el total de la factura
    $total_factura = 0;
    foreach ($_POST['cantidad'] as $i => $cant) {
        $total_factura += floatval($cant) * floatval($_POST['precio'][$i]);
    }

    // Inserta la cabecera de la factura
    $sqlCabecera = "INSERT INTO facturas_venta (Fecha, Importe, ID_Cliente) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sqlCabecera);

    if (!$stmt) {
        echo "Error en prepare (cabecera): " . $conn->error;
        exit();
    }

    $stmt->bind_param("sdi", $fecha, $total_factura, $id_cliente);

    if (!$stmt->execute()) {
        echo "Error al insertar la factura: " . $stmt->error;
        exit();
    }

    $cod_factura = $conn->insert_id;

    // Inserta las líneas de la factura
    foreach ($_POST['producto'] as $i => $cod_producto) {
        $cantidad = intval($_POST['cantidad'][$i]);
        $precio = floatval($_POST['precio'][$i]);
        $total_linea = $cantidad * $precio;
        $num_linea = $i + 1;

        $sqlLinea = "INSERT INTO lineas_venta (Cod_Factura, Num_Linea, Codigo, Cantidad, Precio, TotalLinea) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt2 = $conn->prepare($sqlLinea);

        if (!$stmt2) {
            echo "Error en prepare (línea): " . $conn->error;
            exit();
        }

        $stmt2->bind_param("iiiiid", $cod_factura, $num_linea, $cod_producto, $cantidad, $precio, $total_linea);

        if (!$stmt2->execute()) {
            echo "Error al insertar línea: " . $stmt2->error;
            exit();
        }

        // Resta stock al producto vendido
        $sqlStock = "UPDATE productos SET Stock = Stock - ? WHERE Codigo = ?";
        $stmt3 = $conn->prepare($sqlStock);

        if (!$stmt3) {
            echo "Error en prepare (stock): " . $conn->error;
            exit();
        }

        $stmt3->bind_param("ii", $cantidad, $cod_producto);
        $stmt3->execute();
    }

   echo "<script>
            alert('Factura y líneas guardadas correctamente');
            window.location.href = 'index.php';
        </script>";
exit();
} else {
    echo "<script>
            alert('No se ha enviado el formulario correctamente.');
            window.location.href = 'index.php';
        </script>";
}
?>
