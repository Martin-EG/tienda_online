<?php
    include_once "includes/header.php";
    include_once "includes/navbar.php";

    $busqueda = (isset($_GET['bqd']) ? $_GET['bqd'] : "");
?>




<div class="container" id="items">
    <div class="row hide-on-med-and-down" id="row-categories">
    <?php 
        $query_categories = "SELECT * FROM categories WHERE cat_active = 1";
        $result_categories = $connection->query($query_categories);
        if($result_categories)
        {
            if($result_categories->num_rows > 0)
            {
                ?>
                <ul>
                    <a data-id="0" class="category btn waves-effect waves-light blue-grey darken-1"><span data-id="0" class="category ">Todo</span></a>
                <?php
                while($row_categories = $result_categories->fetch_assoc())
                {
                    ?>
                        <a data-id="<?php echo  $row_categories['cat_id']?>" class="category btn waves-effect waves-light blue-grey darken-1"><span class="category" data-id="<?php echo  $row_categories['cat_id']?>" ><?php echo  $row_categories['cat_name']?></span></a>
                    <?php
                }
            }
        }
    ?>
                </ul>
    </div>
    <div class="row" id="row-products">
        <?php
            switch($busqueda)
            {
                case "new":
                    $query_products = "SELECT * FROM products WHERE product_active = 1 AND product_active = 1 ORDER BY `products`.`product_id` DESC LIMIT 10";
                    break;
                case "tendencies":
                    $query_products = "SELECT * FROM products WHERE product_active = 1 AND product_active = 1";
                    break;
                case "search":

                    break;   
                default:
                    $query_products = "SELECT * FROM products WHERE product_active = 1 AND product_active = 1";
                    break;
            }
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
                                    <img src="<?php echo "../app/".$row_products['product_image'] ?>" class="tm-2">
                                    <a class="btn-floating halfway-fab waves-effect waves-light red tooltipped add_cart" data-position="left" data-tooltip="Add to cart"><i class="material-icons add_cart">add_shopping_cart</i></a>
                                </div>
                                <div class="card-content">
                                    <span class="card-title"><?php echo $row_products['product_name'] ?></span>
                                    <span class="card-price">$<strong><?php echo $row_products['product_price'] ?></strong> USD</span>
                                    <div class="card-action">
                                        <a href="product.php?i=<?php echo $row_products['product_id'] ?>" class="waves-effect waves-light btn blue-grey darken-1" style="display: block">See more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        
        ?>
    </div>
</div>



<?php
    include_once "includes/footer.php";
?>