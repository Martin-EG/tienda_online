<h1 class="h3 mb-4 text-gray-800">Corrective Maintenance </h1>


<div class="row">
    <div class="col-lg-12">
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
                    <table style="font-size: 13px; " class="table table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Start</th>
                            <th>Machine</th>
                            <th>Error</th>
                            <th>Additional</th>
                            <th>Status</th>
                            <th>Downtime</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="table1">
                            <?php 
                            $query = "SELECT * FROM corrective 
                            LEFT JOIN errors ON corrective.corrective_error = errors.error_id 
                            LEFT JOIN machines ON corrective.corrective_machine = machines.machine_id ";
                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($result)):
                            ?>

                            <tr>
                                <td><?php echo $row['corrective_id'] ?></td>
                                
                                <td><?php echo $row['corrective_start'] ?></td>
                                
                                <td><?php echo $row['machine_name'] ?></td>
                                
                                <td><?php echo $row['error_name'] ?> </td>
                                
                                <td><?php echo $row['additional'] ?> </td>
                                
                                <td>
                                    <?php 
                                    if($row['corrective_status']==0)
                                        echo "<span class='text-danger'>Down</span>";
                                    elseif($row['corrective_status']==1)    
                                        echo "<span class='text-dark'>Maintenance by: ".$row['corrective_a']."</span>";
                                    else
                                        echo "Data Not Available";     
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    //echo date_format(date_create($row['corrective_start']), "m-d-Y H:i:s");
                        
                                    $start_date = new DateTime($row['corrective_start']);
            
                                    //echo date("Y-m-d H:i:s");
                                    $hoy = date("Y-m-d H:i:s");
            
                                    $since_start = $start_date->diff(new DateTime($hoy));
                                    $td = $since_start->days.' total days<br>';
                                    $y  = $since_start->y.' years';
                                    $mo =$since_start->m.' months';
                                    $d = $since_start->d.' days ';
                                    $h = $since_start->h.' hours ';
                                    $m = $since_start->i.' mins ';
                                    $s = $since_start->s.' segs ';    
            
                                    echo $d." ".$h." ".$m." ".$s." ago";
                                    ?>
                                </td>
                                
                                <td>
                                    <?php 
                                    if($row['corrective_status']==0) 
                                        echo  "<a style='text-decoration: none;' class='btn btn-danger respond-corrective' data-error='{$row['error_name']}' data-id='{$row['corrective_id']}' data-machine='{$row['machine_name']}' data-toggle='modal' data-target='#correctiveRespondModal' href='#'>Respond&nbsp;&nbsp;<i class='fas fa-exclamation-triangle '></i> </a>";
                                    elseif($row['corrective_status']==1)
                                        echo  '<a style="text-decoration: none;" class="btn btn-warning" href="#">Solve&nbsp;&nbsp;&nbsp;<i class="fas fa-check-square"></i> </a>';
                                    ?>
                                </td>
                            </tr>

                            <?php 
                            endwhile;
                            ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>              






<!-- Edit Modal -->
<div class="modal fade" id="correctiveRespondModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLabel">Responding </span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form method="post" id="form-edit-category">

            <div class="modal-body">

                Responding to: <b><span id="error_respond"></span></b> On <b><span id="machine_respond"></span></b>
                

                <div class="form-group">
                    <label>User Responding</label>
                    <select name="corrective_a" class="form-control" required>
                        <option value="">Select</option>
                        <?php 
                        $select_users = "SELECT * FROM users";
                        $run_select_users = mysqli_query($connection, $select_users);
                        while($row_users = mysqli_fetch_array($run_select_users)):
                        ?>
                            <option><?php echo $row_users['user_name'] ?></option>
                        <?php 
                        endwhile
                        ?>
                    </select>
                </div>

                <input id="corrective_id" type="hidden" name="corrective_id" value=""> 
                         
            
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="" name="respond_corrective"  class="btn btn-primary">Respond</button>
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



<?php respondCorrective(); ?>
