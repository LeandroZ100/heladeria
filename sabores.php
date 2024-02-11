<?php
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer - Opciones</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Sabores</h1>
            <p>"Explora nuestra selección de sabores frescos y deliciosos disponibles ahora mismo<br>
            para satisfacer tus antojos helados."</p>
            <span><a href="home.php">Inicio</a><i class="bx bx-right-arrow-alt"></i>Sabores</span>
        </div>
    </div>



 
    
    
    <div class="categories">
        <div class="heading">
            <h1>Sabores</h1>
            <img src="image/separator-img.png">
        </div>


        <div class="box-container section2">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE status = ?");
            $select_products->execute(['active']);

            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {

            ?>
            <div class="box">
                <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">
                <a href="description_product.php?post_id=<?= $fetch_products['id']; ?>" class="btn"><?= $fetch_products['name']; ?></a>
            </div>
    
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
                                        
            <?php
                }
            } 
            ?>
        </div>





        <footer>
            <div class="content">
                <div class="box">
                    <img src="image/logoheladeria2.png">
                    <p>"¿Antojo de helado? Ahorra tiempo encargando tu helado fácilmente a través de WhatsApp y armaremos tu pedido para que pases a retirar!"</p>
                    <a href="https://wa.me/541121780457?text=¡Hola!,%20Estoy%20interesado%20en%20sus%20Helados%20podrian%20ayudarme%20con%20un%20pedido?." class="btn">Wathsaap</a>
                </div>

                <div class="box">
                    <a href="contacto.php">
                        <h3>Contacto</h3>
                    </a>

                    <a href="https://wa.me/541121780457?text=¡Hola!,%20Estoy%20interesado%20en%20sus%20Helados%20podrian%20ayudarme%20con%20un%20pedido?.">
                        <p><i class="bx bxl-whatsapp"></i>11-2178-0457</p>
                    </a>


                    <a href="https://www.google.com/maps?q=Isidro+Casanova,+La+Matanza,+isleño+1115">
                        <p><i class="bx bxs-location-plus"></i>Isidro Casanova, La Matanza</p>
                    </a>


                    <div class="icons">
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-instagram"></i>
                        <i class="bx bxl-linkedin"></i>
                    </div>
                </div>

            </div>
            <div class="bottom">
                <p>Copyrirght 2024 code with Leandro. Todos los derechos reservados</p>
                <a href="admin panel/login.php"></a>
            </div>
        </footer>
    <script src="js/user_script.js"></script>
</body>

</html>