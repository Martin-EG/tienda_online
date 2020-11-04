<?php
require_once("views/includes/header.php");

if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>






<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div style="overflow:hidden; " class="col-lg-5 d-none d-lg-block bg-register-image">
            <!--
            <video autoplay muted loop id="myVideo">
                <source src="views/assets/img/vid.mp4" type="video/mp4">
            </video>
            -->
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" action="register.php" name="registerform" autocomplete="off">
                
                <div class="form-group row">
                  <div class="col-sm-4">
                    <input type="text" pattern="[a-zA-Z0-9]{2,64}" class="form-control " name="user_name" autocomplete="off" placeholder="UserName" required>
                  </div>
                  <div class="col-sm-8">
                    <input name="user_email" type="email" class="form-control " id="exampleInputEmail" placeholder="Email Address">
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-4">
                    <input type="text"  class="form-control " name="user_first_name" autocomplete="off" placeholder="First Name">
                  </div>
                  <div class="col-sm-4">
                    <input type="text"  class="form-control " name="user_last_name" autocomplete="off" placeholder="Last Name">
                  </div>
                  <div class="col-sm-4">
                    <input type="text"  class="form-control " name="user_employee_number" autocomplete="off" placeholder="Employee Number">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-4">
                      <select  name="user_areacode" id="" class="form-control">
                        <option value="">Area Code</option>
                        <option <?php if(isset($row['user_areacode'])&& $row['user_areacode'] == "+1") echo "selected" ?> value="+1">(Usa)+1</option>
                        <option <?php if(isset($row['user_areacode'])&& $row['user_areacode'] == "+52") echo "selected" ?> value="+52">(Mex)+52</option>
                      </select>
                  </div>
                  
                  <div class="col-sm-8">
                    <input type="text" name="user_phone" id="" class="form-control"  placeholder="Phone Number">
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="user_password_new" type="password" class="form-control " id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input name="user_password_repeat" type="password" class="form-control " id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
               
                <hr>
                <button type="submit"  name="register" class="btn btn-google btn-user btn-block">
                  <i class="fa fa-user-plus fa-fw"></i> Register 
                </button>
                
              </form>
              <hr>
              
              <div class="text-center">
                <a class="small" href="index.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>



<!-- backlink -->
<?php require_once("views/includes/footer.php"); ?>
