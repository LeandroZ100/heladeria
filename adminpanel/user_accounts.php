<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - Registro de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <div class="users-container">
            <div class="heading">
                <h1>Registro de Usuarios</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();

                    if ($select_users->rowCount() > 0) {
                        while ($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)) {
                            $user_id = $fetch_users['id'];
                        
                ?>
                <div class="box">
                         <img src="../uploaded_files/<?= $fetch_users['image']; ?>">
                         <p>Id de Usuario : <span><?= $user_id; ?></span></p>  
                         <p>Nombre de Usuario : <span><?= $fetch_users['name']; ?></span></p>
                         <p>Email de Usuario : <span><?= $fetch_users['email']; ?></span></p> 
                        </div>
                <?php
                     }
                 }else{
                    echo '
                        <div class="empty">
                             <p>.</p>
                        </div>
                    ';
                 }
                ?>
            </div>
        </div>
    </div>




    <!--Sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--CUSTOM JS LINK-->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>

</body>

</html>