<?php
include '../components/connect.php';


if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}

if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    //$price = $_POST['price'];
    //$price = filter_var($price, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    //$stock = $_POST['stock'];
    //$stock = filter_var($stock, FILTER_SANITIZE_STRING);

    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);


    $update_product = $conn->prepare("UPDATE `products` SET name = ?, product_detail = ?, status = ? WHERE id = ?");
    $update_product->execute([$name, $description, $status, $product_id]);

    $succes_msg[] = 'Producto Actualizado';

    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;


    $select_image = $conn->prepare("SELECT * FROM `products` WHERE image=? AND seller_id=?");
    $select_image->execute([$image, $seller_id]);

    if (!empty($image)) {
        if ($image_size > 2000000) {
            $warning_msg[] = 'El tamaño de la imagen es demasiado grande';
        } elseif($select_image->rowCount() > 0 AND $image != '') {
            $warning_msg[] = 'Por favor, cambie el nombre de su imagen';
        } else {
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id=?");
            $update_image->execute([$image, $product_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            
            if (move_uploaded_file($image_tmp_name, $image_folder)) {
                echo "La imagen se cargó correctamente";
            } else {
                echo "Hubo un problema al cargar la imagen";
            }
            


            if ($old_image != $image AND $old_image != '') {
                unlink('../uploaded_files/'.$old_image);
            }
            $succes_msg[] = 'Imagen Actualizada';
            
        }
    }
}

  //Borrado de Imagen
  if (isset($_POST['delete_image'])) {
    $empty_image = '';

    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_image->execute([$product_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image['image'] != ''){
        unlink('../uploaded_files/'.$fetch_delete_image['image']);
    }
    $unset_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
    $unset_image->execute([$empty_image, $product_id]);
    $succes_msg[] = 'Imagen eliminada con exito';
}

    //Borrado de Productos
    if (isset($_POST['delete_product'])){
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);

        $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $delete_image->execute([$product_id]);
        $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);

        if ($fetch_delete_image['image'] != '') {
            unlink('../uploaded_files/'.$fetch_delete_image['image']);
        }
        $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
        $delete_product->execute([$product_id]);
        $succes_msg[] = 'Imagen eliminada con exito';
        header('location:view_product.php');
    }

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - Admin Dashboard page</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <div class="post-editor">
            <div class="heading">
                <h1>Edicion de Productos</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">

                <?php
                $product_id = $_GET['id'];
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ? AND 
                    seller_id = ?");
                $select_products->execute([$product_id, $seller_id]);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="form-container">
                    <form action="" method="post" enctype="multipart/form-data" class="register">

                        <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
                        <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">

                        <div class="input-field">
                            <p>Estado del Producto<span>*</span></p>
                            <select name="status" class="box">
                                <option value="<?php echo $fetch_products['status']; ?>" selected>
                                    <?php echo $fetch_products['status']; ?></option>
                                <option value="active">Activo</option>
                                <option value="deactive">Desactivo</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <p>Nombre del Producto<span>*</span></p>
                            <input type="text" name="name" value="<?php echo $fetch_products['name']; ?>" class="box">
                        </div>

                        <!--<div class="input-field">
                            <p>Precio del Producto<span>*</span></p>
                            <input type="number" name="price" value=" echo $fetch_products['price']; ?>"
                                class="box">
                        </div>-->

                        <div class="input-field">
                            <p>Description del Producto<span>*</span></p>
                            <textarea name="description"
                                class="box"><?php echo $fetch_products['product_detail']; ?></textarea>
                        </div>

                       <!-- <div class="input-field">
                            <p>Stock del Producto<span>*</span></p>
                            <input type="number" name="stock" value=" echo $fetch_products['stock']; ?>"
                                class="box" min="0" max="9999999999" maxlength="10">
                        </div>-->

                        <div class="input-field">
                            <p>Imagen del Producto<span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box">
                            <?php if ($fetch_products['image'] != '') { ?>
                            <img src="../uploaded_files/<?php echo $fetch_products['image']; ?>" class="image">

                            <div class="flex-btn">
                                <input type="submit" name="delete_image" class="btn" value="Eliminar imagen">
                                <a href="view_product.php" class="btn"
                                    style="width:49%; text-align: center; height: 3rem; margin-top: .7rem;">Volver</a>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="flex-btn">

                            <input type="submit" name="update" value="Actualizar Producto" class="btn">
                            <input type="submit" name="delete_product" value="Eliminar Producto" class="btn">

                        </div>
                    </form>
                </div>
                <?php
                    }
                } else {
                    echo '<div class="empty">
                             <p>aún no se ha añadido ningún producto!</p>
                        </div>';

                    ?>
                <br><br>
                <div class="flex-btn">
                    <a href="view_product.php" class="btn">Ver productos</a>
                    <a href="add_products.php" class="btn">Agregar productos</a>
                </div>
                <?php } ?>
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