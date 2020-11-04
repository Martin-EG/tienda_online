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

$stmt = $connection->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $_GET['product']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) 
    exit('No rows');

$row = $result->fetch_array();
$stmt->close();

?>

<h1 class="h3 mb-4 text-gray-800">Product</h1>
<form method="POST" id="" autocomplete="off" enctype="multipart/form-data">
<div class="row">

    <div class="col-lg-4">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Product images</h6>
                        
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
                <input type='file' name="product_image" id="imgInp" />
                <img style="width: 100%; height:auto;" id="blah" src="<?php echo $row['product_image'] ?>" alt="<?php echo $row['product_name'] ?>" />
            </div>
        </div>

    </div>



    <div class="col-lg-8">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Product info</h6>
                        
                <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div id="profile-data" class="card-body">
                
                    

                   
                    <div class="row">

                      <div class="form-group col-lg-6">
                          <label>Product Name</label>
                          <input type="text" name="product_name" id="" class="form-control" value="<?php echo $row['product_name'] ?>">
                      </div>

                      <div class="form-group col-lg-6">
                          <label>Category</label>
                          <select  name="product_category" id="" class="form-control" required>
                            <option value="">Select</option>
                            <?php
                            $query1 = "SELECT * FROM categories WHERE cat_active = 1";
                            $result1 = mysqli_query($connection, $query1);
                            if(!$result1)
                                echo "Query Failed";

                            while($row1 = mysqli_fetch_array($result1)): 
                            ?>
                                <option <?php if($row['product_category'] == $row1['cat_id']){echo "selected";}else{echo "";} ?> value="<?php echo $row1['cat_id']; ?>"><?php echo $row1['cat_name']; ?></option>
                            <?php endwhile; ?>
                          </select>
                      </div>

            
                    </div>

                    <div class="row">
                      <div class="form-group col-lg-4">
                          <label>Price</label>
                          <input type="number" name="product_price" id="" class="form-control" step=".01" value="<?php echo $row['product_price'] ?>" >
                      </div>

                      <div class="form-group col-lg-4">
                          <label>Currency</label>
                          <select  name="product_currency_code_id" id="" class="form-control" required>
                            <option value="">Select</option>
                            <?php
                            $query2 = "SELECT * FROM currency WHERE currency_active = 1";
                            $result2 = mysqli_query($connection, $query2);
                            if(!$result2)
                                echo "Query Failed";

                            while($row2 = mysqli_fetch_array($result2)): 
                            ?>
                                <option <?php if($row['product_currency_code_id'] == $row2['currency_id']){echo "selected";}else{echo "";} ?> value="<?php echo $row2['currency_id']; ?>"><?php echo $row2['currency_code']; ?></option>
                            <?php endwhile; ?>
                          </select>
                      </div>

                      <div class="form-group col-lg-4">
                          <label>Product starting inventory</label>
                          <input  name="product_qty" id="" class="form-control" value="<?php echo $row['product_qty'] ?>" >
                      </div>

                    </div>


                    <div class="row">
                      <div class="form-group col-lg-12">
                          <label>Product Description</label>
                          <textarea name="product_description" class="form-control" rows="7"><?php echo $row['product_description'] ?></textarea>
                      </div>

                      
                    </div>
                    

                    <div class="form-group ">
                        
                        <button id="" name="update_product" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Edit Product
                        </button>
                    </div>

              
            </div>
        </div>

    </div>
</div>              

</form>






