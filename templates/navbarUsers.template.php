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
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'index') { echo 'borderBot'; } ?>" href="#Profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'team') { echo 'borderBot'; } ?>" href="#Team">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'market') { echo 'borderBot'; } ?>" href="#Shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger <?php if(isset($current_page) && $current_page == 'profile') { echo 'borderBot'; } ?>" href="#Settings">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
