<?php
include("components/connect.php");

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}



if (isset($_GET['post_id'])) {
    // Obtener el ID del producto de la URL
    $product_id = $_GET['post_id'];
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Sky Summer -Descripcion page</title>
    <link rel="stylesheet" href="css/user_style.css?v=<?php echo time(); ?>">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'components/user_header.php'; ?>



    <div class="banner">
        <div class="detail">
            <h1>Descripcion</h1>
            <p>"Explora a fondo el helado seleccionado, donde detallamos sus ingredientes,<br> proceso de elaboración y la experiencia sensorial que te espera."</p>
            <span><a href="index.php">Home</a><i class="bx bx-right-arrow-alt"></i>Descripcion</span>
        </div>
    </div>



    <div class="chef">
        <div class="box-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
            $select_products->execute([$product_id]);
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box texto">
                        <div class="heading">
                            <span>Heladeria Isleño</span>
                            <h1><?php echo $fetch_products['name']; ?></h1>
                            <img class="separator" src="image/separator-img.png">
                        </div>

                        <div>
                            <p><?php echo $fetch_products['product_detail']; ?></p>
                        </div>
                        <div class="flex-btn">
                            <a href="index.php" class="btn">Ir a Inicio</a>
                            <a href="info.php" class="btn">Ir a info</a>
                        </div>
                    </div>


                    <div class="box">
                        <?php if ($fetch_products['image'] != '') { ?>
                            <img src="uploaded_files/<?php echo $fetch_products['image']; ?>" class="image">
                        <?php } ?>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
    <!--chef section start-->
    <div class="story">
        <div class="heading">
            <h1>Sobre Nosotros</h1>
            <img src="image/separator-img.png">
        </div>
        <p>"Nosotros somos una heladería familiar comprometida con la excelencia.<br>Seleccionamos cuidadosamente helados de calidad,<br>
        cumpliendo con normas sanitarias rigurosas y manteniendo<br>
        siempre la cadena de frío para garantizar la frescura."</p>
           
        <!--<a href="menu.php" class="btn">our service</a></a>-->
    </div>
    <!--story section start-->
    <!--<div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png" alt="">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Talking Ice Cream To New Heights</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum maiores optio voluptatem aspernatur,
                    nam fugit possimus dolores sequi officia exercitationem quidem distinctio tenetur. Eaque, eveniet,
                    dolor voluptates molestiae porro, sint eum minima aliquam numquam dicta libero soluta tenetur nam
                    officiis praesentium harum sed mollitia dolorum cum!</p>
                <a href="" class="btn">Learn More</a>
            </div>
        </div>
    </div>-->
    <!--story section end-->
    <!--<div class="team">
        <div class="heading">
            <span>Our tem</span>
            <h1>Quality & passion with our services</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Ralph Johnson</h2>
                    <p>Coffee Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Fiona Johnson</h2>
                    <p>Pastry Chef</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Tom Kneltonns</h2>
                    <p>Coffee Chef</p>
                </div>
            </div>
        </div>
    </div>-->
    <!--team section end-->
    <!--<div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>Our Standerts</h1>
                <img src="image/separator-img.png">
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam!</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam!</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam!</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam!</p>
            <i class="bx bxs-heart"></i>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam!</p>
            <i class="bx bxs-heart"></i>
        </div>
    </div>-->
    <!--standers section end-->
    <!--<div class="testimonial">
        <div class="heading">
            <h1>testimonial</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, deserunt fuga? Vel eligendi
                            libero omnis quaerat possimus veritatis quisquam nostrum?</p>
                        <h2>Zen</h2>
                        <p>Autor</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, deserunt fuga? Vel eligendi
                            libero omnis quaerat possimus veritatis quisquam nostrum?</p>
                        <h2>Zen</h2>
                        <p>Autor</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, deserunt fuga? Vel eligendi
                            libero omnis quaerat possimus veritatis quisquam nostrum?</p>
                        <h2>Zen</h2>
                        <p>Autor</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg">
                    </div>
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere, deserunt fuga? Vel eligendi
                            libero omnis quaerat possimus veritatis quisquam nostrum?</p>
                        <h2>Zen</h2>
                        <p>Autor</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg">
                    </div>
                </div>
            </div>
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>
        -->





















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
    <!--Sweetalert-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!--CUSTOM JS LINK-->
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>