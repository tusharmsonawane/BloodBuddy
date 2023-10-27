



<?php
 if(isset($_GET['logout'])){
     echo '<script>
              swal({
                title: "Log Out",
                text: "Are you sure you want to logout",
                icon: "warning",
                buttons: true,
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                     window.location.href="includes/hospitalfiles/logout";
                } else {
                  window.location.href="index";
                }
              });
           </script>';
 }else{
    echo '';
 }
?>
</div>
<script src="asset/js/sidebar.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</body>
</html>