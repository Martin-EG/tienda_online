<h1 class="h3 mb-4 text-gray-800">Spare Parts </h1>

<div style="margin-bottom:15px;">
    <button id="add-part" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle='modal' data-target='#addPartModal'><i class="fas fa-plus fa-sm text-white-50"></i>Add Item</button>
    <button id="add-part" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle='modal' data-target='#moveNewPartModal'><i class="far fa-arrow-alt-circle-down text-white-50"></i>Transactions</button>
    <a  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Generate Report</a>
    <!--
    <button id="add-part" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle='modal' data-target='#partsRecommendedModal'><i class="far fa-arrow-alt-circle-down text-white-50"></i>Recomended parts</button>
-->
  </div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
        <div class="card-body">
            <div class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle;" class="table table-striped" id="parts" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Consumable</th>
                    <th>Part No.</th>
                    <th>Name</th>
                    <th>Cost</th>
                    <th>Stock</th>
                    <th>Available</th>
                    <th>Min Stock</th>
                    <th>Max Stock</th>
                    <th>Reorder Point</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Category</th>
                    <th>Transactions</th>
                    <th>Actions</th>
                </tr>
                </thead>                
            </table>
        </div>
    </div>
</div>


<!-------------------------------     TEMPORAL PIEZAS PARA MANT PREVENTIVO    -------------------------------->
<div class="modal fade" id="partsRecommendedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Parts recommended for preventive manteinance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>    
      <form method="post" id="form_part_recomended" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="text" id="contador_parts_recommended" name="contador_parts_recommended" value="0">
                <div class="row">
                  <div style="margin-bottom: 20px;" class="col-lg-12">
                    <h5  class="modal-title" id="">Items</h5>
                  </div>
                  <div id="list_recommend" class="col-lg-12"></div>
                </div>                              
                <div class="table-responsive">
                <table style="font-size:12px;"  class="table table-striped " id="partsrecommended" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th >Id</th>
                        <th >Part No.</th>
                        <th >Name</th>
                        <th >Cost</th>
                        <th >Available</th>
                        <th >Location</th>
                        <th >Status</th>
                        <th >Image</th>
                        <th >Category</th>
                        <th >Add</th>
                    </tr>
                    </thead>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add-recommended-parts"  class="btn btn-primary">Save Parts</button>
            </div>
      </form>
    </div>
  </div>
</div>







<!-- New Part Modal -->
<div class="modal fade" id="addPartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Register new part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form-add-part" enctype="multipart/form-data">

            <div class="modal-body">

                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label>Consumable</label>
                        <select class="form-control" name="part_consumable" id="part_consumable" required>
                            <option value="">Select</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>            
                    </div>
                    
                    <div class="form-group col-lg-4">
                        <label>Part Number</label>
                        <input class="form-control" name="part_number" id="part_number" required>
                    </div> 
                    
                    <div class="form-group col-lg-4">
                        <label>Part Name</label>
                        <input class="form-control" name="part_name" id="part_name" required>
                    </div>
                    
                    <div class="form-group col-lg-4">
                        <label>Cost</label>
                        <input class="form-control" name="part_cost" id="part_cost" required>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Initial Stock</label>
                        <input class="form-control" name="part_stock" id="part_stock" required>
                    </div>


                    <div class="form-group col-lg-4">
                        <label>Location</label>
                        <input class="form-control" name="part_location" id="part_location" required>
                    </div>
                
                    <div class="form-group col-lg-4">
                        <label>Category</label>
                        <select class="form-control" name="part_category" id="part_category" required>
                            <option value="">Select</option>
                            <?php 
                            $query = "SELECT * FROM spare_category WHERE category_active = 1";
                            $run   = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($run)):
                            ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                            <?php endwhile; ?>
                        </select>            
                    </div>

                    <div class="form-group col-lg-4">
                      <label for="min">Min Stock</label>
                      <input class="form-control" type="number" name="part_minimum_stock" id="minimum-stock" min="0" step="0.1" required>
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="min">Max Stock</label>
                      <input class="form-control" type="number" name="part_maximum_stock" id="maximum-stock" min="0" step="0.1" required>
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="min">Reorder point</label>
                      <input class="form-control" type="number" name="part_reorder_point" id="reorder-point" min="0" step="0.1" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Image</label>
                        <input type="file" class="form-control" name="part_image" id="part_image">
                    </div>

                </div>    
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add_part"  class="btn btn-primary">Save changes</button>
            </div>

      </form>

    </div>
  </div>
</div>

