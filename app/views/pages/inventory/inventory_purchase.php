<?php
require_once("classes/Product.php");
$product = new Product();


if (isset($product)) {
  if ($product->errors) {
      foreach ($product->errors as $error) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('Error!','$error','error');
          });
       </script>
       ";        }
  }
  if ($product->messages) {
      foreach ($product->messages as $message) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('$message');
          });
       </script>
       ";
      }
  }
}

$stmt = $connection->prepare("SELECT * FROM products left join categories on products.product_category = categories.cat_id left join currency on  products.product_currency_code_id = currency.currency_id WHERE product_id = ?");
$stmt->bind_param("i", $_GET['product']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) 
    exit('No rows');

$row = $result->fetch_array();
$stmt->close();


?>

<h1 class="h3 mb-4 text-gray-800">Delete Product</h1>

<div class="row">

    <div class="col-lg-4">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Profile</h6>
                        
                <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Options:</div>
                        <a class="dropdown-item" href="#">Usage</a>
                        <a class="dropdown-item" href="#">Tasks</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Account Status</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body text-center">
                <img style="width: 40%; margin-bottom:15px;" class="img-fluid rounded-circle text-center  shadow-sm" src="<?php echo $row['product_image'] ?>">
                <p><?php echo $row['product_name'] ?></p>
            </div>
        </div>

    </div>



    <div class="col-lg-8">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Product Info</h6>
                        
                <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Options:</div>
                        <a class="dropdown-item" href="index.php?page=product_update&product=<?php echo $_GET['product'] ?>">Edit this product</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div id="profile-data" class="card-body">
                <form method="POST" id="form-machine-category" autocomplete="off">
                
                    <span class="d-block p-2 bg-dark text-white">Product information</span>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Product Name</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['product_name'] ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['cat_name'] ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Price</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['product_price'] ?>">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Currency</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['currency_code'] ?>">
                      </div>
                    </div>
                    
                    
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Inventory</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['product_qty'] ?>">
                      </div>
                    </div>

                    <span class="d-block p-2 bg-dark text-white">Purchase</span>

                    <br>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-3 col-form-label">Quantity to purchase</label>
                      <div class="col-sm-9">
                        <input type="number" name="purchase_qty" step=".01"  class="form-control" >
                      </div>
                    </div>


                    

                    <div class="form-group ">
                        <button id="" name="purchase_product" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Purchase Product
                        </button>
                    </div>


                </form>
            </div>
        </div>

    </div>
</div>              
















