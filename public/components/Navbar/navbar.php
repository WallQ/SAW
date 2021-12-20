<header>
    <nav class="p-3 color-emerald-900 sticky-top">
        <div class="container">
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <a href="/" class="text-white text-decoration-none logo">
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
                                <li><a class="dropdown-item" href="/signout">Sign Out</a></li>
                            <?php } else { ?>
                                <li><a class="dropdown-item" href="/signin">Sign In</a></li>
                                <li><a class="dropdown-item" href="/signup">Sign Up</a></li>
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
                                <a href="/signout" class="btn btn-outline-emerald fw-bold shadow-none"><i class="bi bi-person-x-fill me-2"></i></i>Sign Out</a>
                            <?php } else { ?>
                                <a href="/signin" class="btn btn-outline-emerald fw-bold shadow-none me-3"><i class="bi bi-person-fill me-2"></i>Sign In</a>
                                <a href="/signup" class="btn btn-outline-emerald fw-bold shadow-none"><i class="bi bi-person-plus-fill me-2"></i>Sign Up</a>
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