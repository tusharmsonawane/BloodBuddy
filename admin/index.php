<?php
 include "includes/header.php";
 include "includes/topbar.php";
 $querytotaldonar =mysqli_query($dlink,"SELECT * FROM donarregister");
 if($donarrow = mysqli_num_rows($querytotaldonar)){
    $donarrow;
 }else{
     $donarrow;
 }
 $querytotalhospital =mysqli_query($dlink,"SELECT * FROM hospitalregister");
 if($hospitalrow = mysqli_num_rows($querytotalhospital)){
      $hospitalrow;
 }else{
     $hospitalrow;
 }
 $querytotalbloodbank =mysqli_query($dlink,"SELECT * FROM bloodbankregister");
 if($bloodbankrow = mysqli_num_rows($querytotalbloodbank)){
      $bloodbankrow;
 }else{
     $bloodbankrow;
 }
?>

<?php
if(isset($_GET['admin'])){
    echo '<div class="p-2 ">
    <div class="card">
         <div class="table-responsive ">
             <table class="table table-bordered text-capitalize" width="100%" cellspacing="0">
                  <thead>
                    <tr class="text-bold bg-dark text-white">
                        <td>No</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Type</td>
                        <td>Delete</td>
                    </tr>
                  </thead>
                  <tbody>';
    $queryadmin =mysqli_query($dlink,"SELECT * FROM adminregister");
    if(mysqli_num_rows($queryadmin)){
        
         while($adminrow=mysqli_fetch_assoc($queryadmin)){
            echo '
                            <tr>
                                <th>'.$adminrow['id'].'</th>
                                 <th>'.$adminrow['adminname'].'</th>
                                 <th>'.$adminrow['adminemail'].'</th>
                                 <th>'.$adminrow['admintype'].'</th>
                                 <th><a href="?did='.$adminrow['adminemail'].'" class="btn btn-danger btn-block">Delete</a></th>
                            </tr>
            ';
         }
         echo ' </tbody>
         </table>
     </div>
</div>
</div>';
    }else{
        echo "<srcipt>window.location.href='index.php'</script>";
    }
}else{
    echo '<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1">
                                Donor</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                              '.$donarrow.'
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">
                                Hospital</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            '.$hospitalrow.'
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-warning text-uppercase mb-1">
                                Blood Bank</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                '.$bloodbankrow.'
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-building-columns fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card w-100 mx-0 mx-3 shadow-lg">
        <div id="piechart_3d" class="overflow-scroll" style="width: 500px; height: 350px;"></div>
        </div>';
}

if(isset($_GET['did'])){
    $adminemail =$_GET['did'];

    $querydele=mysqli_query($dlink,"SELECT * FROM adminregister WHERE adminemail='$adminemail'");
    if(mysqli_num_rows($querydele)){
        echo '<script>
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this admin data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
               window.location.href="?deleteid='.$adminemail.'";
            } else {
                window.location.href="index";              
            }
          });
          
        </script>';
    }
}

if(isset($_GET['deleteid'])){
    $adminemail =$_GET['deleteid'];

    $querydelete =mysqli_query($dlink,"SELECT * FROM adminregister WHERE adminemail='$adminemail'");
    if(mysqli_num_rows($querydelete)){
           $querydeleted =mysqli_query($dlink,"DELETE FROM adminregister WHERE adminemail='$adminemail'");
           if($querydeleted){
               echo '<script>
                swal({
                    title: "Success",
                    text: "successfuly deleted",
                    icon: "success",
                });
               </script>';
           }
    }else{

    }
}
?>



<?php
include "includes/footer.php";
?>
<script>
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Donor = <?php  echo $donarrow; ?>',     <?php  echo $donarrow; ?>],
    ['Hospital = <?php  echo $hospitalrow; ?>',      <?php  echo $hospitalrow; ?>],
    ['Bloodbank = <?php  echo $bloodbankrow; ?>',  <?php  echo $bloodbankrow; ?>]
  ]);

  var options = {
    title: 'User Registration',
    is3D: true,
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
  chart.draw(data, options);
}
</script>