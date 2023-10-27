<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');

if(isset($_POST['bookappointment'])){
    $bloodbankid = $_POST['bloodbankid'];
    $bloodbankdate = $_POST['bloodbankdate'];
    $donardisease = $_POST['donardisease'];
    $donarappointmentid =rand(11111111,99999999);
    $currentdate=date("Y-m-d");
    $date1=date_create($currentdate);
    $date2=date_create($completedate);
    

    $datediff= date_diff($date1, $date2);
    $donardatecheck=$datediff->format("%a");

    if(empty($bloodbankid) && empty($bloodbankdate) && empty($donardisease)){
         $_SESSION['appointmenterror'] ="PLEASE FILLED THE DETAILS";
    }else{
        if(empty($bloodbankid)){
            $_SESSION['appointmenterror'] ="SOMETHING WENT TO WRONG";
        }else{
            if($donardisease == 'yes'){
                $_SESSION['appointmenterror'] ="SORRY!YOUR ARE NOT ABLE TO SEND REQUEST";
           }else{
            if($donardatecheck >=45){
                $querybloodbankcheck =mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$bloodbankid'");
                if(mysqli_num_rows($querybloodbankcheck)){
                               $donarcheck =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail'");
                               if(mysqli_num_rows($donarcheck)){
                                   $queryappointmentcheck=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail' AND status='pendding' OR donaremail='$useremail' AND status='accept'");
                                   if(mysqli_num_rows($queryappointmentcheck)){
                                       $_SESSION['appointmenterror'] ="WAIT FOR ACCEPTING THE  PREVIOUS REQUEST";
                                   }else{
                                           $queryappointmentcomplete =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail' AND status='completed'");
                                           if(mysqli_num_rows($queryappointmentcomplete)){
   
                                                   $querybookaccpointment=mysqli_query($dlink,"INSERT INTO donarappointment(appointmentid,donaremail,donarname,donarid,bloodbankid,bookdate,status,completedate,completetime,bloodbag) VALUES('$donarappointmentid','$useremail','$username','$donarid','$bloodbankid','$bloodbankdate','pendding','','','0')");
                                                   if($querybookaccpointment){
                                                       $_SESSION['appointmentsuccess'] ="YOUR REQUEST SEND TO BLOODBANK";
                                                   }else{
                                                       $_SESSION['appointmenterror'] ="SOMETHING WENT TO WRONG";
                                                   }
                                           }else{
                                               $queryappointmentcomplete =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail' AND status='decline'");
                                               if(mysqli_num_rows($queryappointmentcomplete)){
     
                                                       $querybookaccpointment=mysqli_query($dlink,"INSERT INTO donarappointment(appointmentid,donaremail,donarname,donarid,bloodbankid,bookdate,status,completedate,completetime,bloodbag) VALUES('$donarappointmentid','$useremail','$username','$donarid','$bloodbankid','$bloodbankdate','pendding','','','0')");
                                                       if($querybookaccpointment){
                                                           $_SESSION['appointmentsuccess'] ="YOUR REQUEST SEND TO BLOODBANK";
                                                       }else{
                                                           $_SESSION['appointmenterror'] ="SOMETHING WENT TO WRONG";
                                                       }
                                                   
                                               }else{
                                                   $_SESSION['appointmenterror'] ="WAIT FOR ACCEPTING THE  PREVIOUS REQUEST";
                                               }
                                           }
                                   }
                               }else{
                                       $querybookaccpointment=mysqli_query($dlink,"INSERT INTO donarappointment (appointmentid,donaremail,donarname,donarid,bloodbankid,bookdate,status,completedate,completetime,bloodbag) VALUES('$donarappointmentid','$useremail','$username','$donarid','$bloodbankid','$bloodbankdate','pendding','','','0')");
                                           if($querybookaccpointment){
                                               $_SESSION['appointmentsuccess'] ="YOUR REQUEST SEND TO BLOODBANK";
                                           }else{
                                               $_SESSION['appointmenterror'] ="SOMETHING WENT TO WRONG";
                                           }
                               }
                }else{
                   $_SESSION['appointmenterror'] ="BLOODBANK ARE NOT AVAILABLE";
                }
            }else{
                $_SESSION['appointmenterror'] ="YOU SHOULD TAKE 45 DAYS REST TIME";
            }
           }
        }
    }
}

    if(isset($_GET['cancle'])){
        $cancleid = $_GET['cancle'];
        $querycancle=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$cancleid'");
        if(mysqli_num_rows($querycancle)){
            echo '<script>
                swal({
                    title: "ARE YOU SURE?",
                    text: "Once cancle, you will not be able to recover the request!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="?confirmid='.$_GET['cancle'].'";
                    } else {
                    swal("Your request is still pendding!")
                            .then((willDelete) => {
                                if (willDelete) {
                                window.location.href="donarappointment";
                                }
                            });
                    }
                });
            </script>';
        }else{
             echo "<script>window.location.href='donarappointment'</script>";
        }
    }else{
       echo "";
    }

    if(isset($_GET['confirmid'])){
        $confirmid = $_GET['confirmid'];
        $querycancle=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$confirmid' AND status='pendding' OR appointmentid='$confirmid' AND status='accept'");
        if(mysqli_num_rows($querycancle)){
             $queryupdate =mysqli_query($dlink,"UPDATE donarappointment SET status='decline' WHERE appointmentid='$confirmid'");
             if($queryupdate){
                echo '<script>
                    swal({
                        text: "You succesfuly cancled this request!",
                        icon: "success",
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                           window.location.href="donarappointment";
                        }
                      });
                </script>';
             }
        }else{
            echo '<script>
            swal("Your request is still pendding!");
            </script>';
        }
    }else{
      
    }

  
    ?>


