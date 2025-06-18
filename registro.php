<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // De esta forma se encripta la contraseña

    // Validar email válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Formato de email no válido'); location.assign('registro.php');</script>";
        exit;
    }

    // Validar que el email sea @gmail.com o @gmail.es
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.(com|es)$/", $email)) {
        echo "<script>alert('Solo se permiten correos de Gmail (.com o .es)'); location.assign('registro.php');</script>";
        exit;
    }

    // Evitar duplicados (cambio: ID_Cliente → Cod_Empleado)
    $check = $conn->prepare("SELECT Cod_Empleado FROM empleados WHERE Email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Este correo ya está registrado'); location.assign('registro.php');</script>";
        $check->close();
        $conn->close();
        exit;
    }
    $check->close();

    // Insertar nuevo empleado
    $sql = "INSERT INTO empleados (Nombre, Apellidos, Email, Password) VALUES ('$nombre', '$apellido', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuario registrado exitosamente');
            location.assign('login.php'); </script>";
    } else {
        echo "<script>alert('Error al registrar el usuario');
            location.assign('registro.php'); </script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
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
            <img src="img\notiaBlanco.png" alt="logo Notia" class="logo">
            </div>
        </div>
         <!-- Fin header -->
        <div class="row p-4 d-flex justify-content-center">
        <div class="col-lg-4 col-md-6 col-10 p-5 d-flex flex-column align-items-center contenedor">
            <h1 class="fs18 bold fsMono mb-4">Registro</h1>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="d-flex flex-column align-items-center mt-1">
                <div>
                    
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="mt-3">
                    <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                </div>
                <div class="mt-3">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mt-3">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="boton mt-5 w-100">Registrar</button>
                <p class="mt-3 fs12"><a href="login.php">Volver al inicio de sesión</a></p>
            </form>
            </div>

        </div>
        <!-- Footer -->
        <div class="row">
            <div class="col-md-12 p-4 pl-5 mt-5">
            <p class="fs12 bco text-center bold">Copyright @notia</p>
            </div>
        </div>
        <!--Fin Footer -->
    </div>
  
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>