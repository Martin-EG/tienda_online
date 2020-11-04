<h1 class="h3 mb-4 text-gray-800">Machines Or Resources</h1>


<div class="row">

    <div class="col-lg-4">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-primary">Create a task</h6>
                        
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
            <div class="card-body">
                <form method="POST" id="form-category" autocomplete="off">
                    
                    <div class="form-group">
                        <label>Machine Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Machine Serial Number</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Machine Control Number</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Date of Purchase</label>
                        <input type="text" name="category_name" id="category_name" class="datepicker form-control" data-date-format="mm/dd/yyyy" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Supplier</label>
                        <select  name="responsible" id="responsible" class="form-control" required>
                            <option>Select</option>
                            <?php 
                            $get_supplier = "SELECT * FROM supplier";
                            $run_supplier = mysqli_query($connection,$get_supplier);
                            while($row_supplier = mysqli_fetch_array($run_supplier)):
                            ?>

                                <option value="<?php echo $row_supplier['supplier_id'] ?>"><?php echo $row_supplier['supplier_name'] ?></option>

                            <?php endwhile; ?>
                        </select>
                    </div>

                   

                    <div class="form-group">
                        
                        <button id="add_category" name="add_category" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>Add Task
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>




    <div class="col-lg-8">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-primary">Tasks</h6>
                        
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
            <div class="card-body">
                <div id="category-table-container" class="table-responsive">
                    <table style="font-size: 13px; " class="table table-hover text-center" id="example" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Task</th>
                            <th>Task Name</th>
                            <th>Responsible</th>
                            <th>Promise Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>              






<!-- Edit Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Editing <span id="cat-title"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form-edit-category">

            <div class="modal-body">

                
                <input id="category_id" type="hidden" name="category_id" value=""> 
                <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" name="category_name_edit" id="category_name_edit" value="">            
                </div>             
            
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="edit-category"  class="btn btn-primary">Save changes</button>
            </div>

      </form>

    </div>
  </div>
</div>



<!-- Delete Modal -->
<div class="modal fade" id="deleteCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5  class="modal-title" id="exampleModalLabel">Delete <span id="cat-title-delete"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form-delete-category">

            <div class="modal-body">

                <p>
                    You are about to delete the folling category: <b><span id="cat-title-delete2"></span></b>
                    <br>This action cannot be undone.
                </p>


                <input id="category_id_delete" type="hidden" name="category_id_delete" value=""> 
                            
            
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="delete-category"  class="btn btn-danger">Delete</button>
            </div>

      </form>

    </div>
  </div>
</div>



