</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer 
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Smart Studios <?php echo date("Y") ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="views/assets/vendor/jquery/jquery.min.js"></script>
  <script src="views/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="views/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!--charts-->
  <script src="views/assets/vendor/chart.js/Chart.js"></script>
  <script src="views/assets/js/demo/chart-area-demo.js"></script>
  <script src="views/assets/js/demo/chart-pie-demo.js"></script>

  <!--switch-->
  <script src="views/assets/vendor/switch/switch.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="views/assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="views/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="views/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="views/assets/js/demo/datatables-demo.js"></script>

  <!--Ajax table scripts -->
  <script src="ajax/users/usertable.js"></script>
  <script src="ajax/cat/cattable.js"></script>
  <script src="ajax/products/producttable.js"></script>
  <script src="ajax/inventory/inventorytable.js"></script>

  <script src="ajax/main.js"></script>
  <script src="ajax/ajaxtables.js"></script>
  <script src="ajax/views.js"></script>
  
  <script src="views/assets/vendor/datepicker/js/bootstrap-datepicker.min.js"></script>


  <script>


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

  /*
    (function worker() {
    $.ajax({
        url: 'index.php', 
        success: function(data) {

        $("#table1").load(location.href+" #table1>*","");
        $("#table2").load(location.href+" #table2>*","");

        },
        complete: function() {
        // Siguiente peticion de ajax cuando la actual este terminada
        setTimeout(worker, 2000);
        
        }
    });
})();
*/
  </script>
  

</body>

</html>
