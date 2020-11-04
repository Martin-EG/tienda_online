<h1 class="h3 mb-4 text-gray-800">Preventive Maintenance. </h1>


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
                <form method="POST" id="" autocomplete="off">


                    <div class="form-group">
                        <label>Task Name</label>
                        <input type="text" name="task_name" id="task_name" class="form-control" required>
                    </div>

                    
                    <div class="form-group">
                        <label>Machine</label>
                        <select  name="machine" id="machine" class="form-control" required>
                            <option>Select</option>
                            <?php 
                            $get_users = "SELECT * FROM machines WHERE machine_active = 1";
                            $run_users = mysqli_query($connection,$get_users);
                            while($row_users = mysqli_fetch_array($run_users)):
                            ?>

                                <option><?php echo $row_users['machine_name'] ?></option>

                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Responsible</label>
                        <select  name="responsible" id="responsible" class="form-control" required>
                            <option>Select</option>
                            <?php 
                            $get_users = "SELECT * FROM users";
                            $run_users = mysqli_query($connection,$get_users);
                            while($row_users = mysqli_fetch_array($run_users)):
                            ?>

                                <option><?php echo $row_users['user_name'] ?></option>

                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Routine Start</label>
                        <input type="text" name="start_date" id="start_date" class="datepicker-complete form-control" data-date-format="yyyy-mm-dd" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Recurrence in days</label>
                        <input type="number" name="recurrence" id="recurrence" class="form-control"  required>
                    </div>


                    <div class="form-group">
                        <label>Task Description</label>
                        <textarea  name="description" id="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        
                        <button  name="add_preventive" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>Add Preventive Task
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
                    <table style="font-size: 13px; " class="table table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Machine</th>
                            <th>Responsible</th>
                            <th>Description</th>
                            <th>Recurrence</th>
                        </tr>
                        </thead>
                        <tbody id="table3">
                            <?php 
                            $query = "SELECT * FROM preventive_tasks";
                            $run = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($run)):
                            ?>

                                <tr>
                                    <td><?php echo $row['preventive_id'] ?></td>
                                    <td><?php echo $row['preventive_machine'] ?></td>
                                    <td><?php echo $row['preventive_responsible'] ?></td>
                                    <td><?php echo $row['preventive_description'] ?></td>
                                    <td><?php echo $row['preventive_recurrence'] ?></td>
                                </tr>

                            <?php endwhile; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>              





<?php addPreventive(); ?>