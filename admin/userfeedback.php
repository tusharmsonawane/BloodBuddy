<?php
 include "includes/header.php";
 include "includes/topbar.php";
 $queryfeedback =mysqli_query($dlink,"SELECT * FROM userfeedback");
    if($feedbackrow = mysqli_num_rows($queryfeedback)){
        if($feedbackrow >=10){
            $tableclass="dataTable";
        }else{
            $tableclass="";
        }
    }
?>

<div class="card shadow mb-4 m-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Feedback</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
             <table class="table table-bordered text-capitalize" id="<?php echo $tableclass; ?>" width="100%" cellspacing="0">
                <thead>
                    <td>No</td>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Email</td>
                    <td>Mobile Number</td>
                    <td>Message</td>
                </thead>
                <tbody>
                <?php
                   $queryfeedback =mysqli_query($dlink,"SELECT * FROM userfeedback");
                   if(mysqli_num_rows($queryfeedback)){
                        while($feedbackrow =mysqli_fetch_assoc($queryfeedback)){
                            static $no=0;
                             $no++;
                           echo '<tr>
                           <th>'.$no.'</th>
                           <th>'.$feedbackrow['firstname'].'</th>
                           <th>'.$feedbackrow['lastname'].'</th>
                           <th>'.$feedbackrow['email'].'</th>
                           <th>'.$feedbackrow['mobileno'].'</th>
                           <th>'.$feedbackrow['message'].'</th>
                           </tr>   ';
                        }
                   }else{
                    echo '<span >No Feedback Available</span>';
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