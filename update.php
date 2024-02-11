<?php
include("components/connect.php");

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
    $select_user->execute([$user_id]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $prev_pass = $fetch_user['pass'];
    $prev_image = $fetch_user['image'];

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    //Actualizacion de Nombre
    if (!empty($name)) {
        $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
        $update_name->execute([$name, $user_id]);
        $success_msg[] = 'Nombre de Usuario actualizado con exito';
    }

    //Actualizacion de Email
    if (!empty($email)) {
        $select_email = $conn->prepare("SELECT email FROM `users` WHERE id = ? AND email = ?");
        $select_email->execute([$user_id, $email]);

        if ($select_email->rowCount() > 0) {
            $warning_msg[] = 'El Email ya existe';
        } else {
            $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
            $update_email->execute([$email, $user_id]);
            $success_msg[] = 'Email de Usuario actualizado con exito';
        }  
    }
    //Actualizar Imagen
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id().'.'.$ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_files/'.$rename;

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'El tamaño de la imagen es muy grande';
        }else{
            $update_image = $conn->prepare("UPDATE `users` SET `image` = ? WHERE id = ?");
            $update_image->execute([$rename, $user_id]);
            move_uploaded_file($image_tmp_name, $image_folder);

            if($prev_image != '' AND $prev_image != $rename) {
                unlink('uploaded_files/'.$prev_image);
            }
            $success_msg[] = 'Imagen actualizada con exito';
        }
    }

    //Actualizar contraseña
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $warning_msg[] = 'La contraseña anterior no coincide';
        }elseif($new_pass != $cpass){
            $warning_msg[] = 'La contraseña no coincide';
        }else{
            if ($new_pass != $empty_pass) {
                $update_pass = $conn->prepare("UPDATE `users` SET pass = ? WHERE id = ?");
                $update_pass->execute([$cpass, $user_id]);
                $success_msg[] = 'Contraseña actualizada con exito';
            }else{
                $warning_msg[] = 'Introduzca una nueva contraseña';
            }
        }
    }

}

?>





<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer -update profile page</title>
    <link rel="stylesheet" href="css/user_style.css?v=<?php echo time(); ?>">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>update profile</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Distinctio odio ea animi?</p>
            <span><a href="home.php">Home</a><i class="bx bx-right-arrow-alt"></i>update profile</span>
        </div>
    </div>
    <div class="form-container">
            <div class="heading">
                <h1>Actualizar Detalles del Perfil</h1>
                <img src="image/separator-img.png">
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="img-box">
                    <img src="uploaded_files/<?= $fetch_profile['image']; ?>">
                </div>

                <div class="flex">
                    <div class="col">
                        <div class="input-field">
                            <p>Tu nombre <span>*</span> </p>
                            <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" class="box">
                        </div>
                        <div class="input-field">
                            <p>Tu Email <span>*</span> </p>
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" class="box">
                        </div>
                        <div class="input-field">
                            <p>Seleccione imagen<span>*</span> </p>
                            <input type="file" name="image" accept="image/*" class="box">
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-field">
                            <p>Contraseña Anterior<span>*</span> </p>
                            <input type="password" name="old_pass" placeholder="Ingrese su contraseña anterior" class="box">
                        </div>
                        <div class="input-field">
                            <p>Contraseña Nueva<span>*</span> </p>
                            <input type="password" name="new_pass" placeholder="Ingrese su nueva contraseña" class="box">
                        </div>
                        <div class="input-field">
                            <p>Confirmar Contraseña<span>*</span> </p>
                            <input type="password" name="cpass" placeholder="Confirma tu contraseña" class="box">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Actualizar Perfil" class="btn">
            </form>
        </div>


    <?php include 'components/footer.php'; ?>
    <!--Sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--CUSTOM JS LINK-->
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>