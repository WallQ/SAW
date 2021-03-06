<header>
    <nav class="p-3 color-emerald-900 sticky-top">
        <div class="container">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <a href="<?php echo HOME_URL_PREFIX;?>/" class="text-white text-decoration-none logo">
                        <i class="bi bi-tags-fill"><span class="ms-3 h4 fst-normal text-uppercase">SAW</span></i>
                    </a>
                </div>
                <div class="d-flex flex-column">
                    <div class="dropdown hamburger">
                        <button class="btn border-0 text-white shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton1">
                            <?php
                            if (isset($_SESSION['logged'])) {
                            ?>
                                <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/account">Account</a></li>
                                <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/myproducts">My Products</a></li>
                                <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/sell">Sell</a></li>                                
                                <?php 
                                    if (isset($_SESSION['level']) && $_SESSION['level'] === 'Admin') {                                    
                                ?>
                                    <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/dashboard">Dashboard</a></li>
                                <?php
                                    }
                                ?>
                                <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/signout">Sign Out</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/signin">Sign In</a></li>
                                <li><a class="dropdown-item" href="<?php echo HOME_URL_PREFIX;?>/signup">Sign Up</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row">
                        <div class="navBarController">
                            <?php
                            if (isset($_SESSION['logged'])) {
                            ?>
                                <a href="<?php echo HOME_URL_PREFIX;?>/account" class="btn btn-outline-emerald fw-bold shadow-none me-3"><i class="bi bi-person-fill me-2"></i></i>Account</a>
                                <a href="<?php echo HOME_URL_PREFIX;?>/myproducts" class="btn btn-outline-emerald fw-bold shadow-none me-3"><i class="bi bi-hexagon-fill me-2"></i></i>My Products</a>
                                <a href="<?php echo HOME_URL_PREFIX;?>/sell" class="btn btn-outline-emerald fw-bold shadow-none me-3"><i class="bi bi-cart-fill me-2"></i>Sell</a>
                                <?php 
                                    if (isset($_SESSION['level']) && $_SESSION['level'] === 'Admin') {                                    
                                ?>
                                    <a href="<?php echo HOME_URL_PREFIX;?>/dashboard" class="btn btn-outline-emerald fw-bold shadow-none me-3"><i class="bi bi-server me-2"></i>Dashboard</a>
                                <?php
                                    }
                                ?>
                                <a href="<?php echo HOME_URL_PREFIX;?>/signout" class="btn btn-outline-emerald fw-bold shadow-none"><i class="bi bi-person-x-fill me-2"></i>Sign Out</a>
                            <?php } else { ?>
                                <a href="<?php echo HOME_URL_PREFIX;?>/signin" class="btn btn-outline-emerald fw-bold shadow-none me-3"><i class="bi bi-person-fill me-2"></i>Sign In</a>
                                <a href="<?php echo HOME_URL_PREFIX;?>/signup" class="btn btn-outline-emerald fw-bold shadow-none"><i class="bi bi-person-plus-fill me-2"></i>Sign Up</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>