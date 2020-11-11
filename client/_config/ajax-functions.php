<?php
    include_once "db.php";

    global $connection;

    if(isset($_GET['f']))
    {
        if($_GET['f'] == "searchQty")
        {
            $id = $_GET['i'];
            $query_selector = "SELECT * FROM products WHERE product_id = $id";
            $result_selector = $connection->query($query_selector);
            if($result_selector)
            {
                if($result_selector->num_rows == 1)
                {
                    $row_selector = $result_selector->fetch_assoc();
                    
                    echo json_encode($row_selector);
                }
            }
        }
        
        else if($_GET['f'] == "searchCategory")
        {
            $id = $_GET['i'];
            $items = array();
            if($id == 0)
                $query_selector = "SELECT * FROM products WHERE product_active = 1";
            else
                $query_selector = "SELECT * FROM products WHERE product_category = $id AND product_active = 1";

            $result_selector = $connection->query($query_selector);
            if($result_selector)
            {
                if($result_selector->num_rows > 0)
                {
                    while($row_selector = $result_selector->fetch_assoc()){
                        echo "
                        <div class=\"col s12 m6 l4\">
                            <div class=\"card hoverable\" data-id=\"{$row_selector['product_id']}\">
                                <div class=\"card-image\">
                                    <img src=\"../app/{$row_selector['product_image']}\" class=\"tm-2\">
                                    <a class=\"btn-floating halfway-fab waves-effect waves-light red tooltipped add_cart\" data-position=\"left\" data-tooltip=\"Add to cart\"><i class=\"material-icons add_cart\">add_shopping_cart</i></a>
                                </div>
                                <div class=\"card-content\">
                                    <span class=\"card-title\">{$row_selector['product_name']}</span>
                                    <span class=\"card-price\">\$<strong>{$row_selector['product_price']}</strong> USD</span>
                                    <div class=\"card-action\">
                                        <a href=\"product.php?i={$row_selector['product_id']}\" class=\"waves-effect waves-light btn blue-grey darken-1\" style=\"display: block\">See more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                else
                {
                    echo "<h3 class=\"center-align\">No se encontraron articulos..</h3>";
                }
            }
        }

        else if($_GET['f'] == "searchProduct")
        {
            $product = "%{$_POST['product']}%";
            $product_active = 1;
            
            // $query_selector = "SELECT * FROM products WHERE product_name like '%$product%' AND product_active = 1";
            // $result_selector = $connection->query($query_selector);
            
            $stmt = $connection->prepare("SELECT * FROM products WHERE product_name like ? AND product_active = ?");
            $stmt->bind_param("si", $product, $product_active);
            $stmt->execute();
            $result_selector = $stmt->get_result();
            if($result_selector)
            {
                if($result_selector->num_rows > 0)
                {
                    while($row_selector = $result_selector->fetch_assoc()){
                        echo "
                        <div class=\"col s12 m6 l4\">
                            <div class=\"card hoverable\" data-id=\"{$row_selector['product_id']}\">
                                <div class=\"card-image\">
                                    <img src=\"../app/{$row_selector['product_image']}\" class=\"tm-2\">
                                    <a class=\"btn-floating halfway-fab waves-effect waves-light red tooltipped add_cart\" data-position=\"left\" data-tooltip=\"Add to cart\"><i class=\"material-icons add_cart\">add_shopping_cart</i></a>
                                </div>
                                <div class=\"card-content\">
                                    <span class=\"card-title\">{$row_selector['product_name']}</span>
                                    <span class=\"card-price\">\$<strong>{$row_selector['product_price']}</strong> USD</span>
                                    <div class=\"card-action\">
                                        <a href=\"product.php?i={$row_selector['product_id']}\" class=\"waves-effect waves-light btn blue-grey darken-1\" style=\"display: block\">See more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
                else
                {
                    echo "<h3 class=\"center-align\">No se encontraron articulos..</h3>";
                }
            }

            $stmt->close();
        }
    }

