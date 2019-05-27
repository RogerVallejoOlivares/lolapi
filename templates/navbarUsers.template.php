<?php
/**
 * Navbars para usuarios ya registrados
 */

?>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">League Of Teams</a>
            <button class="navbar-toggler navbar-toggler-right boxShadowBlue" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'main') { echo 'borderBot'; } ?>" href="mainPage.php">Main</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'team') { echo 'borderBot'; } ?>" href="team.php">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'shop') { echo 'borderBot'; } ?>" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'settings') { echo 'borderBot'; } ?>" href="settings.php">Settings</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="index.php?logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
