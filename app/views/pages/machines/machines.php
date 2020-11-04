<h1 class="h3 mb-4 text-gray-800">Machines </h1>

<div style="margin-bottom:15px;">
    <button id="add-machine" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle='modal' data-target='#addMachineModal'><i class="fas fa-plus fa-sm text-white-50"></i>Add Item</button>
    <button id="add-part" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle='modal' data-target='#moveNewPartModal'><i class="far fa-arrow-alt-circle-down text-white-50"></i>Transactions</button>
    <a  href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Generate Report</a>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
        <div class="card-body">
            <div class="table-responsive">
            <table  style="font-size: 14px; vertical-align:middle;" class="table table-striped" id="machines" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Machine</th>
                    <th>Serial No.</th>
                    <th>Control No.</th>
                    <th>Supplier</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                
                
            </table>
        </div>
    </div>
</div>









<!-- New Part Modal -->
<div class="modal fade" id="addMachineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Register new machine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form-machine" enctype="multipart/form-data">

            <div class="modal-body">

                <div class="row">
                    
                    <div class="form-group col-lg-4">
                        <label>Category</label>
                        <select class="form-control" name="machine_category" id="machine_category" required>
                            <option value="">Select</option>
                            <?php 
                            $get_cats = "SELECT * FROM machines_category WHERE machine_category_active = 1";
                            $run_get_cats = mysqli_query($connection, $get_cats);
                            while($row_cat = mysqli_fetch_array($run_get_cats)):
                            ?>
                            <option value="<?php echo $row_cat['machine_category_id']; ?>"><?php echo $row_cat['machine_category_name']; ?></option>
                            <?php endwhile; ?>
                        </select>            
                    </div>
                    
                    <div class="form-group col-lg-4">
                        <label>Machine Name</label>
                        <input class="form-control" name="machine_name" id="machine_name" required>
                    </div> 
                    
                    <div class="form-group col-lg-4">
                        <label>Machine Serial No.</label>
                        <input class="form-control" name="machine_serial" id="machine_serial" required>
                    </div>

                    <div class="form-group col-lg-4">
                        <label>Machine Control No.</label>
                        <input class="form-control" name="machine_cn" id="machine_cn" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Date of Purchase</label>
                        <input type="text" name="machine_date" id="machine_date" class="datepicker-complete form-control" data-date-format="yyyy-mm-dd" class="form-control" required>
                    </div>


                    <div class="form-group col-lg-4">
                        <label>Supplier</label>
                        <select class="form-control" name="machine_supplier" id="machine_supplier" required>
                            <option value="">Select</option>
                            <?php 
                            $get_supplier = "SELECT * FROM supplier WHERE supplier_active = 1";
                            $run_get_supplier = mysqli_query($connection, $get_supplier);
                            while($row_supplier = mysqli_fetch_array($run_get_supplier)):
                            ?>
                            <option value="<?php echo $row_supplier['supplier_id']; ?>"><?php echo $row_supplier['supplier_name']; ?></option>
                            <?php endwhile; ?>
                        </select>            
                    </div>
                
                    

                    <div class="form-group col-lg-6">
                        <label>Image</label>
                        <input type="file" class="form-control" name="machine_image" id="machine_image">
                    </div>


                    <div class="form-group col-lg-6">
                        <label>Manual/Document</label>
                        <input type="file" class="form-control" name="machine_document" id="machine_document">
                    </div>

                </div>    
               
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="add_machine"  class="btn btn-primary">Save changes</button>
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
                  <div id="list" class="col-lg-12">
                  
                  </div>
                </div>                              
                


                <div class="table-responsive">
                <table style="font-size:12px;"  class="table table-striped " id="partsmove" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th >Id</th>
                        <th >Consumable</th>
                        <th >Part No.</th>
                        <th >Name</th>
                        <th >Stock</th>
                        <th >Available</th>
                        <th >Location</th>
                        <th >Status</th>
                        <th >Image</th>
                        <th >Category</th>
                        <th >Add to list</th>
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
<div class="modal fade" id="imageMachineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
              <img class="img-fluid img-thumbnail" src="" id="image_show_machine">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
    </div>
  </div>
</div>













