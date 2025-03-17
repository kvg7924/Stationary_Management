<?php include("product_details_layout.php"); ?>

<!-- Product Details -->
<div class="prod-details">
    <div class="container">
        <div class="sub-container pt-4 pb-4">
            <?php viewDetails(); ?>
        </div>
    </div>
</div>

<!-- Related Products -->
<div class="products">
    <div class="container">
        <div class="categ-header">
            <span class="shape"></span>
            <span class="title">Related Products</span>
        </div>
        <h2>Discover More Products</h2>
        <div class="row mb-3">
            <?php getProduct(3); cart(); ?>
        </div>
        <div class="view d-flex justify-content-center align-items-center">
            <button onclick="location.href='./products.php'">View More Products</button>
        </div>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.js"></script>
<script src="./assets/js/script.js"></script>

<script>
    document.querySelectorAll('.side-nav a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const filterType = this.textContent.trim().toLowerCase();
            fetch(`./functions/filter_products.php?filter_type=${filterType}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('product-container').innerHTML = data;
                });
        });
    });
</script>

</body>
</html>
