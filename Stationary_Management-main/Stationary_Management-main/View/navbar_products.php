<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand fw-bold" href="#">A1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <?php
                $navLinks = ["Home" => "./index.php", "Products" => "./products.php", "About" => "#", "Contact" => "#"];
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
                            ? "<li><a class='dropdown-item' href='./profile.php'>Profile</a></li>
                               <li><a class='dropdown-item' href='../Controllers/User_actions/logout.php'>Logout</a></li>"
                            : "<li><a class='dropdown-item' href='../Controllers/User_actions/user_login.php'>Login</a></li>";
                        ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Dark Mode Toggle -->
<ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#" id="darkModeToggle">🌙</a>
        </li>
    </ul>
</nav>

<script>
// Dark mode toggle
const darkModeToggle = document.getElementById('darkModeToggle');
const body = document.body;

// Load dark mode preference
if (localStorage.getItem('dark-mode') === 'enabled') {
    body.classList.add('dark-mode');
    darkModeToggle.textContent = '☀️';
}

// Toggle event
darkModeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('dark-mode', 'enabled');
        darkModeToggle.textContent = '☀️';
    } else {
        localStorage.setItem('dark-mode', 'disabled');
        darkModeToggle.textContent = '🌙';
    }
});
</script>

<style>
/* Dark Mode Styles */
.dark-mode {
    background-color: #121212;
    color: #ffffff;
}
.navbar-light.dark-mode {
    background-color: #1f1f1f;
}

/* Sticky Navbar */
.sticky-top {
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 2px -2px gray;
}

/* Avatar Style */
.navbar-nav .nav-link img {
    margin-right: 8px;
}

/* Smooth Transition for Dark Mode */
body {
    transition: background-color 0.3s ease, color 0.3s ease;
}
.navbar-light {
    transition: background-color 0.3s ease;
}

/* Active Link Styling */
.navbar-nav .nav-item .active {
    font-weight: bold;
    color: #007bff !important;
}
</style>
