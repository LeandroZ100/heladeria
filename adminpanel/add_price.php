<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}
//add precio in databases
if (isset($_POST['publish'])) {

    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

   // $description = $_POST['description'];
   // $description = filter_var($description, FILTER_SANITIZE_STRING);

   // $stock = $_POST['stock'];
   // $stock = filter_var($stock, FILTER_SANITIZE_STRING);
    $status = 'active';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `precios` WHERE image = ? AND seller_id=?");
    $select_image->execute([$image, $seller_id]);

    if (isset($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'Nombre de la imagen repetido';
        } elseif ($image_size > 2000000) {
            $warning_msg[] = 'El tamaño de la imagen es demasiado grande';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }
    if ($select_image->rowCount() > 0 and $image != '') {
        $warning_msg[] = 'Por favor, cambie el nombre de su imagen';
    } else {
        $insert_price = $conn->prepare("INSERT INTO `precios` (id, seller_id, name, price, image, status) VALUES(?,?,?,?,?,?)");
        $insert_price->execute([$id, $seller_id, $name, $price, $image, $status]);
        $succes_msg[] = 'Precio insertado correctamente';
    }
}




//add price in databases
if (isset($_POST['draft'])) {

    $id = unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    //$description = $_POST['description'];
    //$description = filter_var($description, FILTER_SANITIZE_STRING);

    //$stock = $_POST['stock'];
    //$stock = filter_var($stock, FILTER_SANITIZE_STRING);
    $status = 'deactive';

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/'.$image;

    $select_image = $conn->prepare("SELECT * FROM `precios` WHERE image = ? AND seller_id=?");
    $select_image->execute([$image, $seller_id]);

    if (isset($image)) {
        if ($select_image->rowCount() > 0) {
            $warning_msg[] = 'image name repeated';
        } elseif ($image_size > 200000) {
            $warning_msg[] = 'image size is too large';
        } else {
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    } else {
        $image = '';
    }
    if ($select_image->rowCount() > 0 and $image != '') {
        $warning_msg[] = 'please remane your image';
    } else {
        $insert_price = $conn->prepare("INSERT INTO `precios` (id, seller_id, name, price, image, status) VALUES(?,?,?,?,?,?)");
        $insert_price->execute([$id, $seller_id, $name, $price, $image, $status]);
        $succes_msg[] = 'Precio guardado en borrador con exito';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - Admin Agregar Precio</title>
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="post-editor">
            <div class="heading">
                <h1>Agregar Precios</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>Nombre<span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="Ej: 1/4 Un Cuarto, 1/2 Medio Kilo O 1 Kilo" required class="box">
                    </div>
                    
                    <div class="input-field">
                        <p>Precio<span>*</span></p>
                        <input type="text" name="price" maxlength="100" placeholder="Agrega precio" required class="box">
                    </div>
                    <div class="input-field">
                        <p>Imagen del Producto<span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box">
                    </div>
                    <!--<div class="input-field">
                        <p>product detail<span>*</span></p>
                        <textarea name="description" required maxlength="1000" placeholder="add product detail" class="box"></textarea>
                    </div>
                    <div class="input-field">
                        <p>product stock<span>*</span></p>
                        <input type="number" name="stock" maxlength="10" min="0" max="999999999" placeholder="add product stock" required class="box">
                    </div>-->
                    
                    <div class="flex-btn">
                        <input type="submit" name="publish" value="Agregar Precio" class="btn">
                        <input type="submit" name="draft" value="Guardar un Borrador" class="btn">
                    </div>
                </form>
            </div>
        </section>
    </div>





    <!--Sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--CUSTOM JS LINK-->
    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php'; ?>

</body>

</html>