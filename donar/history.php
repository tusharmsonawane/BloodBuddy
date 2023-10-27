<?php
   include "includes/header.php";
   date_default_timezone_set('asia/kolkata');
   $totaldonar=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail'");
   if($total = mysqli_num_rows($totaldonar)){
       if($total > 10){
           $donartable='dataTable';
       }
   }else{
    $donartable='';
   }
?>
<style>
    .history .card-body::-webkit-scrollbar{
        height:0px;
    }
</style>
<div class="p-2 h-100">
<div class="card history h-100">
                <div class="card-header py-3 position-relative">
                    <h6 class="m-0 font-weight-bold text-black text-uppercase fs-5">History </h6>
                </div>
                <div class="card-body p-2 overflow-scroll">
                <table class="table table-bordered border p-2 text-capitalize" id="<?php echo $donartable; ?>" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Appointment Id</th>
                                            <th>Blood Bank Name</th>
                                            <th>status</th>
                                            <th>date</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $queryfetch =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail' AND status='completed' OR donaremail='$useremail' AND status='decline'");
                                          if(mysqli_num_rows($queryfetch)){
                                          while($appointmentrow =mysqli_fetch_assoc($queryfetch)){
                                            $fetchbankname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$appointmentrow[bloodbankid]'");
                                            if(mysqli_num_rows($fetchbankname)){
                                               while($bankname=mysqli_fetch_assoc($fetchbankname)){
                                                   $bloodbakname=$bankname['username'];
                                               }
                                            }
                                            if($appointmentrow['status'] == 'completed'){
                                                $donarstatus ='<i class="fa-solid fa-check"></i>';
                                                }else{
                                                        if($appointmentrow['status'] == 'decline'){
                                                            $donarstatus ='<i class="fa-solid fa-ban"></i>';
                                                        }else{
                                                            $donarstatus ='';
                                                        }
                                                }
                                                static $no=0;
                                                $no++;
                                           echo '<tr>
                                           <td>'.$no.'</td>
                                           <td> '.$appointmentrow['appointmentid'].' </td>
                                           <td> '.$bloodbakname.'</td>
                                           <td> '.$donarstatus.' '.$appointmentrow['status'].'</td>
                                           <td> '.date("d-M-Y", strtotime($appointmentrow['completedate'])).'</td>
                                           <td> '.$appointmentrow['bloodbag'].'</td>
                                           <td> <a href="?did='.$appointmentrow['appointmentid'].'" class="w-100 btn btn-danger btn-block">delete</a></td>
                                       </tr>';
                                          }
                                        }else{
                                            echo '<span class="fs-5 text-uppercase" >No history found</span>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                </div>
             </div>
        </div>
</div>

<?php
if(isset($_GET['did'])){
   $appointmentid=$_GET['did'];

   $querycheckuser =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$appointmentid'");
   if(mysqli_num_rows($querycheckuser)){
       echo '<script>
       swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this history!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href="?deleteid='.$appointmentid.'";
        } else {
          swal("Your history is not delete");
        }
      });
        </script>';
   }else{
       echo '<script>swal("Something Went To Wrong");</script>';
   }
}

if(isset($_GET['deleteid'])){
    $appointmentid=$_GET['deleteid'];

    $querydeletedata=mysqli_query($dlink,"DELETE FROM donarappointment WHERE appointmentid='$appointmentid'");
    if($querydeletedata){
        echo '<script>
                swal({
                    title: "Success",
                    text: "your history is successfuly deleted!",
                    icon: "success",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="history";
                    } else {
                      swal("Your history is not delete");
                    }
                  });
             </script>';
    }else{
        echo '<script>swal("Something Went To Wrong");</script>';
    }
}
   include "includes/footer.php";
?>