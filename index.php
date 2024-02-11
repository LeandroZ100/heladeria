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
    <title>Heladeria Isleño</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <!--FONT AWESOME CDN LINK-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'components/user_header.php'; ?>

    <!--Slider section start-->
    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>Dulces Delicias Heladas<br>Explora Nuestra Carta de Tentaciones...</h1>
                    <!--<a href="menu.php" class="btn">shop now</a>-->
                </div>
                <div class="imgBox">
                    <img src="image/slider.jpg">
                </div>
            </div>

            <div class="slideBox">
                <div class="textBox">
                    <h1>Una Delicia en Cada Bocado...<br>Explora Nuestra Carta...</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider - copia.jpg">
                </div>
            </div>

        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"><i class="bx bx-right-arrow-alt"></i> </li>
            <li onclick="prevSlide();" class="prev"><i class="bx bx-left-arrow-alt"></i> </li>
        </ul>
    </div>
    <!--Slider section end
    <div class="service">
        <div class="box-container">
            
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>
            
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>support</h4>
                    <span>24*7 hours</span>
                </div>
            </div>
            
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>gift service</h4>
                    <span>support gift service</span>
                </div>
            </div>
            
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>returns</h4>
                    <span>24*7 free return</span>
                </div>
            </div>
            
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>deliver</h4>
                    <span>100% secure</span>
                </div>
            </div>
            
        </div>
    </div>-->



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






    <!--taste section end-->





    <!-- <div class="usage">
        <div class="heading">
            <h1>Variedades Heladas Exclusivas!</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="row">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon.avif">
                    <div class="detail">
                        <h3>Cremosidad Inigualable!</h3>
                        <p>Deléitate con la rica textura y los sabores intensos de nuestra selección de helados de crema. Una experiencia suave y indulgente!.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon0.avif">
                    <div class="detail">
                        <h3>Placer en Cada Cono!</h3>
                        <p>Descubre la perfecta combinación de sabores irresistibles en nuestro cucurucho artesanal. Una mezcla de deleite en cada bocado!.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon1.avif">
                    <div class="detail">
                        <h3>Innovación sobre Palito!</h3>
                        <p>Explora nuestra variedad de helados de palito, una fusión refrescante de sabores auténticos y la comodidad en cada mordida!.</p>
                    </div>
                </div>
            </div>
            <img src="image/sub-banner.png" class="divider">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>Para Tu Receta!</h3>
                        <p> Eleva tus postres con nuestra gama de helados diseñados para crear experiencias culinarias únicas. Inspira tus creaciones con auténticos sabores!.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon3.avif">
                    <div class="detail">
                        <h3>Delicadeza en Palito!</h3>
                        <p>Sumérgete en la suavidad de nuestros palitos de crema. Una opción elegante para satisfacer tus antojos con estilo y dulzura!.</p>
                    </div>
                </div>
                <div class="box">
                    <img src="image/icon4.avif">
                    <div class="detail">
                        <h3>Triple Tentación!</h3>
                        <p>Disfruta de la indulgencia de tres sabores exquisitos, una combinación perfecta para los amantes de la variedad!.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

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


        <!-- <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">coconuts</a>
            </div>
        
            <div class="box">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">chocolate</a>
            </div>
        
            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">strawberry</a>
            </div>
        
            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">corn</a>
            </div>
        </div>
    
    </div>-->
        <!--categories section end-->



        <!--<img src="image/menu-banner.jpg" class="menu-banner">-->








        <div class="ice-container">
            <div class="overlay"></div>
            <div class="detail">
                <h1>Te Agradecemos Por Elejir<br>Nuestra Seleccion de Helados!</h1>
                <p>Agradecemos tu elección constante. <br>Cada sabor es elegido con esmero para brindarte variaciones exquisitas y únicas. Encuéntrate con la excelencia que nos distingue.<br>Sumérgete en una experiencia culinaria sublime, donde la calidad se encuentra con la pasión en cada bocado.</p>
                <!--<a href="menu.php" class="btn">shop now</a>-->
            </div>
        </div>

        <!--container section end
    <div class="taste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>Find your taste of desserts</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, earum!0</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>Find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>Find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type1.png">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>Find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type2.png">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>Find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type0.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>Find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>strawberry</h1>
                    <p>Find your taste of desserts</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
        </div>
    </div>-->
        <!--taste2 section end
    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner2.webp">
            <div class="detail">
                <h1>Hot Deal | Sale Up To<span>20% off</span></h1>
                <p>expired</p>
                <a href="manu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>
    -->


        <!--usage section end-->
        <div class="pride">
            <div class="detail">
                <h1>¡Gracias por elegirnos<br>para satisfacer tus antojos de helado!</h1>
                <p>Nos esforzamos por mantenerte siempre actualizado con la información más relevante...<br> Desde los suculentos sabores que ofrecemos hasta los precios actualizados según el peso de tu elección...</p>
                <!--<a href="menu.php" class="btn">Shop now</a>-->
            </div>
        </div>
        <!--pride section end-->
        <!--<div class="newsletter">
    <div class="content">
        <span>Get latest blues sky summer updates</span>
        <h1>suscribe our newsletter</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
            Nemo id aliquid accusantium deleniti, hic ratione. Sit doloremque velit enim maiores.</p>
       <div class="input-field">
            <input type="email" name="" placeholder="Enter your E-mail">
            <button class="btn">Suscribe</button>
        </div>
        <p>No ads, No trails, No commitment</p>
        <div class="box-container">
            <div class="box">
                <div class="box-counter">
                    <p class="counter">5000</p><i class="bx bx-plus"></i>
                </div>
                <h3>Succesfully Trained</h3>
                <p>Learning & counting</p>
            </div>
            <div class="box">
                <div class="box-counter">
                    <p class="counter">10000</p><i class="bx bx-plus"></i>
                </div>
                <h3>Certification Seller</h3>
                <p>online sellers</p>
            </div>
        </div>
    </div>
</div>-->
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