<?php
include_once 'partials/head.php';
?>
<link rel="stylesheet" href="includes/css/cart.css">

<div class="text-right mt-4">
    <a href="?load=Index/products" class="btn">Go to Products List</a>
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

    <div class="product">
        <div class="product-details">
            <div class="product-title">Nike Flex Form TR Women's Sneaker</div>
            <p class="product-description"> It has a lightweight, breathable mesh upper with forefoot cables for a
                locked-down fit.</p>
        </div>
        <div class="product-price">12.99</div>
        <div class="product-quantity">
            <input type="number" value="2" min="1">
        </div>
        <div class="product-removal">
            <button class="remove-product">
                Remove
            </button>
        </div>
        <div class="product-line-price">25.98</div>
    </div>

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

    <button class="checkout">Checkout</button>
</div>
<script src="includes/js/cart.js"></script>

<?php
include_once 'partials/footer.php';
?>
