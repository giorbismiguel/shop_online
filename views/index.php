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
            <div class="col-lg-6 col-md-6 mt-2">
                <div class="white-box">
                    <div class="rating-stars text-center">
                        <ul class="stars" data-product-id="<?php echo $product['id'] ?>">
                            <li class="star <?php echo $product['average_score'] >= 1 ? 'selected' : '' ?>" title="Poor" data-value="1">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star <?php echo $product['average_score'] >= 2 ? 'selected' : '' ?>" title="Fair" data-value="2">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star <?php echo $product['average_score'] >= 3 ? 'selected' : '' ?>" title="Good" data-value="3">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star <?php echo $product['average_score'] >= 4 ? 'selected' : '' ?>" title="Excellent" data-value="4">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                            <li class="star <?php echo $product['average_score'] == 5 ? 'selected' : '' ?>" title="WOW!!!" data-value="5">
                                <i class="fa fa-star fa-fw"></i>
                            </li>
                        </ul>
                    </div>

                    <div class="product-img">
                        <img src="includes/images/<?php echo $product['image'] ?>">
                    </div>

                    <div class="product-bottom">
                        <div class="product-name"><?php echo $product['name'] ?></div>
                        <div class="price">
                            <span class="rupee-icon">$</span> <?php echo $product['price'] ?>
                        </div>
                        <button data-product-id="<?php echo $product['average_score'] ?>" class="blue-btn">Add to Cart</button>
                    </div>

                    <div class="product-bottom">
                        Current average rating: <span style="color:#FF912C;"><?php echo $product['average_score']?: 0 ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script src="includes/js/product.js"></script>
<?php
include_once 'partials/footer.php';
?>
