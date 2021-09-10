<?php
    include_once "includes/header.php";
    include_once "includes/navbar.php";

    $product_id = $_GET['i'];
?>




<div class="container">
    <?php
        $query_products = "SELECT * FROM products WHERE product_id = $product_id";
        $result_products = $connection->query($query_products);

        if($result_products)
        {
            if($result_products->num_rows == 1)
            {
                while($row_products = $result_products->fetch_assoc())
                {
                    ?>
                    <h4 class="product-title"><?php echo $row_products['product_name'] ?></h4>
                    <div class="row">
                        <div class="col s12 m12 l4">
                            <div class="carousel">                                
                                <a class="carousel-item" id="first-image"><img src="<?php echo "../app/".$row_products['product_image'] ?>"></a>
                                <!-- <a class="carousel-item"><img src="<?php echo "../app/".$row_products['product_image'] ?>"></a>
                                <a class="carousel-item"><img src="<?php echo "../app/".$row_products['product_image'] ?>"></a> -->
                            </div>
                        </div>
                        <div class="col s12 m12 l8">
                            <strong>Precio: <p class="price" data-price="<?php echo $row_products['product_price'] ?>">$<?php echo $row_products['product_price'] ?> USD</p></strong>
                            <p class="bm-1"><strong>Descripción</strong></p>
                            <p class="tm-1"><?php echo $row_products['product_description'] ?></p>
                            <?php if($row_products['product_qty'] > 0 && $row_products['product_active'] == 1)
                                  {
                                      echo '<p class="available">Disponible</p>  <small>(Quedan '.$row_products["product_qty"].' disponibles)</small>';
                                  }
                                  else
                                  {
                                      echo '<p class="no-available">No disponible</p>';
                                  }

                            ?>
                            <br>
                            <div class="input-field">
                                <input id="quantity" type="number" min="1" max="<?php echo $row_products['product_qty']?>" onchange="verificarCantidad(this)" style="max-width: 200px;" value="1">
                                <label for="quantitiy">Cantidad</label>
                            </div>
                            <div class="row tm-5">
                                <div class="col s12 l6">
                                    <a data-id="<?php echo $product_id ?>" class="waves-effect waves-light btn amber darken-2 add_item tm-2" style="display: block"><i class="material-icons left">shopping_cart</i> Agregar al carrito</a>
                                </div>
                                <div class="col s12 l6">
                                    <a data-id="<?php echo $product_id ?>" href="shopping_cart.php" class="waves-effect waves-light btn green darken-3 buy_now tm-2" style="display: block"><i class="material-icons left">credit_card</i> Comprar ahora</a>
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



<?php
    include_once "includes/footer.php";
?>