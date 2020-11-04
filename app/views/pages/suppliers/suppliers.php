<h1 class="h3 mb-4 text-gray-800">Suppliers</h1>


<div class="row">

    <div class="col-lg-4">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Dropdown Card Example</h6>
                        
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
                <form method="POST" id="form-supplier" autocomplete="off">
                    <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Supplier Email</label>
                        <input type="text" name="supplier_email" id="supplier_email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="supplier_phone" id="supplier_phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Mobile Phone</label>
                        <input type="text" name="supplier_mobile" id="supplier_mobile" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Fiscal Number</label>
                        <input type="text" name="rfc" id="rfc" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Fiscal Name</label>
                        <input type="text" name="rs" id="rs" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Adress</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>
                        <textarea  name="supplier_notes" id="supplier_notes" class="form-control" required></textarea>
                    </div>



                    <div class="form-group">
                        
                        <button id="add_supplier" name="add_supplier" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>Add Supplier
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>



    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-primary">Dropdown Card Example</h6>
                        
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
            <div class="card-body">
                <div id="supplier-table-container" class="table-responsive">
                    <table style="font-size: 13px; " class="table table-hover text-center" id="suppliers" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Fiscal</th>
                            <th>Registered</th>
                            <th>Actions</th>
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



