<!-- filepath: c:\xampp\htdocs\crud\index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script>
        function showTable(tableId) {
            // Ocultar todas las tablas
            document.querySelectorAll('.table-section').forEach(function(section) {
                section.style.display = 'none';
            });[]
            // Mostrar la tabla seleccionada
            document.getElementById(tableId).style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Mostrar la tabla de clientes por defecto
            showTable('clientes');
            // Añadir eventos de clic a los enlaces de navegación
            document.querySelectorAll('nav a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tableId = this.getAttribute('data-table');
                    showTable(tableId);
                });
            });
        });
    </script>
</head>
<body class="bg-azul overflow-hidden p-4">
    <div class="contenedor2 w-100">
        <div class="row p-4 d-flex justify-content-center">
        <div class="col-md-3 bg-bco p-4 pl-5 ">
            <img src="img/notia.png" class="logo">
              <p class="fs18 bold fsMono mt-5">Menu</p>
                <nav class="d-flex flex-column pl-2">
                    <a href="#" id="nav_0" class="negro bold menu" data-table="clientes">Clientes</a>
                    <a href="#" id="nav_1" class="negro bold mt-3 menu" data-table="productos">Productos</a>
                    <a href="#" id="nav_2" class="negro bold mt-3 menu" data-table="proveedores">Proveedores</a>
                    <a href="#" id="nav_3" class="negro bold mt-3 menu" data-table="empleados">Empleados</a>
                </nav>
            </div>
            <div class="col-md-9 p-4 pl-5 ">
                <div id="clientes" class="table-section">
                    <h1 class="fs18 bold fsMono">Lista de clientes</h1>
                
                    <p class="text-right">
                        <a href="crearFacturaVenta.php" class="boton2 bold mr-2 ">Crear factura de compra</a>
                        <a href="agregar.php" class="boton bold">Nuevo cliente</a>
                    </p>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th >Acciones</th>
                                <th class='d-flex justify-content-center'>Facturas</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                include 'database.php';
                                $sql = "SELECT * FROM clientes";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["Nombre"]. "</td>
                                                <td>" . $row["Apellidos"]. "</td>
                                                <td>" . $row["Email"]. "</td>
                                                <td>" . $row["Telefono"]. "</td>
                                                <td>
                                                    <a class='mr-4' href='editar.php?id=" . $row["ID_Cliente"] . "'><i class='fa-solid fa-pen-to-square negro fs18'></i></a>
                                                    <a href='eliminar.php?id=" . $row["ID_Cliente"] . "'><i class='fa-solid fa-xmark negro fs18'></i></a>
                                                </td>
                                                <td class='d-flex justify-content-center'>
                                                <a href='verFacturasCliente.php?id=" . $row["ID_Cliente"] . "'><i class='fa-solid fa-eye negro fs18'></i></a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay clientes registrados</td></tr>";
                                }
                                $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>
                <div id="proveedores" class="table-section" style="display: none;">
                    <h1 class="fs18 bold fsMono">Lista de proveedores</h1>
                    <p class="text-right"><a href="agregarProveedores.php" class="boton bold">Nuevo proveedor</a></p>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>CIF</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                include 'database.php';
                                $sql = "SELECT * FROM proveedores";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["ID_Proveedor"]. "</td>
                                                <td>" . $row["Nombre"]. "</td>
                                                <td>" . $row["CIF"]. "</td>
                                                <td>" . $row["Direccion"]. "</td>
                                                <td>" . $row["Telefono"]. "</td>
                                                <td>
                                                    <a class='mr-4' href='editarProveedores.php?id=" . $row["ID_Proveedor"] . "'><i class='fa-solid fa-pen-to-square negro fs18'></i></a>
                                                    <a href='eliminarProveedores.php?id=" . $row["ID_Proveedor"] . "'><i class='fa-solid fa-xmark negro fs18'></i></a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay proveedores registrados</td></tr>";
                                }
                                $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>

                <div id="productos" class="table-section" style="display: none;">
                    <h1  class="fs18 bold fsMono">Lista de productos</h1>
                    <p class="text-right"><a href="agregarProductos.php" class="boton bold">Nuevo producto</a></p>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                include 'database.php';
                                $sql = "SELECT * FROM productos";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["Codigo"]. "</td>
                                                <td>" . $row["Nombre"]. "</td>
                                                <td>" . $row["Precio"]. "</td>
                                                <td>" . $row["Stock"]. "</td>
                                                <td>
                                                    <a class='mr-4' href='editarProductos.php?id=" . $row["Codigo"] . "'><i class='fa-solid fa-pen-to-square negro fs18'></i></a>
                                                    <a href='eliminarProductos.php?id=" . $row["Codigo"] . "'><i class='fa-solid fa-xmark negro fs18'></i></a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay productos registrados</td></tr>";
                                }
                                $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>

                <div id="empleados" class="table-section" style="display: none;">
                    <h1 class="fs18 bold fsMono">Lista de empleados</h1>
                    <p class="text-right"><a href="agregarEmpleados.php" class="boton bold">Nuevo empleado</a></p>
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                include 'database.php';
                                $sql = "SELECT * FROM empleados";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["Cod_Empleado"]. "</td>
                                                <td>" . $row["Nombre"]. "</td>
                                                <td>" . $row["Apellidos"]. "</td>
                                                <td>" . $row["Email"]. "</td>
                                                <td>" . $row["Telefono"]. "</td>
                                                <td>
                                                    <a class='mr-4' href='editarEmpleados.php?id=" . $row["Cod_Empleado"] . "'><i class='fa-solid fa-pen-to-square negro fs18'></i></a>
                                                    <a href='eliminarEmpleados.php?id=" . $row["Cod_Empleado"] . "'><i class='fa-solid fa-xmark negro fs18'></i></a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay empleados registrados</td></tr>";
                                }
                                $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>
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