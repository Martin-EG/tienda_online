<?php
require_once("classes/Users.php");
$user = new Users();

$stmt = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_GET['user']);
$stmt->execute();

$result = $stmt->get_result();
if($result->num_rows === 0) 
    exit('No rows');

$row = $result->fetch_array();
$stmt->close();


?>

<h1 class="h3 mb-4 text-gray-800">User Account</h1>

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
                <img style="width: 40%; margin-bottom:15px;" class="img-fluid rounded-circle text-center  shadow-sm" src="<?php echo $row['user_image'] ?>">
                <p><?php echo $row['user_name'] ?></p>
                <p class="text-dark">
                  <?php
                  if($row['user_level']== 0)
                    echo "Guest";
                  elseif($row['user_level']== 1) 
                    echo "User";
                  elseif($row['user_level']== 2)
                    echo "Admin";
                  elseif($row['user_level']== 3)
                    echo "Super Admin";  
                  ?>
                </p>
                
            </div>
        </div>

    </div>



    <div class="col-lg-8">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">User Info</h6>
                        
                <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Options:</div>
                        <a class="dropdown-item" href="index.php?page=user_update&user=<?php echo $_GET['user'] ?>">Edit this user</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div id="profile-data" class="card-body">
                <form method="POST" id="form-machine-categor1y" autocomplete="off">
                
                    <span class="d-block p-2 bg-dark text-white">Personal information</span>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">User Name</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['user_name'] ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['user_email'] ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Phone</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['user_areacode']." ".$row['user_phone'] ?>">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['user_first_name'] ?>">
                      </div>
                    </div>
                    
                    
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['user_last_name'] ?>">
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Employee Number</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php echo $row['user_employee_number'] ?>">
                      </div>
                    </div>


                    <span class="d-block p-2 bg-dark text-white">Account information</span>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Suspended</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php  echo $row['user_suspend']==0 ? 'No':'Yes' ?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Locked</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext"  value="<?php  echo $row['user_locked']==0 ? 'No':'Yes' ?>">
                      </div>
                    </div>
                    
                    <div class="form-group ">
                        
                        <button id="delete_profile1" name="delete_user" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                            <i class="fas fa-user-times fa-sm text-white-50"></i>&nbsp;&nbsp;Delete Profile
                        </button>
                    </div>

                   
                </form>
            </div>
        </div>

    </div>
</div>              
















