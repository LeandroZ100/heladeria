<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_seller = $conn->prepare("SELECT * FROM `sellers` WHERE email = ? AND password = ?");
    $select_seller->execute([$email, $pass]);
    $row = $select_seller->fetch(PDO::FETCH_ASSOC);

    if ($select_seller->rowCount() > 0) {
        setcookie('seller_id' , $row['id'], time() + 60*60*24*30, '/');
        header('location:dashboard.php');
    }else{
        $warning_msg[] = 'Email o Contraseña incorrecto';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - seller registreration page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>

    <!--Sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--CUSTOM JS LINK-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include '../components/alert.php'; ?>

    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>Acceder</h3>

            <div class="input-field">
                <p>Email <span>*</span></p>
                <input type="email" name="email" placeholder="Ingrese su email..." maxlength="50" required class="box" autocomplete="new-password">
            </div>

            <div class="input-field">
                <p>Contraseña <span>*</span></p>
                <input type="password" name="pass" placeholder="Ingrese su contraseña..." maxlength="50" required class="box" autocomplete="new-password">
            </div>

            <p class="link">¿No tiene una cuenta?? <a href="register.php">Registrarse</a></p>
            <input type="submit" name="submit" value="Iniciar Sesion" class="btn">
        </form>
    </div>



</body>

</html>