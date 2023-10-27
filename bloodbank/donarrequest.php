<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');
include('../asset/smtp/PHPMailerAutoload.php');

if(isset($_GET['a'])){
    $requestid=$_GET['a'];
    $querydonarstatus=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$requestid' AND status='pendding'");
    if(mysqli_num_rows($querydonarstatus)){
          while($donardatarow=mysqli_fetch_assoc($querydonarstatus)){
              $donaremail =$donardatarow['donaremail'];
              $donarname =$donardatarow['donarname'];
              $bookdate =$donardatarow['bookdate'];
          }
         $updatestatus=mysqli_query($dlink,"UPDATE donarappointment SET status='accept' WHERE appointmentid='$requestid' AND status='pendding'");
         if($updatestatus){
            $msg =' <div class="card shadow-lg p-4">
            <div class="logo text-center mt-3">
             <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
            </div>
            <hr class="mx-2">
            <div class="content">
              <p class="fs-5">Dear '.$donarname.'</p>
              <p>Your Request is Accepted By '.$username.' Is Successfuly. Please Visit to Blood Bank</p>
              <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Check Now</p>
              <p>Date : '.$bookdate.'</p>
            </div>
           </div>';
             //  mail sending
           $mail = new PHPMailer(); 
           $mail->IsSMTP(); 
           $mail->SMTPAuth = true; 
           $mail->SMTPSecure = 'ssl'; 
           $mail->Host = "smtp.gmail.com";
           $mail->Port = 465; 
           $mail->IsHTML(true);
           $mail->CharSet = 'UTF-8';
           $mail->Username = "isttush@gmail.com";
           $mail->Password = "foyixrosiqxhhoes";
           $mail->SetFrom("BloodBuddy Team");
           $mail->AddAddress($donaremail);
           $mail->Subject = "isttush@gmail.com";
           $mail->Body =$msg;
           $mail->SMTPOptions=array('ssl'=>array(
               'verify_peer'=>false,
               'verify_peer_name'=>false,
               'allow_self_signed'=>false
           ));
           if(!$mail->Send()){
               echo $mail->ErrorInfo;
           }else{
              $_SESSION['donarrequestsuccess'] ="Request accepted";
           }
         }
    }
}

