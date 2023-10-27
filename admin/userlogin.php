<?php
 include "includes/header.php";
 include "includes/topbar.php";
 $querylogin =mysqli_query($dlink,"SELECT * FROM userlogin");
 if($loginrow = mysqli_num_rows($querylogin)){
     if($loginrow>=10){
        $tableclass="dataTable";
     }else{
        $tableclass="";
     }
 }
?>

<div class="card shadow mb-4 m-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Login</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive h-100">
             <table class="table table-bordered text-capitalize" id="<?php echo $tableclass; ?>" width="100%" cellspacing="0">
                <thead>
                    <td>No</td>
                    <td>Email</td>
                    <td>User Type</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Status</td>
                </thead>
                <tbody>
                <?php
                   $querylogin =mysqli_query($dlink,"SELECT * FROM userlogin");
                   if(mysqli_num_rows($querylogin)){
                        while($userloginrow =mysqli_fetch_assoc($querylogin)){
                            static $no=0;
                             $no++;
                           echo '<tr>
                           <th>'.$no.'</th>
                           <th>'.$userloginrow['useremail'].'</th>
                           <th>'.$userloginrow['usertype'].'</th>
                           <th>'.$userloginrow['date'].'</th>
                           <th>'.$userloginrow['time'].'</th>
                           <th>'.$userloginrow['status'].'</th>
                           </tr>   ';
                        }
                   }else{
                    echo '<span >no Feedback Available</span>';
                   }
                 
                ?>
                </tbody>
             </table>
        </div>
    </div>
</div>





<?php
include "includes/footer.php";
?>