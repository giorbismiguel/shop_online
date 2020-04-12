<?php
include_once 'partials/head.php';
?>
<link rel="stylesheet" href="includes/css/products.css">
<div class="product-list">
    <div class="text-right">
        <a href="?load=Cart/cart" class="btn">Cart</a>
    </div>

    <h1 class="text-center mb-4" style="color: #13cfdf;">Products List</h1>

    <div class="row">
        <?php
        foreach ($products as $product) {
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="white-box">
                    <div class="product-img">
                        <img src="https://www.91-img.com/pictures/laptops/asus/asus-x552cl-sx019d-core-i3-3rd-gen-4-gb-500-gb-dos-1-gb-61721-large-1.jpg">
                    </div>
                    <div class="product-bottom">
                        <div class="product-name"><?php echo $product['name'] ?></div>
                        <div class="price">
                            <span class="rupee-icon">$</span> <?php echo $product['price'] ?>
                        </div>
                        <a href="#" data-id="<?php echo $product['id'] ?>" class="blue-btn">Add to cart</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php
include_once 'partials/footer.php';
?>