if(isset($_GET['d'])){
    $requestid=$_GET['d'];

    $querydonarstatus=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$requestid' AND status='pendding'");
    if(mysqli_num_rows($querydonarstatus)){
        while($donardatarow=mysqli_fetch_assoc($querydonarstatus)){
            $donaremail =$donardatarow['donaremail'];
            $donarname =$donardatarow['donarname'];
            $bookdate =$donardatarow['bookdate'];
        }
         $updatestatus=mysqli_query($dlink,"UPDATE donarappointment SET status='decline' WHERE appointmentid='$requestid' AND status='pendding'");
         if($updatestatus){
            $msg =' <div class="card shadow-lg p-4">
            <div class="logo text-center mt-3">
             <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
            </div>
            <hr class="mx-2">
            <div class="content">
              <p class="fs-5">Dear '.$donarname.'</p>
              <p>Your Request is Decline By '.$username.' . Please Try Again Later </p>
              <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Check Now</p>
              <p>Date : '.$bookdate.'</p>
            </div>
           </div>';
               //  mail sending
           $mail = new PHPMailer(); 
           $mail->IsSMTP(); 
           $mail->SMTPAuth = true; 
           $mail->SMTPSecure = 'ssl'; 
           $mail->Host = "smtp.gmail.com";
           $mail->Port = 465; 
           $mail->IsHTML(true);
           $mail->CharSet = 'UTF-8';
           $mail->Username = "isttush@gmail.com";
           $mail->Password = "foyixrosiqxhhoes";
           $mail->SetFrom("BloodBuddy Team");
           $mail->AddAddress($donaremail);
           $mail->Subject = "isttush@gmail.com";
           $mail->Body =$msg;
           $mail->SMTPOptions=array('ssl'=>array(
               'verify_peer'=>false,
               'verify_peer_name'=>false,
               'allow_self_signed'=>false
           ));
           if(!$mail->Send()){
               echo $mail->ErrorInfo;
           }else{
            $_SESSION['donarrequesterror'] ="Request declined";
           }
         }
    }
}
if(isset($_POST['cappointment'])){
    $appointmentid= $_POST['donarappointmentid'];
    $bloodbag1 =$_POST['bloodbag'];
    $completedate = date("d-m-Y");
    $completetime =date("h:i:sa");

    if($bloodbag1 >=1 && $bloodbag1 <=2){
        $queryupdatestatus= mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$appointmentid'");
        if(mysqli_num_rows($queryupdatestatus)){
            $querycheckdata= mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
            if(mysqli_num_rows($querycheckdata)){
                $updatedata1=mysqli_query($dlink,"UPDATE donarappointment SET bloodbag='$bloodbag1' WHERE appointmentid='$appointmentid'");
                if($updatedata1){
                    $updatedata2=mysqli_query($dlink,"UPDATE donarappointment SET completedate='$completedate' WHERE appointmentid='$appointmentid'");
                    if($updatedata2){
                        $updatedata3=mysqli_query($dlink,"UPDATE donarappointment SET completetime='$completetime' WHERE appointmentid='$appointmentid'");
                        if($updatedata3){
                            $updatedata4=mysqli_query($dlink,"UPDATE donarappointment SET status='completed' WHERE appointmentid='$appointmentid'");
                                if($updatedata4){
                                    $checkstock =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$appointmentid'");
                                        if(mysqli_num_rows($checkstock)){
                                            while($donardatarow =mysqli_fetch_array($checkstock)){
                                                $donaremail=$donardatarow['donaremail'];
                                                $donarid=$donardatarow['donarid'];
                                            }
                                            $queryupdatelastdate=mysqli_query($dlink,"UPDATE donarregister SET lastdate='$completedate' WHERE donarid='$donarid'");
                                            $checkstock1 =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$donaremail'");
                                            if(mysqli_num_rows($checkstock1)){
                                                while($donardatarow2=mysqli_fetch_array($checkstock1)){
                                                   $donarbloodgroup = $donardatarow2['donarbloodgroup'];
                                                }
                                            }
                                            $queryfetchblooddata=mysqli_query($dlink,"SELECT * FROM bloodstock WHERE $donarbloodgroup AND bloodbankid='$bloodbankid'");
                                            if(mysqli_num_rows($queryfetchblooddata)){
                                                while($bloodstockrow=mysqli_fetch_array($queryfetchblooddata)){
                                                     $bloodbag2 =$bloodstockrow[$donarbloodgroup];
                                                }
                                                $querystockupdate=mysqli_query($dlink,"UPDATE bloodstock SET $donarbloodgroup=($bloodbag1 + $bloodbag2) WHERE bloodbankid='$bloodbankid'");
                                                if($querystockupdate){
                                                  $_SESSION['donarrequestsuccess'] = "Donor appointment is successfuly completed";
                                                }else{
                                                  $_SESSION['donarrequesterror'] = "SOMETHNG WENT WRONG";
                                                }
                                            }else{
                                                $_SESSION['donarrequesterror'] = "OOPS YOUR STOCK IS NOT UPDATED";
                                            }
                                        }
        
                                }else{ 
                                    $_SESSION['donarrequesterror'] = "SOMETHNG WENT WRONG";
                                }
                        }else{ 
                            $_SESSION['donarrequesterror'] = "SOMETHNG WENT WRONG";
                        }
                    }else{
                        $_SESSION['donarrequesterror'] = "SOMETHNG WENT WRONG";
                    }
                }else{
                        $_SESSION['donarrequesterror'] = "SOMETHNG WENT WRONG";
                }
            }else{
                $_SESSION['donarrequesterror'] = "SOMETHNG WENT WRONG";
            }
        }else{
            $_SESSION['donarrequesterror'] = "NO DONOR AVAILABLE";
        }
    }else{
        $_SESSION['donarrequesterror'] = "YOU ENTER WRONG DETAILS";
    }
}

$querytablerow =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE bloodbankid='$bloodbankid'");
 if($datarow=mysqli_num_rows($querytablerow)){
    if($datarow >= 10){
        $dataclass= "dataTable";
    }else{
        $dataclass= "";
    }
 }else{
    $dataclass= "";
 }
 
?>
<style>
    @media screen and (max-width:350px){
        .card .card-header .fs-5{
        font-size:15px !important;
    }
    }

