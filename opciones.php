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
            <h1>Opciones</h1>
            <p>"Descubre nuestras opciones de precios y cantidades para encontrar el tamaño perfecto<br>
            que se adapte a tus antojos helados."</p>
            <span><a href="home.php">Inicio</a><i class="bx bx-right-arrow-alt"></i>Opciones</span>
        </div>
         
    </div>
    <div class="taste">
    <div class="heading">
        <span>Pruebe</span>
        <h1>Nuestras Opciones de Compra</h1>
        <img src="image/separator-img.png">
    </div>

    <div class="box-container section1">
        <?php
        $select_price = $conn->prepare("SELECT * FROM `precios` WHERE status = ?");
        $select_price->execute(['active']);

        if ($select_price->rowCount() > 0) {
            while ($fetch_price = $select_price->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <div class="box-container-item">
                    <div class="detail">
                        <h2><?= $fetch_price['name']; ?></h2>
                        <h1><?= $fetch_price['price']; ?></h1>
                    </div>
                    <div class="box">
                        <img src="image/<?= $fetch_price['image']; ?>" class="image">
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
    <!--<div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Alex Doe</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores quia consequuntur debitis odit.
                    Nisi ipsa voluptates unde illo necessitatibus expedita.</p>
                <div class="flex-btn">
                    <a href="" class="btn">Explore our menu</a>
                    <a href="menu.php" class="btn">Visit our shop</a>
                </div>
            </div>
            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>-->
    <!--chef section start-->
   <!-- <div class="story">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.<br> Recusandae praesentium debitis expedita
            eaque<br>
            tempora deserunt aliquid quam ipsum sunt nemo,<br>
            molestiae est, velit blanditiis eveniet nulla aut pariatur!<br> Culpa voluptas in non rem magnam quaerat
            temporibus,
            aliquam fugiat doloribus, expedita quas. Harum beatae omnis ipsum.</p>
        <a href="menu.php" class="btn">our service</a></a>
    </div>-->
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
    </div>-->
    <!--testimonial section end-->
    <div class="mission">
        <div class="box-container custom-box-container">
            <div class="box">
                <div class="heading">
                    <h1>Variedades Heladas Exclusivas!</h1>
                    <img src="image/separator-img.png">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/icon.avif">
                    </div>
                    <div>
                        <h2>Cremosidad Inigualable!</h2>
                        <p>Deléitate con la rica textura y los sabores intensos de nuestra selección de helados de crema. Una experiencia suave y indulgente!</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/icon0.avif">
                    </div>
                    <div>
                        <h2>Placer en Cada Cono!</h2>
                        <p>Descubre la perfecta combinación de sabores irresistibles en nuestro cucurucho artesanal. Una mezcla de deleite en cada bocado!.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/icon2.avif">
                    </div>
                    <div>
                        <h2>Para Tu Receta!</h2>
                        <p>Eleva tus postres con nuestra gama de helados diseñados para crear experiencias culinarias únicas. Inspira tus creaciones con auténticos sabores!.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/icon4.avif">
                    </div>
                    <div>
                        <h2>Triple Tentación!</h2>
                        <p>Disfruta de la indulgencia de tres sabores exquisitos, una combinación perfecta para los amantes de la variedad!.</p>
                    </div>
                </div>

            </div>
            <div class="box">
                <img src="image/form.png" alt="" class="img">
            </div>
        </div>
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