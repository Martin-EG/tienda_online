<?php
    include_once "includes/header.php";
    include_once "includes/navbar.php";

?>




<div class="container" id="items">
    <div class="row">
        <?php
            $query_products = "SELECT * FROM products";
            $result_products = $connection->query($query_products);

            if($result_products)
            {
                if($result_products->num_rows > 0)
                {
                    while($row_products = $result_products->fetch_assoc())
                    {
                        ?>
                        
                        <div class="col s12 m6 l4">
                            <div class="card hoverable" data-id="<?php echo $row_products['product_id'] ?>">
                                <div class="card-image">
                                    <img src="<?php echo "../app/".$row_products['product_image'] ?>">
                                    <a class="btn-floating halfway-fab waves-effect waves-light red tooltipped add_cart" data-position="left" data-tooltip="Add to cart"><i class="material-icons add_cart">add_shopping_cart</i></a>
                                </div>
                                <div class="card-content">
                                    <span class="card-title"><?php echo $row_products['product_name'] ?></span>
                                    <span class="card-price">$<strong><?php echo $row_products['product_price'] ?></strong> USD</span>
                                    <div class="card-action">
                                        <a href="product.html" class="waves-effect waves-light btn blue-grey darken-1" style="display: block">See more</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
            }
        
        ?>
        <!-- <div class="col s12 m6 l4">
            <div class="card hoverable" data-id="1">
                <div class="card-image">
                    <img src="assets/img/mouse.jpg">
                    <a class="btn-floating halfway-fab waves-effect waves-light red tooltipped add_cart" data-position="left" data-tooltip="Add to cart"><i class="material-icons add_cart">add_shopping_cart</i></a>
                </div>
                <div class="card-content">
                    <span class="card-title">AmazonBasics, Ratón inalámbrico, Negro</span>
                    <span class="card-price">$<strong>275</strong> MXN / $<strong>13.09</strong> USD</span>
                    <div class="card-action">
                        <a href="product.html" class="waves-effect waves-light btn blue-grey darken-1" style="display: block">See more</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>



<?php
    include_once "includes/footer.php";
?>