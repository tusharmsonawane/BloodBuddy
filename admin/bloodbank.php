<?php
 include "includes/header.php";
 include "includes/topbar.php";
 include('../asset/smtp/PHPMailerAutoload.php');
?>

<?php
if(isset($_GET['registration'])){
    $querybankregister=mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankstatus='pendding' OR bloodbankstatus='accept'");
    if($registerrow = mysqli_num_rows($querybankregister)){
        if($registerrow>=10){
             $tableclass="dataTable";
        }else{
            $tableclass="";
        }
            echo '<div class="card shadow mb-4 m-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Blood Bank Registrations: </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-capitalize" id="'.$tableclass.'" width="100%" cellspacing="0">
                                        <thead>
                                            <td>No</td>
                                            <td>B. Id</td>
                                            <td>B. Name</td>
                                            <td>B. License No</td>
                                            <td>Email</td>
                                            <td>About</td>
                                            <td>Status</td>
                                        </thead>
                                        <tbody>';
                                        while($bankrow =mysqli_fetch_assoc($querybankregister)){
                                            static $no=0;
                                            $no++;

                                            echo '<tr>
                                            <th>'.$no.'</th>
                                            <th>'.$bankrow['bloodbankid'].'</th>
                                            <th>'.$bankrow['bloodbankname'].'</th>
                                            <th>'.$bankrow['bloodbankLid'].'</th>
                                            <th>'.$bankrow['bloodbankemail'].'</th>
                                            <th><a href="bloodbank?aboutBloodbank='.$bankrow['bloodbankid'].'">More</a></th>';
                                            if($bankrow['bloodbankstatus'] == "pendding"){
                                                echo '<th class="d-flex h-100">
                                                        <a href="?acceptid='.$bankrow['bloodbankid'].'" class="btn btn-success w-100"><i class="fa fa-check"></i></a>
                                                        <a href="?declineid='.$bankrow['bloodbankid'].'" class="btn btn-danger w-100"><i class="fa fa-close"></i></a>
                                                      </th>';
                                          }else{
                                                    if($bankrow['bloodbankstatus'] == "accept"){
                                                        echo '<th class="d-flex h-100">
                                                        <a class="btn btn-success w-100 text-uppercase fw-bold">'.$bankrow['bloodbankstatus'].'</a>
                                                        </th>';
                                                   
                                                    }else{
                                                        echo '<th class="d-flex h-100">
                                                        <a class="btn btn-danger w-100 text-uppercase fw-bold">'.$bankrow['bloodbankstatus'].'</a>
                                                        </th>';
                                                    }
                                                }
                                            '</tr>';
                                        }
                                        '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>';
    }else{
        echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no bloodbank found</span>';
    }
}else{
    if(isset($_GET['bloodstock'])){
        $querybankstock=mysqli_query($dlink,"SELECT * FROM bloodstock");
        if($stockrow = mysqli_num_rows($querybankstock)){
            if($stockrow>=10){
                $tableclass ="dataTable";
            }else{
                $tableclass ="";
            }
                        echo '<div class="card shadow mb-4 m-2">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">BloodBank Stock: </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-capitalize" id="'.$tableclass.'" width="100%" cellspacing="0">
                                    <thead>
                                        <td>No</td>
                                        <td>B. Id</td>
                                        <td>B. Name</td>
                                        <td>A+</td>
                                        <td>B+</td>
                                        <td>AB+</td>
                                        <td>O+</td>
                                        <td>A-</td>
                                        <td>B-</td>
                                        <td>AB-</td>
                                        <td>O-</td>
                                        
                                    </thead>
                                    <tbody>';
                                    while($stockrow =mysqli_fetch_assoc($querybankstock)){
                                        static $no=0;
                                        $no++;
                                        echo '<tr>
                                        <th>'.$no.'</th>
                                        <th>'.$stockrow['bloodbankid'].'</th>
                                        <th>'.$stockrow['bloodbankname'].'</th>
                                        <th>'.$stockrow['AP'].'</th>
                                        <th>'.$stockrow['BP'].'</th>
                                        <th>'.$stockrow['ABP'].'</th>
                                        <th>'.$stockrow['OP'].'</th>
                                        <th>'.$stockrow['AM'].'</th>
                                        <th>'.$stockrow['BM'].'</th>
                                        <th>'.$stockrow['ABM'].'</th>
                                        <th>'.$stockrow['OM'].'</th>
                                        </tr>';
                                    }
                                    '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
            }else{
                echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Blood bank stock found</span>';
            }
    }else{
        if(isset($_GET['bloodcamp'])){
            $querybankcamp=mysqli_query($dlink,"SELECT * FROM bloodcamp");
            if($camprow = mysqli_num_rows($querybankcamp)){
                if($camprow>=10){
                    $tableclass ="dataTable";
                }else{
                    $tableclass ="";
                }
                    echo '<div class="card shadow mb-4 m-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Blood Camp: </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-capitalize" id="'.$tableclass.'" width="100%" cellspacing="0">
                                <thead>
                                    <td>No</td>
                                    <td>B.Camp Id</td>
                                    <td>B.Camp Name</td>
                                    <td>Date</td>
                                    <td>Status</td>
                                    <td>About</td>
                                </thead>
                                <tbody>';
                                while($camprow =mysqli_fetch_assoc($querybankcamp)){
                                    static $no=0;
                                     $no++;
                                    echo '<tr>
                                    <th>'.$no.'</th>
                                    <th>'.$camprow['bloodcampid'].'</th>
                                    <th>'.$camprow['bloodcampname'].'</th>
                                    <th>'.date("d-M-Y", strtotime($camprow['bloodcampdate'])).'</th>
                                    <th>'.$camprow['status'].'</th>
                                    <th><a href="bloodbank?bloodcampid='.$camprow['bloodcampid'].'">more</a></th>
                                    </tr>';
                                }
                                '</tbody>
                            </table>
                        </div>
                    </div>
                    </div>';
             }else{
                echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Blood camp found</span>';
             }
        }else{
            if(isset($_GET['dappointment'])){
                $querydonarappointment=mysqli_query($dlink,"SELECT * FROM donarappointment");
                if($appointmentrow1 = mysqli_num_rows($querydonarappointment)){
                    if($appointmentrow1>=10){
                        $tableclass="dataTable";
                    }else{
                        $tableclass="";
                    }
                                echo '<div class="card shadow mb-4 m-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Donor Appointment: </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-capitalize" id="'.$tableclass.'" width="100%" cellspacing="0">
                                            <thead>
                                                <td>No</td>
                                                <td>Appointment Id</td>
                                                <td>Name</td>
                                                <td>B. Name</td>
                                                <td>date</td>
                                                <td>Time</td>
                                                <td>Status</td>
                                            </thead>
                                            <tbody>';
                                            while($donarArow =mysqli_fetch_assoc($querydonarappointment)){
                                                $querybankname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$donarArow[bloodbankid]'");
                                                    while($bankrow =mysqli_fetch_array($querybankname)){
                                                        $bloodbankname =$bankrow['username'];
                                                    }
                                                    $querydonarstatus=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$donarArow[appointmentid]' AND status='complete'");
                                                    if(mysqli_num_rows($querydonarstatus)){
                                                            while($appointmentdate=mysqli_fetch_assoc($querydonarstatus)){
                                                                $statusdate1= $appointmentdate['completedate'];
                                                              }
                                                    }else{
                                                        $statusdate1= $donarArow['bookdate'];
                                                    }
                                                    static $no=0;
                                                    $no++;

                                                echo '<tr>
                                                <th>'.$no.'</th>
                                                <th>'.$donarArow['appointmentid'].'</th>
                                                <th>'.$donarArow['donarname'].'</th>
                                                <th>'.$bloodbankname.'</th>
                                                <th>'.date("d-M-Y", strtotime($statusdate1)).'</th>
                                                <th>'.date("h:i a", strtotime($donarArow['completetime'])).'</th>
                                                <th>'.$donarArow['status'].'</th>
                                                </tr>
                                            </tbody>';
                                                }
                                        '</table>
                                    </div>
                                </div>
                            </div>';
                            }else{
                                echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Donor appointment found</span>';
                            }
            }else{
                if(isset($_GET['bappointment'])){
                    $queryhospitalappointment=mysqli_query($dlink,"SELECT * FROM hospitalappointment");
                    if($appointmentrow2 = mysqli_num_rows($queryhospitalappointment)){
                         if($appointmentrow2>=10){
                             $tableclass="dataTable";
                         }else{
                            $tableclass="";
                         }
                                echo '<div class="card shadow mb-4 m-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Hospital Appointment: </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-capitalize" id="'.$tableclass.'" width="100%" cellspacing="0">
                                            <thead>
                                                <td>No</td>
                                                <td>A. Id</td>
                                                <td>H. Name</td>
                                                <td>Patient Name</td>
                                                <td>B. Name</td>
                                                <td>Status</td>
                                                <td>Blood Bag</td>
                                                <td>Date</td>
                                                <td>Time</td>
                                                
                                            </thead>
                                            <tbody>';
                                            while($hospitalArow =mysqli_fetch_assoc($queryhospitalappointment)){
                                                $queryhospitalname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalArow[hospitalid]'");
                                                while($hospitalrow =mysqli_fetch_array($queryhospitalname)){
                                                    $hospitalname =$hospitalrow['username'];
                                                }
                                                $querybankname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalArow[bloodbankid]'");
                                                while($bankrow =mysqli_fetch_array($querybankname)){
                                                    $bloodbankname =$bankrow['username'];
                                                }
                                                static $no =0;
                                                $no++;
                                                echo '<tr>
                                                <th>'.$no.'</th>
                                                <th>'.$hospitalArow['hospitalappointmentid'].'</th>
                                                <th>'.$hospitalname.'</th>
                                                <th>'.$hospitalArow['pname'].'</th>
                                                <th>'.$bloodbankname.'</th>
                                                <th>'.$hospitalArow['status'].'</th>
                                                <th>'.$hospitalArow['bloodbag'].'</th>
                                                <th>'.date("d-M-Y", strtotime($hospitalArow['completedate'])).'</th>
                                                <th>'.date("h:i a", strtotime($hospitalArow['completetime'])).'</th>
                                                </tr>';
                                            }
                                            '</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>';
                        }else{
                            echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Hospital appointment found</span>';
                        }
                }else{
                    if(isset($_GET['acceptid'])){
                        $bloodbankid =$_GET['acceptid'];
                        $querycheckbloodbank =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankid='$bloodbankid' AND bloodbankstatus='pendding'");
                        if(mysqli_num_rows($querycheckbloodbank)){
                           while($bloodbankrow =mysqli_fetch_assoc($querycheckbloodbank)){
                               $bloodbankid=$bloodbankrow['bloodbankid'];
                               $bloodbankname=$bloodbankrow['bloodbankname'];
                               $bloodbankemail=$bloodbankrow['bloodbankemail'];
                               $bloodbanknumber=$bloodbankrow['bloodbanknumber'];
                               $bloodbankpassword=$bloodbankrow['bloodbankpassword'];
                           }
                           $queryusercheck =mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$bloodbankid'");
                           if(mysqli_num_rows($queryusercheck)){
                            $updatestatus1=mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankstatus='accept' WHERE bloodbankid='$bloodbankid'");
                                        if($updatestatus1){
                                                    $msg =' <div class="card shadow-lg p-4">
                                                    <div class="logo text-center mt-3">
                                                    <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                                                    </div>
                                                    <hr class="mx-2">
                                                    <div class="content">
                                                    <p class="fs-5">Dear '.$bloodbankname.'</p>
                                                    <p>Your Account For BloodBuddy Is Accepted By Blood Buddy Team</p>
                                                    <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Login Now</p>
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
                                                        $mail->AddAddress($bloodbankemail);
                                                        $mail->Subject = "Account Verification";
                                                        $mail->Body =$msg;
                                                        $mail->SMTPOptions=array('ssl'=>array(
                                                            'verify_peer'=>false,
                                                            'verify_peer_name'=>false,
                                                            'allow_self_signed'=>false
                                                        ));
                                                        if(!$mail->Send()){
                                                            echo $mail->ErrorInfo;
                                                        }else{
                                                                    echo '<script>
                                                                    swal({
                                                                    title: "SOmething Went TO Wrong",
                                                                    text: "This user alredy exist ",
                                                                    icon: "success",
                                                                    })
                                                                    .then((willDelete) => {
                                                                    if (willDelete) {
                                                                        window.location.href="bloodbank?registration";
                                                                    } 
                                                                    });
                                                            </script>';
                                                        }
                                        }
                           }else{
                            $querychangestatus=mysqli_query($dlink,"INSERT INTO userregister (usertype,username,userpassword,userid,useremail,usernumber,userotp) VALUES ('bloodbank','$bloodbankname','$bloodbankpassword','$bloodbankid','$bloodbankemail','$bloodbanknumber','')");
                            if($querychangestatus){
                                  $updatestatus=mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankstatus='accept' WHERE bloodbankid='$bloodbankid'");
                                  if($updatestatus){
                                                    $msg =' <div class="card shadow-lg p-4">
                                                    <div class="logo text-center mt-3">
                                                    <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                                                    </div>
                                                    <hr class="mx-2">
                                                    <div class="content">
                                                    <p class="fs-5">Dear '.$bloodbankname.'</p>
                                                    <p>Your Account For BloodBuddy Is Accepted By Blood Buddy Team</p>
                                                    <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Login Now</p>
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
                                                  $mail->AddAddress($bloodbankemail);
                                                  $mail->Subject = "Account Verification";
                                                  $mail->Body = $msg;
                                                  $mail->SMTPOptions=array('ssl'=>array(
                                                      'verify_peer'=>false,
                                                      'verify_peer_name'=>false,
                                                      'allow_self_signed'=>false
                                                  ));
                                                  if(!$mail->Send()){
                                                      echo $mail->ErrorInfo;
                                                  }else{
                                                    echo '
                                                    <script>
                                                    swal({
                                                      title: "Good job!",
                                                      text: "You Are Successfuly accepted!",
                                                      icon: "success",
                                                    })
                                                    .then((willDelete) => {
                                                      if (willDelete) {
                                                         window.location.href="bloodbank?registration";
                                                      } 
                                                    });
                                                    </script>
                                                   ';
                                                  }
                                  }
                            }else{
        
                            }
                           }
                        }
                   }else{
                    if(isset($_GET['declineid'])){
                        $bloodbankid =$_GET['declineid'];
                        $querycheckuser=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$bloodbankid'");
                        if(mysqli_num_rows($querycheckuser)){
                             $querydeleteuser =mysqli_query($dlink,"DELETE FROM userregister WHERE userid='$bloodbankid'");
                             if($querydeleteuser){
                                $queryuserdecline=mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankstatus='decline' WHERE bloodbankid='$bloodbankid'");
                                echo '<script>window.location.href="bloodbank?registration"</script>';
                             }
                        }else{
                           $queryuserdecline=mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankstatus='decline' WHERE bloodbankid='$bloodbankid'");
                           if($queryuserdecline){
                            echo '
                            <script>
                            swal({
                                title: "Rejected",
                                text: "You Are Rejected This User!",
                                icon: "success",
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                window.location.href="bloodbank?registration";
                                } 
                            });
                            </script>
                            ';
                           }
                        }
                    }else{
                        if(isset($_GET['editid'])){
                            $queryupdatedata =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankid='$_GET[editid]'");
                            if(mysqli_num_rows($queryupdatedata)){
                                  while($bloodbankdata =mysqli_fetch_assoc($queryupdatedata)){
                                    echo '<div class="">
                                            <div class="text-center">
                                                <img src="../bloodbank/asset/bloodbankprofile/'.$bloodbankdata['bloodbankprofile'].'" class="rounded-pill border" alt="" height="120px" width="120px">
                                                <p class="mt-2 text-uppercase">'.$bloodbankdata['bloodbankname'].'</p>
                                            </div>
                                        </div>
                                        <hr class="mx-5">
                                        <form action="includes/adminfiles/update?beditid='.$_GET['editid'].'"  method="post" class="form-group mx-5">
                                            <div class="">
                                            <input type="text" name="bname" id="" class="form-control mt-2" placeholder="bloodbank name" value="'.$bloodbankdata['bloodbankname'].'">
                                            </div>
                                            <div class="">
                                            <input type="text" name="bnumber" id="" class="form-control mt-2" placeholder="bloodbank dob" value="'.$bloodbankdata['bloodbanknumber'].'">
                                            </div>
                                            <div class="">
                                            <input type="text" name="bmname" id="" class="form-control mt-2" placeholder="bloodbank mobile number" value="'.$bloodbankdata['bloodbankmanager'].'">
                                            </div>
                                            <div class="">
                                            <input type="text" name="bpassword" id="" class="form-control mt-2" placeholder="bloodbank password" value="">
                                            </div>
                                            <button type="submit" class="btn btn-success mt-2 btn-block" name="updatebloodbank">Update</button>
                                        </form>';
                                  }
                            }else{
                               echo "<script>window.location.href='index'</script>";
                            }
                        }else{
                            if(isset($_GET['didid'])){
                                echo '<script>
                                swal({
                                  title: "Ready To Delete?",
                                  text: "Once deleted, you will not be able to recover this data!",
                                  icon: "warning",
                                  buttons: true,
                                  dangerMode: true,
                                })
                                .then((willDelete) => {
                                  if (willDelete) {
                                     window.location.href="bloodbank?deleteid='.$_GET['didid'].'"
                                  } else {
                                    window.location.href="bloodbank?registration"
                                  }
                                });
                                </script>';
                            }else{
                                if(isset($_GET['deleteid'])){
                                    $bloodbankid =$_GET['deleteid'];

                                $querybloodbank1=mysqli_query($dlink,"DELETE FROM bloodbankregister WHERE bloodbankid='$bloodbankid'");
                                    if($querybloodbank1){
                                    $querybloodbank2=mysqli_query($dlink,"DELETE FROM userregister WHERE userid='$bloodbankid'");
                                      if($querybloodbank2){
                                        $querybloodbank3=mysqli_query($dlink,"DELETE FROM donarappointment WHERE bloodbankid='$bloodbankid'");
                                          if($querybloodbank3){
                                            $querybloodbank4=mysqli_query($dlink,"DELETE FROM hospitalrequest WHERE bloodbankid='$bloodbankid'");
                                              if($querybloodbank4){
                                                $querybloodbank5=mysqli_query($dlink,"DELETE FROM bloodcamp WHERE bloodbankid='$bloodbankid'");
                                                    if($querybloodbank5){
                                                    $querybloodbank6=mysqli_query($dlink,"DELETE FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                                                            if($querybloodbank6){
                                                        $querybloodbank7=mysqli_query($dlink,"DELETE FROM bloodcampstock WHERE bloodbankid='$bloodbankid'");
                                                          if($querybloodbank7){
                                                            echo '<script>
                                                            swal({
                                                                title: "Deleted",
                                                                icon: "success",
                                                                buttons: true,
                                                              })
                                                              .then((willDelete) => {
                                                                if (willDelete) {
                                                                   window.location.href="bloodbank?registration";
                                                                }
                                                              });
                                                            </script>';            
                                                        }
                                                    }
                                                }
                                              }
                                          }
                                      }
                                    }
                                }else{
                                    if(isset($_GET['bloodcampid'])){
                                         $querybankabout=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampid='$_GET[bloodcampid]'");
                                         if(mysqli_num_rows($querybankabout)){
                                            while($bloodcamprow =mysqli_fetch_assoc($querybankabout)){
                                                $bloodbankname = $bloodcamprow['bloodbankname'];
                                                $bloodbankcampname = $bloodcamprow['bloodcampname'];
                                                $bloodcampaddress = $bloodcamprow['bloodcampaddress'];
                                                $bloodcampdate = $bloodcamprow['bloodcampdate'];
                                                $bloodcamptimeto = $bloodcamprow['bloodcamptimeto'];
                                                $bloodcamptimefrom = $bloodcamprow['bloodcamptimefrom'];
                                                $status = $bloodcamprow['status'];
                                            }
                                            $querybankabout1=mysqli_query($dlink,"SELECT * FROM bloodcampstock WHERE bloodcampid='$_GET[bloodcampid]'");
                                            if(mysqli_num_rows($querybankabout1)){
                                                while($bloodcampStock =mysqli_fetch_assoc($querybankabout1)){
                                                    $AP = $bloodcampStock['AP'];
                                                    $BP = $bloodcampStock['BP'];
                                                    $ABP = $bloodcampStock['ABP'];
                                                    $OP = $bloodcampStock['OP'];
                                                    $AM = $bloodcampStock['AM'];
                                                    $BM = $bloodcampStock['BM'];
                                                    $ABM = $bloodcampStock['ABM'];
                                                    $OM = $bloodcampStock['OM'];
                                               }
                                            }else{
                                                    $AP = "";
                                                    $BP = "";
                                                    $ABP = "";
                                                    $OP = "";
                                                    $AM = "";
                                                    $BM = "";
                                                    $ABM = "";
                                                    $OM = "";
                                            }
                                            echo '<div class="card border-0 p-5 shadow m-4">
                                                        <div class="d-flex justify-content-end">
                                                        <a href="bloodbank?bloodcamp"><i class="fa fa-close"></i></a>
                                                        </div>
                                                        <div class="card-body text-capitalize">
                                                            <div class="">
                                                                <p class="">'.$bloodbankcampname.'</p>
                                                            </div>
                                                            <hr class="">
                                                            <div class="">
                                                                <p>Blood Bank Name : '.$bloodbankname.'</p>
                                                                <p>Blood Camp Name : '.$bloodbankcampname.'</p>
                                                                <p>Blood Camp Address : '.$bloodcampaddress.'</p>
                                                                <p>Blood Camp Date : '.date("d-M-Y", strtotime($bloodcampdate)).'</p>
                                                                <p>Blood Camp Time To Start : '.date("h:i a", strtotime($bloodcamptimeto)).'</p>
                                                                <p>Blood Camp Time To End : '.date("h:i a", strtotime($bloodcamptimefrom)).'</p>
                                                                <p>Blood Camp Status : '.$status.'</p>
                                                            </div>
                                                            <hr>
                                                            <table class="table table-bordered"  width="100%" cellspacing="0">
                                                            <thead>
                                                                <td>A+</td>
                                                                <td>B+</td>
                                                                <td>AB+</td>
                                                                <td>O+</td>
                                                                <td>A-</td>
                                                                <td>B-</td>
                                                                <td>AB-</td>
                                                                <td>O-</td>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <th>'.$AP.'</th>
                                                                <th>'.$BP.'</th>
                                                                <th>'.$ABP.'</th>
                                                                <th>'.$OP.'</th>
                                                                <th>'.$AM.'</th>
                                                                <th>'.$BM.'</th>
                                                                <th>'.$ABM.'</th>
                                                                <th>'.$OM.'</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>';
                                         }
                                    }else{
                                        if(isset($_GET['aboutBloodbank'])){
                                              $queryaboutBloodbank=mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankid='$_GET[aboutBloodbank]'");
                                              if(mysqli_num_rows($queryaboutBloodbank)){
                                                    while($AboutBrow =mysqli_fetch_assoc($queryaboutBloodbank)){
                                                        echo '
                                                        <div class="card border-0 p-5 shadow m-4">
                                                        <div class="d-flex justify-content-end">
                                                        <a href="bloodbank?registration"><i class="fa fa-close"></i></a>
                                                        </div>
                                                            <div class="card-body">
                                                                <div class="">
                                                                    <img src="../bloodbank/asset/bloodbankprofile/'.$AboutBrow['bloodbankprofile'].'" height="80px" width="80px" alt="">
                                                                    <p class="text-uppercase">'.$AboutBrow['bloodbankname'].'</p>
                                                                </div>
                                                                <hr class="">
                                                                <div class="text-capitalize">
                                                                <p>Blood Bank Email : '.$AboutBrow['bloodbankemail'].'</p>
                                                                <p>BloodBank Mobile Number : '.$AboutBrow['bloodbanknumber'].'</p>
                                                                <p>Blood Bank License : <a href="../bloodbank/asset/bloodbankfile/'.$AboutBrow['bloodbankfile'].'">'.$AboutBrow['bloodbankfile'].'</a></p>
                                                                <p>Blood Bank License Id : '.$AboutBrow['bloodbankLid'].'</p>
                                                                <p>Blood Bank Manager : '.$AboutBrow['bloodbankmanager'].'</p>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        <div class="d-flex">
                                                        <a href="?editid='.$AboutBrow['bloodbankid'].'" class="btn btn-success w-100 mx-1">Edit <i class="fa fa-edit"></i></a>
                                                        <a href="?didid='.$AboutBrow['bloodbankid'].'" class="btn btn-danger w-100 mx-1">Delete <i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>';
                                                    }
                                              }
                                        }else{
                                            echo "<script>window.location.href='index'</script>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                   }
                }
            }
        }
    }
}
?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if(isset($_SESSION['updateerror'])){
    echo "<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'warning',
        title: '$_SESSION[updateerror]'
      })
          </script>";
          unset($_SESSION['updateerror']);
  }

  if(isset($_SESSION['updatesuccess'])){
    echo "<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'success',
        title: '$_SESSION[updatesuccess]'
      })
          </script>";
          unset($_SESSION['updatesuccess']);
  }
?>
<?php
include "includes/footer.php";
?>