</style>
            <div class="card h-100">
                <div class="card-header py-3 position-relative">
                    <a class="font-weight-bold text-black text-uppercase fs-5 text-decoration-none">Donor</a>
                    <a href="#" class="text-uppercase float-end text-decoration-none fs-5 btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#donarrequest">Update</a>
                </div>
                <div class="card-body p-2 mt-2">
                   <div class="table-responsive position-relative">
                   <table class="table cell-border border text-capitalize table-bordered" id="<?php echo $dataclass;?>" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Appointment Id</th>
                                <th>Donor Name:</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $querydonardata5=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE bloodbankid='$bloodbankid' AND status='pendding' OR bloodbankid='$bloodbankid' AND status='accept' OR bloodbankid='$bloodbankid' AND status='completed'");
                              if(mysqli_num_rows($querydonardata5)){
                                while($rownow =mysqli_fetch_array($querydonardata5)){
                                    $querycheckstatus1=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE status='pendding' AND appointmentid='$rownow[appointmentid]'");
                                        if(mysqli_num_rows($querycheckstatus1)){
                                        $status = '<a href="?a='.$rownow['appointmentid'].'" class="btn btn-success">Accept</a>
                                                   <a href="?d='.$rownow['appointmentid'].'" class="btn btn-danger">Decline</a>';
                                        }else{
                                            $querycheckstatus1=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE status='accept' AND appointmentid='$rownow[appointmentid]'");
                                            if(mysqli_num_rows($querycheckstatus1)){
                                                $status = '<h6 class="btn btn-primary  my-0 w-100 d-flex align-items-center justify-content-center">
                                                <div class="spinner-grow text-light spinner-grow-sm " role="status">
                                                </div>
                                                <div class="spinner-grow text-light spinner-grow-sm " role="status">
                                                </div>
                                                <div class="spinner-grow text-light spinner-grow-sm" role="status">
                                                </div>
                                                </h6>';
                                            }else{
                                                $querycheckstatus1=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE status='completed' AND appointmentid='$rownow[appointmentid]'");
                                                    if(mysqli_num_rows($querycheckstatus1)){
                                                        $status = '<h6 class="btn btn-success w-100">Complete</h6>';
                                                    }else{
                                                        $status = '<h6 class="btn btn-danger w-100">Decline</h6>';
                                                    }
                                            }
                                        }
                                        static $no =0;
                                        $no++;  
                                    echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.$rownow['appointmentid'].'</td>
                                    <td>'.$rownow['donarname'].'</td>
                                    <td>'.date("d-M-Y", strtotime($rownow['bookdate'])).'</td>
                                    <td>'.$status.'</td>

                                </tr>';
                                }
                              }else{
                                  echo '<span class="fs-5 text-uppercase" >no Donor request found</span>';
                                }

                             ?>
                            </tbody>
                    </table>

                   </div>
                </div>
             </div>
        </div>

        <div class="modal fade" id="donarrequest">
             <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-uppercase">Donor Appointment</h4>
                        <a href="#" class="btn-close" data-bs-dismiss="modal"></a>
                    </div>
                    <div class="modal-body">
                        <form  method="post">
                             <select name="donarappointmentid" id="" class="form-control text-capitalize">
                                <option value="none">choose Donor name</option>
                                <?php
                                 $querydonardata =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE status='accept' AND bloodbankid='$bloodbankid'");
                                 if(mysqli_num_rows($querydonardata)){
                                    while($donarid =mysqli_fetch_array($querydonardata)){
                                        echo '<option value='.$donarid['appointmentid'].'>'.$donarid['donarname'].'</option>';
                                    }
                                 }else{
                                    echo '<option value="none">No Donor</option>';
                                 }
                                ?>
                             </select>
                             <select name="bloodbag" id="" class="text-capitalize form-control">
                                <option value="none">Choose Quntity: </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                             </select>
                            <button type="Submit" class="btn btn-success w-100 mt-2" name="cappointment">Complete Appointment</button>
                        </form>
                    </div>
                  </div>
             </div>
        </div>

            <?php
                    if(isset($_SESSION['donarrequestsuccess'])){
                            echo '<script>
                            swal({
                                title: "Success",
                                text:"'.$_SESSION['donarrequestsuccess'].'",
                                icon: "success",
                                button: "Done",
                              })
                              .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href="donarrequest";
                                } else {
                                    window.location.href="donarrequest";
                                }
                              });
                              
                            </script>';
                            unset($_SESSION['donarrequestsuccess']);
                    }

                    if(isset($_SESSION['donarrequesterror'])){
                        echo '<script>
                        swal({
                            title: "'.$_SESSION['donarrequesterror'].'",
                            icon: "warning",
                            button: "Done",
                          })
                          .then((willDelete) => {
                            if (willDelete) {
                                window.location.href="donarrequest";
                            } else {
                                window.location.href="donarrequest";
                            }
                          });
                          
                        </script>';
                        unset($_SESSION['donarrequesterror']);
                }
            ?>
<?php
include "includes/footer.php";
?>
