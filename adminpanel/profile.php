<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

$select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
$select_products->execute([$seller_id]);
$total_products = $select_products->rowCount();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - Perfil de Vendedor</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <div class="container">
            <div class="seller-profile">
                <div class="heading">
                    <h1>Detalles del Perfil</h1>
                    <img src="../image/separator-img.png">
                </div>
                <div class="details">
                    <div class="seller">
                        <img src="../uploaded_files/<?= $fetch_profile['image']; ?>">
                        <h3 class="name"><?= $fetch_profile['name']; ?></h3>
                        <span>Vendedor</span>
                        <a href="update.php" class="btn">Actualizar Perfil</a>
                    </div>
                    <div class="flex">
                        <div class="box">
                            <span><?= $total_products; ?></span>
                            <p>Total de productos</p>
                            <a href="view_product.php" class="btn">Vista de Productos</a>
                        </div>

                    </div>
                </div>
            </div>
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