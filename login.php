<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificamos si el usuario existe en la base de datos
    $sql = "SELECT * FROM empleados WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificamos la contraseña
        if (password_verify($password, $row['Password'])) {
            // Iniciamos sesión
            $_SESSION['user_id'] = $row['Cod_Empleado'];
            $_SESSION['user_name'] = $row['Nombre'];
            echo "<script>alert('Inicio de sesión exitoso');
                location.assign('index.php'); </script>";
        } else {
            echo "<script>alert('Contraseña incorrecta');
                location.assign('login.php'); </script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');
            location.assign('login.php'); </script>";
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
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
        <!-- End of header -->
        <div class="row p-4 d-flex justify-content-center">
            <div class="col-lg-4 col-md-6 col-10 p-5 d-flex flex-column align-items-center contenedor">
                <h1 class="fs18 bold fsMono mb-4">Inicio de Sesión</h1>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" class="mt-1">
                    <div>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mt-3">
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="boton mt-5 w-100">Iniciar Sesión</button>
                    <p class="mt-3 fs12 text-center"><a href="registro.php">Registrarse</a></p>
                </form>
                
            </div>
        </div>  
                <!-- Footer -->
                <div class="row">
            <div class="col-md-12 p-4 pl-5 mt-5">
            <p class="fs12 bco text-center bold">Copyright @twelveBit</p>
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