<!-- Edit Part Modal -->
<div class="modal fade" id="editPartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Editing <span id="part_name_edit_text"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form_edit_part" enctype="multipart/form-data">

            <div class="modal-body">

                <div class="row">
                    <input type="hidden" name="part_id_edit" id="part_id_edit">
                    <div class="form-group col-lg-4">
                        <label>Consumable</label>
                        <select class="form-control" name="part_consumable_edit" id="part_consumable_edit" required>
                            <option value="">Select</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>            
                    </div>
                    
                    <div class="form-group col-lg-4">
                        <label>Part Number</label>
                        <input class="form-control" name="part_number_edit" id="part_number_edit" required>
                    </div> 
                    
                    <div class="form-group col-lg-4">
                        <label>Part Name</label>
                        <input class="form-control" name="part_name_edit" id="part_name_edit" required>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Cost</label>
                        <input class="form-control" name="part_cost_edit" id="part_cost_edit" required>
                    </div>
                    
                    <div class="form-group col-lg-4">
                        <label>Initial Stock</label>
                        <input class="form-control" name="part_stock_edit" id="part_stock_edit" required>
                    </div>


                    <div class="form-group col-lg-4">
                        <label>Location</label>
                        <input class="form-control" name="part_location_edit" id="part_location_edit" required>
                    </div>
                
                    <div class="form-group col-lg-4">
                        <label>Category</label>
                        <select class="form-control" name="part_category_edit" id="part_category_edit" required>
                            <option value="">Select</option>
                            <?php 
                            $query = "SELECT * FROM spare_category WHERE category_active = 1";
                            $run   = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($run)):
                            ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                            <?php endwhile; ?>
                        </select>            
                    </div>

                    <div class="form-group col-lg-4">
                      <label for="min">Min Stock</label>
                      <input class="form-control" type="number" name="part_minimum_stock_edit" id="part_minimum_stock_edit" min="0" required>
                    </div>

                    <div class="form-group col-lg-4">
                      <label for="min">Max Stock</label>
                      <input class="form-control" type="number" name="part_maximum_stock_edit" id="part_maximum_stock_edit" min="0" required>
                    </div>

                    <div class="form-group col-lg-4">
                      <label for="min">Reorder point</label>
                      <input class="form-control" type="number" name="part_reorder_point_edit" id="part_reorder_point_edit" min="0" required>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Image</label>
                        <input type="file" class="form-control" name="part_image_edit" id="part_image_edit">
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Current image</label>
                        <img class="img-fluid img-thumbnail" src="" id="part_image_edit_show">
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="edit_part"  class="btn btn-primary">Save changes</button>
            </div>

      </form>

    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deletePartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5  class="modal-title" id="exampleModalLabel">Delete <span id="part_name_delete_text"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form-delete-part">

            <div class="modal-body">

                <p>
                    You are about to delete the folling part: <b><span id="part_name_delete_text2"></span></b>
                    <br>This action cannot be undone.
                </p>


                <input id="part_id_delete" type="text" name="part_id_delete" value=""> 
                            
            
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="delete-part"  class="btn btn-danger">Delete</button>
            </div>

      </form>

    </div>
  </div>
</div>

<!-- Move Part Modal -->
<div class="modal fade" id="moveNewPartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Deliver part</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form_move_part" enctype="multipart/form-data">

            <div class="modal-body">

                <input type="hidden" id="contador" name="contador">

                <div class="row">
                  <div style="margin-bottom: 20px;" class="col-lg-12">
                      <label>Responsible</label>
                      <input class="form-control" type="text" id="responsable" name="responsable" required>
                      <small>Who is responsible for this items</small>
                  </div>
                </div>
                <div class="row">
                  <div style="margin-bottom: 20px;" class="col-lg-12">
                    <h5  class="modal-title" id="">Items</h5>
                  </div>
                  <div id="list" class="col-lg-12"></div>
                </div>                              
                <div class="table-responsive">
                <table style="font-size:12px;"  class="table table-striped " id="partsmove" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th >Id</th>
                        <th >Consumable</th>
                        <th >Part No.</th>
                        <th >Name</th>
                        <th >Cost</th>
                        <th >Stock</th>
                        <th >Available</th>
                        <th>Min Stock</th>
                        <th>Max Stock</th>
                        <th>Reorder Point</th>
                        <th >Location</th>
                        <th >Status</th>
                        <th >Image</th>
                        <th >Category</th>
                        <th >Add</th>
                    </tr>
                    </thead>        
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="move-part-to"  class="btn btn-primary">Save Transaction</button>
            </div>
      </form>
    </div>
  </div>
</div>

<!-- image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
              <img class="img-fluid img-thumbnail" src="" id="image_show">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
    </div>
  </div>
</div>













