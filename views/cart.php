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
                    <input type="number" value="<?php echo $product['quantity']; ?>" min="1"/>
                </div>
                <div class="product-removal">
                    <button class="remove-product" data-product-id="<?php echo $key; ?>">
                        Remove
                    </button>
                </div>
                <div class="product-line-price"><?php echo $product['price'] * $product['quantity']; ?></div>
            </div>
    <?php
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
            <div class="totals-value" id="cart-subtotal">71.97</div>
        </div>
        <div class="totals-item">
            <label>Tax (5%)</label>
            <div class="totals-value" id="cart-tax">3.60</div>
        </div>
        <div class="totals-item">
            <label>Shipping</label>
            <div class="totals-value" id="cart-shipping">15.00</div>
        </div>
        <div class="totals-item totals-item-total">
            <label>Grand Total</label>
            <div class="totals-value" id="cart-total">90.57</div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['shopping_cart'])) {
        ?>
        <button class="checkout">Checkout</button>
        <?php
    }
    ?>
</div>
<script src="includes/js/cart.js"></script>

<?php
include_once 'partials/footer.php';
?>
