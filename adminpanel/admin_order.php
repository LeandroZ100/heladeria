<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    $seller_id = '';
    header('location:login.php');
}
//Actualizar ordenes desde la base de datos
    if (isset($_POST['update_order'])){

        $order_id = $_POST['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $update_payment = $_POST['update_payment'];
        $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
        $update_pay->execute([$update_payment, $order_id]);
        $succes_msg[] = 'Actualización del estado del pago del pedido';
    }

    //Eliminar ordenes
    if (isset($_POST['delete_order'])){

        $delete_id = $_POST['order_id'];
        $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
        $verify_delete->execute([$delete_id]);

        if ($verify_delete->rowCount() > 0) {

            $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
            $delete_order->execute([$delete_id]);

            $succes_msg[] = 'Orden Eliminada';
    }else{
        $warning_msg[] = 'El pedido ya eliminado';
        }
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
        <div class="order-container">
            <div class="heading">
                <h1>Pedidos Realizados</h1>
                <img src="../image/separator-img.png">
            </div>
            <div class="box-container">
                <?php
                $select_order = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
                $select_order->execute([$seller_id]);

                if ($select_order->rowCount() > 0) {
                    while ($fetch_order = $select_order->fetch(PDO::FETCH_ASSOC)) {


                ?>
                <div class="box">
                    <div class="status" style="color: <?php if ($fetch_order['status'] == 'in progress') {
                                                                    echo "limegreen";
                                                                } else {
                                                                    echo "red";
                                                                } ?>">
                        <?= $fetch_order['status']; ?>
                    </div>

                    <div class="details">
                        <p>Nombre de Usuario: <span><?= $fetch_order['name']; ?></span></p>
                        <p>Id de Usuario: <span><?= $fetch_order['user_id']; ?></span></p>
                        <p>Situado en: <span><?= $fetch_order['date']; ?></span></p>
                        <p>Numero de Usuario: <span><?= $fetch_order['number']; ?></span></p>
                        <p>Email de Usuario: <span><?= $fetch_order['email']; ?></span></p>
                        <p>Precio Total: <span><?= $fetch_order['price']; ?></span></p>
                        <p>Metodo de Pago: <span><?= $fetch_order['method']; ?></span></p>
                        <p>Dirección de Usuario: <span><?= $fetch_order['adress']; ?></span></p>
                    </div>

                    <form action="" method="post">

                        <input type="hidden" name="order_id" value="<?= $fetch_order['id']; ?>">

                        <select name="update_payment" class="box" style="width: 90%;">
                            <option disabled selected><?= $fetch_order['payment_status']; ?></option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Entregado">Entregado</option>
                        </select>

                        <div class="flex-btn">
                            <input type="submit" name="update_order" value="actualizar orden" class="btn">
                            <input type="submit" name="delete_order" value="eliminar orden" class="btn" onclick="return confirm('Desea eliminar esta orden');">
                        </div>
                    </form>

                </div>
                <?php
                    }
                }else{
                    echo '
                        <div class="empty">
                             <p>Aún no hay ordenes sin leer.</p>
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