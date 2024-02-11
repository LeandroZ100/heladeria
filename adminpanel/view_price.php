<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

//Borrado de Productos
if(isset($_POST['delete'])){
    $p_id = $_POST['price_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

$delete_product = $conn->prepare("DELETE FROM `precios` WHERE id = ?");
$delete_product->execute([$p_id]);

$success_msg[] = 'Producto borrado exitosamente';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - Ver Precios</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <div class="show-post">
            <div class="heading">
                <h1>Tus Precios</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                $select_price = $conn->prepare("SELECT * FROM `precios` WHERE seller_id = ?");
                $select_price->execute([$seller_id]);
                if ($select_price->rowCount() > 0) {
                    while ($fetch_price = $select_price->fetch(PDO::FETCH_ASSOC)) {

                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="price_id" value="<?php echo $fetch_price['id']; ?>">
                    <?php if ($fetch_price['image'] != '') { ?>
                    <img src="../uploaded_files/<?php echo $fetch_price['image'];?>" class="image">
                    <?php } ?>
                    <div class="status" style="color: <?php if ($fetch_price['status'] == 'active') {
                                                                    echo "limegreen";
                                                                } else {
                                                                    echo "coral";
                                                                } ?>"><?php echo $fetch_price['status']; ?>
                    </div>
                    <!--<div class="price">$ echo $fetch_products['price']; ?>/-</div>-->
                    <div class="content">
                        <img src="../image/shape-19.png" class="shap">
                        <div class="title"><?php echo $fetch_price['name']; ?></div>
                        <div class="flex-btn">
                            <a href="edit_price.php?id=<?php echo $fetch_price['id']; ?>" class="btn">Editar</a>
                            <button type="submit" name="delete" class="btn"
                                onclick="return confirm('Quiere eliminar el producto?');">Eliminar</button>
                            <!--<a href="read_product.php?post_id= echo $fetch_price['id']; ?>" class="btn">Leer
                            </a>-->
                        </div>
                    </div>
                </form>
                <?php
                    }
                } else {
                    echo '
                        <div class="empty">
                             <p>aún no se ha añadido ningún producto! <br> <a href="add_price.php" class="btn" style="margin-top: 1.5rem;">Agregar Productos</a></p>
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