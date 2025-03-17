<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">A1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <?php
                $navLinks = ["Home" => "index.php", "Products" => "products.php", "About" => "#", "Contact" => "#"];
                foreach ($navLinks as $name => $link) {
                    $activeClass = ($name == 'Products') ? 'active' : '';
                    echo "<li class='nav-item'><a class='nav-link $activeClass' href='./$link'>$name</a></li>";
                }
                ?>
            </ul>

            <!-- Search Bar -->
            <form class="d-flex">
                <input id="searchBox" class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>

            <!-- User Controls -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./cart.php">
                        🛒 <sup><?= get_cart_item_count(); ?></sup>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        👤 <span><?= isset($_SESSION['username']) ? "Welcome " . $_SESSION['username'] : "Welcome guest"; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        echo isset($_SESSION['username'])
                            ? "<li><a class='dropdown-item' href='./users_area/profile.php'>Profile</a></li>
                               <li><a class='dropdown-item' href='./users_area/logout.php'>Logout</a></li>"
                            : "<li><a class='dropdown-item' href='./users_area/user_login.php'>Login</a></li>";
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
