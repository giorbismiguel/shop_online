<?php
include_once 'partials/head.php';
?>
<link rel="stylesheet" href="includes/css/cart.css">

<div class="text-right mt-4">
    <a href="?load=Index/index" class="btn">Go to Products List</a>
</div>

<h1 class="text-center" style="color: #13cfdf;">Cart</h1>

<div class="shopping-cart">
    <div class="column-labels">
        <label class="product-details">Product</label>
        <label class="product-price">Price</label>
        <label class="product-quantity">Quantity</label>
        <label class="product-removal">Remove</label>
        <label class="product-line-price">Total</label>
    </div>
    <?php
    if (isset($_SESSION['shopping_cart'])) {
        foreach ($_SESSION['shopping_cart'] as $key => $product) {
            ?>
            <div class="product">
                <div class="product-details">
                    <div class="product-title"><?php echo $product['name']; ?></div>
                </div>
                <div class="product-price"><?php echo $product['price']; ?></div>
                <div class="product-quantity">
                    <input type="number" value="<?php echo $product['quantity']; ?>" min="1"
                           data-cart-id="<?php echo $key; ?>"/>
                </div>
                <div class="product-removal">
                    <button class="remove-product" data-cart-id="<?php echo $key; ?>">
                        Remove
                    </button>
                </div>
                <div class="product-line-price"><?php echo $product['price'] * $product['quantity']; ?></div>
            </div>
            <?php
            $sub_total += $product['price'] * $product['quantity'];
        }
    } else {
        ?>
        <div class="alert alert-info text-center">Your cart is empty!</div>
        <?php
    }
    ?>

    <div class="totals">
        <div class="totals-item">
            <label>Subtotal</label>
            <div class="totals-value" id="cart-subtotal"><?php echo $sub_total; ?></div>
        </div>
        <div class="totals-item">
            <label>Shipping</label>
            <div class="totals-value">
                <select name="cart-shipping" id="cart-shipping">
                    <option value="">choose a option</option>
                    <option value="0">pick up</option>
                    <option value="5">UPS</option>
                </select>
            </div>
        </div>
        <div class="totals-item totals-item-total">
            <label>Grand Total</label>
            <div class="totals-value" id="cart-total"><?php echo $sub_total + $shipping; ?></div>
        </div>

        <h5 class="text-right">User Info</h5>
        <div class="totals-item">
            <label>Current Balance</label>
            <div class="totals-value"><?php echo $current_balance; ?></div>
        </div>
        <div class="totals-item">
            <label>Balance After Paying</label>
            <div class="totals-value" id="balance-after-paying">
                <?php echo $current_balance - ($sub_total + $shipping); ?>
            </div>
            <input type="hidden" id="current-balance" name="" value="<?php echo $current_balance; ?>">
        </div>
    </div>

    <?php
    if (isset($_SESSION['shopping_cart'])) {
        ?>
        <button type="button" class="checkout">Pay</button>
        <?php
    }
    ?>
</div>
<script src="includes/js/cart.js"></script>

<?php
include_once 'partials/footer.php';
?>