<style>
    .table-responsive{
        width:100%;
    }

</style>
<div class="p-2 h-100">
<div class="card  appointment h-100">
                <div class="card-header py-3  position-relative">
                    <h6 class="m-0 font-weight-bold text-black text-uppercase fs-5">Donor</h6>
                    <a href="#" class="btn btn-primary shadow border-primary border-outline float-end position-absolute end-0 top-0 mt-2 mx-3 p-2" data-bs-toggle="modal" data-bs-target="#BookAppointment">Book Appointment</a>
                </div>
                <div class="card-body p-2 mt-2 text-capitalize">
                   <div class="table-responsive position-relative">
                    <?php
                    
                    $querycheckdata=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donaremail='$useremail' AND status='pendding' OR donaremail='$useremail' AND status='accept'");
                    if($appointmentrow=mysqli_num_rows($querycheckdata)){
                        if($appointmentrow >= 10){
                           $tableclass="dataTable";
                        }else{
                           $tableclass="";
                        }
                   }
                   ?>
                   <table class="table table-bordered border" id="<?php echo $tableclass; ?>" width="100%" cellspacing="1">
                    
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Appointment Id</th>
                                <th>Blood Bank Name:</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                        </thead>                       
                        <tbody>
                           
                            <?php
                              $querycheckdata=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE donarid='$donarid' AND status='pendding' OR donarid='$donarid' AND status='accept'");
                              if(mysqli_num_rows($querycheckdata)){
                                 while($appointmentrow =mysqli_fetch_assoc($querycheckdata)){
                                    $fetchbankname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$appointmentrow[bloodbankid]'");
                                    if(mysqli_num_rows($fetchbankname)){
                                       while($bankname=mysqli_fetch_assoc($fetchbankname)){
                                           $bloodbakname=$bankname['username'];
                                       }
                                    }
                                    if($appointmentrow['status'] == 'pendding'){
                                        $donarstatus ='<div class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>';
                                        }else{
                                                if($appointmentrow['status'] == 'accept'){
                                                    $donarstatus ='<i class="fa-solid fa-check"></i>';
                                                }else{
                                                    $donarstatus ='';
                                                }
                                        }
                                          static $no =0;
                                          $no++;
                                     echo '
                                     <tr>
                                     <td>'.$no.' </td>
                                     <td> '.$appointmentrow['appointmentid'].'</td>
                                     <td> '.$bloodbakname.'</td>
                                     <td> '.date("d-M-Y", strtotime($appointmentrow['bookdate'])).'</td>
                                     <td><span class="tabletitle">'.$donarstatus.' '.$appointmentrow['status'].'</span></td>
                                     <td><a href="donarappointment?cancle='.$appointmentrow['appointmentid'].'" class="btn btn-danger w-100">cancle</a></td>
                                     </tr>  ';
                                 }
                                
                              }else{
                                echo '<span class="fs-5 text-uppercase" >No Information Are Available</span>';
                              }
                            ?>
                                           
                        </tbody>
                    </table>
                   </div>
                </div>
             </div>
        </div>
</div>

        <div class="modal fade" id="BookAppointment">
             <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-uppercase">Appointment</h4>
                        <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="modal-body">
                        <form  method="post">
                            <select name="bloodbankid" id="" class="form-control text-capitalize" >
                                <?php
                                $queryfetchbloodbank=mysqli_query($dlink,"SELECT * FROM  userregister WHERE usertype='bloodbank'");
                                 if(mysqli_num_rows($queryfetchbloodbank)){
                                    while($bloodbankrow=mysqli_fetch_assoc($queryfetchbloodbank)){
                                        echo '<option value="'.$bloodbankrow['userid'].'">'.$bloodbankrow['username'].'</option>';
                                    }
                                 }else{
                                    echo '<option value="">No Blood Bank</option>';
                                 }
                                ?>
                            </select>
                             <input type="date" min="<?php echo date('Y-m-d')?>" dd-mm-yyyy name="bloodbankdate" id="" class="form-control" placeholder="Date" required>
                             <select name="donardisease" id="" class="form-control" required>
                                <option value="">Disease:</option>
                                <option value="yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                            <button type="SUbmit" class="btn btn-success w-100 mt-2" name="bookappointment">Book Appointment</button>
                        </form>
                    </div>
                  </div>
             </div>
        </div>


                <?php

                if(isset($_SESSION['appointmentsuccess'])){
                    echo '<script>swal({
                        title: "Thank You",
                        text: "'.$_SESSION['appointmentsuccess'].'",
                        icon: "success",
                        button: "Done",
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                            window.location.href="donarappointment";
                        } else {
                            window.location.href="donarappointment";
                        }
                      });</script>';
                    unset($_SESSION['appointmentsuccess']);
                    }
                    if(isset($_SESSION['appointmenterror'])){
                        echo '<script>swal({
                            title: "'.$_SESSION['appointmenterror'].'",
                            icon: "warning",
                            button: "Done",
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                                window.location.href="donarappointment";
                            } else {
                                window.location.href="donarappointment";
                            }
                          });</script>';
                        unset($_SESSION['appointmenterror']);
                        }
                ?>



<?php
include "includes/footer.php";
?>
