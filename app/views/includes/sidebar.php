<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark-s sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        
        <!--<div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>-->
        <img class="img-fluid" src="views/assets/img/new.png">
        <div class="sidebar-brand-text mx-3">Lean Suite<sup>v1</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-box-open"></i>
        <span>Products</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Products:</h6>
            <a class="collapse-item" href="index.php?page=product_list">List</a>
            <a class="collapse-item" href="index.php?page=product_add">Add New</a>
            <h6 class="collapse-header">Product Categories:</h6>
            <a class="collapse-item" href="index.php?page=cat_list">View</a>
            <h6 class="collapse-header">Product Inventory:</h6>
            <a class="collapse-item" href="index.php?page=inventory_list">View Inventory</a>
            <a class="collapse-item" href="index.php?page=purchases_list">Purchases</a>
            <a class="collapse-item" href="index.php?page=losses_list">Losses</a>
          </div>
        </div>
      </li>


       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-clipboard-check"></i>
        <span>Orders</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Orders:</h6>
            <a class="collapse-item" href="index.php?page=spare_parts">Pending</a>
            <a class="collapse-item" href="index.php?page=spare_transactions">All Orders</a>
            <h6 class="collapse-header">Reports:</h6>
            <a class="collapse-item" href="index.php?page=spare_category">Generate Report</a>
          </div>
        </div>
      </li>

     


      

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Config
      </div>

       <!-- Nav Item - Utilities Collapse Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMachines" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-users"></i>
          <span>Users & Groups</span>
        </a>
        <div id="collapseMachines" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Authentication:</h6>
            <a class="collapse-item" href="index.php?page=user_list">Users</a>
            <a class="collapse-item" href="index.php?page=user_list">Groups</a>
            <h6 class="collapse-header">Configure:</h6>
            <a class="collapse-item" href="index.php?page=machine_category">Categories</a>
            <a class="collapse-item" href="index.php?page=suppliers">Suppliers</a>
          </div>
        </div>
      </li>

     

    

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
