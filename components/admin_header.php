<header>
    <div class="logo">
        <img src="../image/logoheladeria2.png" width="100">
    </div>
    <div class="right">
        <div class="bx bxs-user" id="user_btn"></div>
        <div class="toggle-btn"><i class="bx bx-menu"></i></div>
    </div>

    <div class="profile-detail">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
        $select_profile->execute([$seller_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

            <div class="profile">
                <img src="../uploaded_files/<?php echo $fetch_profile['image']; ?>" class="logo-img" width="100">
                <p><?php echo $fetch_profile['name']; ?></p>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">Profile</a>
                    <a href="../components/admin_logout.php" onclick="return confirm('Cerrar sesión en este sitio web');" class="btn">Cierre de Sesion</a>
                </div>
            </div>
        <?php } ?>
    </div>
</header>




<div class="sidebar-container">
    <div class="sidebar">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `sellers` WHERE id = ?");
        $select_profile->execute([$seller_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

            <div class="profile">
                <img src="../uploaded_files/<?php echo $fetch_profile['image']; ?>" class="logo-img" width="100">

                <p><?php echo $fetch_profile['name']; ?></p>
            </div>
        <?php } ?>
        <h5>Menu</h5>
        <div class="navbar">
            <ul>
                <!--<li> <a href="dashboard.php"> <i class="bx bxs-home-smile"></i>Dashboard</a></li>-->
                <li> <a href="add_products.php"> <i class="bx bxs-shopping-bags"></i>Agregar Productos</a></li>
                <li> <a href="add_price.php"> <i class="bx bxs-shopping-bags"></i>Agregar Precios</a></li>
                <li> <a href="view_product.php"> <i class="bx bxs-food-menu"></i>Ver Productos</a></li>
                <li> <a href="view_price.php"> <i class="bx bxs-food-menu"></i>Ver Precios</a></li>
               <!-- <li> <a href="user_accounts.php"> <i class="bx bxs-user-detail"></i>Cuentas</a></li>-->
                <li> <a href="../components/admin_logout.php" onclick="return confirm('Cerrar sesión en este sitio web?');"></a><i class="bx bx-log-out">Cerrar Sesion</i></a></li>
            </ul>
        </div>
        <!--<h5>Encuentranos</h5>
        <div class="social-links">
            <i class="bx bxl-facebook"></i>
            <i class="bx bxl-instagram-alt"></i>
            <i class="bx bxl-linkedin"></i>
            <i class="bx bxl-twitter"></i>
            <i class="bx bxl-pinterest-alt"></i>
        </div>-->
    </div>
</div>