<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="views/assets/img/new.png" />


  <title>Smart Panel</title>

  <!-- Custom fonts for this template-->
  <link href="views/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="views/assets/css/sb-admin-2.css" rel="stylesheet">

   <!-- Custom styles for this page -->
   <link href="views/assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

   <link href="views/assets/vendor/datepicker/css/bootstrap-datepicker.css" rel="stylesheet">

   <script src="views/assets/vendor/sweetalert/swal.js"></script>

   <script src="views/assets/vendor/switch/switch.css"></script>


   <style>

    tr{
      font-size: 12px;
    }

    .btn-primary{
      background-color: #039be5;
    }

    .options:hover{
      color:black !important;;
    }


    .table-responsive{
      width: 100%;
    }

    .card-header{
      background-color: #fff;
      border-bottom: #fff;
    }

    td{
      vertical-align: middle;
    }

    .odd{
      vertical-align: middle;
    }

    .even{
      vertical-align: middle;
    }

    .user-img{
      width: 60px;
      height: auto;
      text-align: center;
    }

     .bg-white-s{
       background-color: #fff;
     }
     .bg-dark-s{
       background-color: #242424;
     }

     .form-control{
       border-radius: 0;
     }

     .form-control:focus {
        /*border-color: #000;*/
        box-shadow: inset 1px  rgba(0, 0, 0, 0.075), 0 0 8px rgba(0, 0, 0, 0.6);
      }






      /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
  /*float:right;*/
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input.default:checked + .slider {
  background-color: #444;
}
input.primary:checked + .slider {
  background-color: #2196F3;
}
input.success:checked + .slider {
  background-color: #8bc34a;
}
input.info:checked + .slider {
  background-color: #3de0f5;
}
input.warning:checked + .slider {
  background-color: #FFC107;
}
input.danger:checked + .slider {
  background-color: #f44336;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}





   </style>

</head>
