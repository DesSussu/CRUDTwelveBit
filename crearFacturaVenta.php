<?php
require_once "conexion.php";

// Obtener clientes y productos
$clientes = $conn->query("SELECT ID_Cliente, Nombre FROM clientes");
$productos = $conn->query("SELECT Codigo, Nombre, Precio FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear factura de venta</title>
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
                <h1 class="fs18 bold fsMono mb-4">Crear factura de venta</h1>
                <form action="procesarFacturaVenta.php" method="POST" id="form-venta">
                    <div class="form-row mb-3">
                        <div class="form-group col-md-4">
                            <label>Cliente</label>
                            <select name="cliente" class="form-control" required>
                                <option value="">Selecciona cliente</option>
                                <?php while ($row = $clientes->fetch_assoc()) { ?>
                                    <option value="<?= $row['ID_Cliente'] ?>"><?= $row['Nombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>
                    </div>

                    <h5 class="fs18 mt-4">Productos</h5>
                    <div id="lineas">
                        <div class="linea form-row align-items-end mb-2">
                            <div class="form-group col-md-4">
                                <label>Producto</label>
                                <select name="producto[]" class="form-control select-producto" required>
                                    <option value="">Selecciona producto</option>
                                    <?php
                                    $productos->data_seek(0);
                                    while ($prod = $productos->fetch_assoc()) { ?>
                                        <option value="<?= $prod['Codigo'] ?>" data-precio="<?= $prod['Precio'] ?>">
                                            <?= $prod['Nombre'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Cantidad</label>
                                <input type="number" min="1" name="cantidad[]" class="form-control input-cantidad" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Precio</label>
                                <input type="number" step="0.01" min="0" name="precio[]" class="form-control input-precio" required readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Total línea</label>
                                <input type="number" step="0.01" name="total_linea[]" class="form-control input-total-linea" readonly>
                            </div>
                            <div class="form-group col-md-2 d-flex">
                                <button type="button" class="btn btn-danger btn-sm align-self-end" onclick="eliminarLinea(this)">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="boton2 bold mb-4" onclick="anadirLinea()">
                        <i class="fa-solid fa-plus"></i> Añadir línea de producto
                    </button>
                    <br>
                    <button type="submit" name="crear_factura_venta" class="boton bold">Crear factura de venta</button>
                    <a href="index.php" class="ml-3 btn btn-light">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        function anadirLinea() {
            var primeraLinea = document.querySelector('.linea');
            var nuevaLinea = primeraLinea.cloneNode(true);

            nuevaLinea.querySelectorAll('select, input').forEach(function(el) {
                el.value = '';
            });

            document.getElementById('lineas').appendChild(nuevaLinea);
            actualizarEventos();
        }

        function eliminarLinea(boton) {
            var lineas = document.querySelectorAll('.linea');
            if (lineas.length > 1) {
                boton.closest('.linea').remove();
            }
        }

        function actualizarEventos() {
            document.querySelectorAll('.linea').forEach(function(linea) {
                var selectProducto = linea.querySelector('.select-producto');
                var inputCantidad = linea.querySelector('.input-cantidad');
                var inputPrecio = linea.querySelector('.input-precio');
                var inputTotalLinea = linea.querySelector('.input-total-linea');

                selectProducto.onchange = function() {
                    var precio = selectProducto.options[selectProducto.selectedIndex].getAttribute('data-precio');
                    inputPrecio.value = precio ? precio : '';
                    if (inputCantidad.value && inputPrecio.value) {
                        inputTotalLinea.value = (parseFloat(inputCantidad.value) * parseFloat(inputPrecio.value)).toFixed(2);
                    } else {
                        inputTotalLinea.value = '';
                    }
                };

                inputCantidad.oninput = function() {
                    if (inputPrecio.value && inputCantidad.value) {
                        inputTotalLinea.value = (parseFloat(inputCantidad.value) * parseFloat(inputPrecio.value)).toFixed(2);
                    } else {
                        inputTotalLinea.value = '';
                    }
                };

                inputPrecio.oninput = function() {
                    if (inputCantidad.value && inputPrecio.value) {
                        inputTotalLinea.value = (parseFloat(inputCantidad.value) * parseFloat(inputPrecio.value)).toFixed(2);
                    } else {
                        inputTotalLinea.value = '';
                    }
                };
            });
        }
        document.addEventListener('DOMContentLoaded', actualizarEventos);
    </script>
</body>
</html>
