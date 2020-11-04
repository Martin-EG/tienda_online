<?php
require_once("classes/Registration.php");
$registration = new Registration();


if (isset($registration)) {
  if ($registration->errors) {
      foreach ($registration->errors as $error) {
        echo "
        <script type='text/javascript'>
          document.addEventListener('DOMContentLoaded', function(event) {
            swal('Error!','$error','error');
          });
       </script>
       ";        }
  }
  if ($registration->messages) {
      foreach ($registration->messages as $message) {
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
                <img style="width: 40%; margin-bottom:15px;" class="img-fluid rounded-circle text-center  shadow-sm" src="">
            </div>
        </div>

    </div>



    <div class="col-lg-8">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        
                <h6 class="m-0 font-weight-bold text-default">Personal Info</h6>
                        
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
                <form method="POST" id="form-machine-category" autocomplete="off">
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user_name" id="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="user_email" id="" class="form-control"  required>
                    </div>


                    <div class="row">
                      <div class="form-group col-lg-3">
                          <label>Area</label>
                          <select  name="user_areacode" id="" class="form-control">
                            <option value="">Select</option>
                            <option  value="+1">(Usa)+1</option>
                            <option  value="+52">(Mex)+52</option>
                          </select>
                      </div>

                      <div class="form-group col-lg-9">
                          <label>Phone</label>
                          <input type="text" name="user_phone" id="" class="form-control"  >
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-lg-4">
                          <label>First Name</label>
                          <input type="text" name="user_first_name" id="" class="form-control"  >
                      </div>

                      <div class="form-group col-lg-4">
                          <label>Last Name</label>
                          <input type="text" name="user_last_name" id="" class="form-control"  >
                      </div>

                      <div class="form-group col-lg-4">
                          <label>Employee Number</label>
                          <input type="text" name="user_employee_number" id="" class="form-control"  >
                      </div>

                    </div>


                    <div class="row">
                      <div class="form-group col-lg-6">
                          <label>Password</label>
                          <input type="password" name="user_password_new" id="" class="form-control"  />
                      </div>

                      <div class="form-group col-lg-6">
                          <label>Repeat Password</label>
                          <input type="password" name="user_password_repeat" id="" class="form-control" />
                      </div>
                    </div>
                    

                    <div class="form-group ">
                        
                        <button id="edit_profile1" name="register" type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-user-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Add User
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>              








