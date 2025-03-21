<?php
include('header.php'); // Include the header and navigation bar
?>

<!-- Start Table Section -->
<div class="landing">
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <table class="table table-bordered table-hover table-striped table-group-divider text-center">
                <?php
                $user_ip = getIPAddress();
                $total_price = 0;
                $cart_query = "SELECT * FROM `card_details` WHERE ip_address='$user_ip'";
                $cart_result = mysqli_query($con, $cart_query);
                $cart_item_count = mysqli_num_rows($cart_result);

                if ($cart_item_count > 0) {
                    echo "<thead><tr><th>Product Title</th><th>Product Image</th><th>Quantity</th><th>Total Price</th><th>Remove</th><th colspan='2'>Operations</th></tr></thead><tbody>";
                    while ($row = mysqli_fetch_array($cart_result)) {
                        $product_id = $row['product_id'];
                        $product_quantity = $row['quantity'];
                        $select_product_query = "SELECT * FROM `products` WHERE product_id=$product_id";
                        $select_product_result = mysqli_query($con, $select_product_query);
                        while ($row_product_price = mysqli_fetch_array($select_product_result)) {
                            $price_table = $row_product_price['product_price'];
                            $product_title = $row_product_price['product_title'];
                            $product_image_one = $row_product_price['product_image_one'];
                            $total_price += $price_table * $product_quantity;
                            echo "
                            <tr>
                                <td>$product_title</td>
                                <td><img src='./admin/product_images/$product_image_one' class='img-thumbnail' alt='$product_title'></td>
                                <td><input type='number' class='form-control w-50 mx-auto' min='1' name='qty_$product_id' value='$product_quantity'></td>
                                <td>$price_table</td>
                                <td><input type='checkbox' name='removeitem[]' value='$product_id'></td>
                                <td><input type='submit' value='Update' class='btn btn-dark' name='update_cart'></td>
                                <td><input type='submit' value='Remove' class='btn btn-primary' name='remove_cart'></td>
                            </tr>";
                        }
                    }
                } else {
                    echo "<h2 class='text-center text-danger'>Your cart is empty</h2>";
                }
                ?>
                </tbody>
            </table>
            <?php
            if ($cart_item_count > 0) {
                echo "
                <div class='d-flex align-items-center gap-4 flex-wrap'>
                    <h4>Sub-Total: <strong class='text-2'>$total_price</strong></h4>
                    <input type='submit' value='Continue Shopping' class='btn btn-dark' name='continue_shopping'>
                    <input type='submit' value='Checkout' class='btn btn-dark' name='checkout'>
                </div>";
            } else {
                echo '
                <div class="empty-cart-message">
                    <h2>Your cart is empty</h2>
                    <a href="./products.php" class="btn btn-primary mt-3">Continue Shopping</a>
                </div>';
            }
            ?>
        </form>
        <div class="modal fade" id="cartSummaryModal" tabindex="-1" aria-labelledby="cartSummaryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartSummaryModalLabel">Cart Summary</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Total Price: <strong>$<?php echo $total_price; ?></strong></p>
                        <p>Apply Coupon:</p>
                        <input type="text" name="coupon_code" class="form-control" placeholder="Enter Coupon Code">
                        <button class="btn btn-success mt-2" type="submit" name="apply_coupon">Apply Coupon</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Proceed to Checkout" class="btn btn-primary" name="checkout_now">
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                $delete_query = "DELETE FROM `card_details` WHERE product_id=$remove_id";
                mysqli_query($con, $delete_query);
            }
            echo "<script>window.open('cart.php','_self');</script>";
        }

        if (isset($_POST['update_cart'])) {
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'qty_') !== false) {
                    $product_id = substr($key, 4);
                    $new_qty = (int)$value;
                    $update_query = "UPDATE `card_details` SET quantity=$new_qty WHERE product_id=$product_id AND ip_address='$user_ip'";
                    mysqli_query($con, $update_query);
                }
            }
            echo "<script>window.open('cart.php','_self');</script>";
        }

        if (isset($_POST['apply_coupon'])) {
            // Example coupon logic: 10% off
            $coupon_code = $_POST['coupon_code'];
            if ($coupon_code == 'DISCOUNT10') {
                $discount = $total_price * 0.10;
                $total_price -= $discount;
                echo "<script>alert('Coupon Applied! You saved $$discount');</script>";
            } else {
                echo "<script>alert('Invalid Coupon Code');</script>";
            }
        }
        ?>
    </div>
</div>

<script src="./assets/js/bootstrap.bundle.js"></script>
<script>
    // Hover effect on cart icon to show total price
    const cartIcon = document.querySelector('.cart-icon');
    const totalPrice = document.querySelector('.total-price');
    cartIcon.addEventListener('mouseenter', () => {
        totalPrice.classList.remove('d-none');
    });
    cartIcon.addEventListener('mouseleave', () => {
        totalPrice.classList.add('d-none');
    }); 
    // Confirm Remove Item
    function confirmRemove() {
        return confirm("Are you sure you want to remove this item from the cart?");
    }
</script>
</body>
</html>