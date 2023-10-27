<?php
 include "includes/header.php";
 include "includes/topbar.php";
 include('../asset/smtp/PHPMailerAutoload.php');
?>
<?php
if(isset($_GET['registration'])){
    $queryhospitalregister=mysqli_query($dlink,"SELECT * FROM hospitalregister");
    if($registerrow = mysqli_num_rows($queryhospitalregister)){
         if($registerrow>=10){
            $tableclass="dataTable";
         }else{
            $tableclass="";
         }
              echo'<div class="card shadow mb-4 m-2">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Hospital Registrations: </h6>
                 </div>
                 <div class="card-body">
                     <div class="table-responsive">
                          <table class="table table-bordered" id="'.$tableclass.'" width="100%" cellspacing="0">
                             <thead>
                                 <td>No</td>
                                 <td>H. Id</td>
                                 <td>Name</td>
                                 <td>H. License No</td>
                                 <td>Email</td>
                                 <td>About</td>
                                 <td>Status</td>
                             </thead>
                             <tbody class="text-capitalize">';
                             while($hospitalRrow =mysqli_fetch_assoc($queryhospitalregister)){
                                    static $no =0;
                                     $no++;
                                echo '<tr>
                                          <th>'.$no.'</th>
                                          <th>'.$hospitalRrow['hospitalid'].'</th>
                                          <th>'.$hospitalRrow['hospitalname'].'</th>
                                          <th>'.$hospitalRrow['hospitalLid'].'</th>
                                          <th>'.$hospitalRrow['hospitalemail'].'</th>
                                          <th><a href="hospital?Hinfo='.$hospitalRrow['hospitalid'].'">More</a></th>';
                                          if($hospitalRrow['hospitalstatus'] == "pendding"){
                                            echo '<th class="d-flex h-100">
                                                    <a href="?acceptid='.$hospitalRrow['hospitalid'].'" class="btn btn-success w-100"><i class="fa fa-check"></i></a>
                                                    <a href="?declineid='.$hospitalRrow['hospitalid'].'" class="btn btn-danger w-100"><i class="fa fa-close"></i></a>
                                                </th>';
                                          }else{
                                            if($hospitalRrow['hospitalstatus'] == "accept"){
                                                echo '<th class="d-flex h-100">
                                                <a class="btn btn-success w-100 text-uppercase fw-bold" >'.$hospitalRrow['hospitalstatus'].'</a>
                                                </th>';
                                            }else{
                                                echo '<th class="d-flex h-100">
                                                <a class="btn btn-danger w-100 text-uppercase fw-bold">'.$hospitalRrow['hospitalstatus'].'</a>
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
            echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Hospital found</span>';
        }
    
}else{
    if(isset($_GET['appointment'])){
            $queryhospitalappointment=mysqli_query($dlink,"SELECT * FROM hospitalappointment");
            if($appointmentrow = mysqli_num_rows($queryhospitalappointment)){
                if($appointmentrow>=10){
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
                                            <tbody class="">';
                                            while($hospitalArow =mysqli_fetch_assoc($queryhospitalappointment)){
                                                $queryhospitalname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalArow[hospitalid]'");
                                                while($hospitalrow =mysqli_fetch_array($queryhospitalname)){
                                                    $hospitalname =$hospitalrow['username'];
                                                }
                                                $querybankname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalArow[bloodbankid]'");
                                                while($bankrow =mysqli_fetch_array($querybankname)){
                                                    $bloodbankname =$bankrow['username'];
                                                }
                                                static $no=0;
                                                $no++;

                                                echo '<tr>
                                                <th>'.$no.'</th>
                                                <th>'.$hospitalArow['hospitalappointmentid'].'</th>
                                                <th>'.$hospitalname.'</th>
                                                <th><a href="hospital?pid='.$hospitalArow['hospitalappointmentid'].'">'.$hospitalArow['pname'].'</a></th>
                                                <th>'.$bloodbankname.'</th>
                                                <th>'.$hospitalArow['status'].'</th>
                                                <th>'.$hospitalArow['bloodbag'].'</th>
                                                <th>'.date("d-M-Y", strtotime($hospitalArow['senddate'])).'</th>
                                                <th>'.date("h:i:s a", strtotime($hospitalArow['sendtime'])).'</th>
                                                </tr>';
                                              }
                                            '</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>';
                }else{
                    echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Hospital Appointment found</span>';
                }
    }else{
        if(isset($_GET['request'])){
            $queryhospitalrequest=mysqli_query($dlink,"SELECT * FROM hospitalrequest");
            if($requestrow = mysqli_num_rows($queryhospitalrequest)){
                if($requestrow>=10){
                    $tableclass="dataTable";
                }else{
                    $tableclass="";
                }
                        echo '<div class="card shadow mb-4 m-2">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Hospital Request: </h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-capitalize" id="'.$tableclass.'" width="100%" cellspacing="0">
                                            <thead>
                                                <td>No</td>
                                                <td>Request Id</td>
                                                <td>H. Name</td>
                                                <td>D. Name</td>
                                                <td>Status</td>
                                                <td>Date</td>
                                                <td>Time</td>
                                                <td>Blood bag</td>
                                            </thead>
                                            <tbody>';
                                            while($hospitalRrow =mysqli_fetch_assoc($queryhospitalrequest)){
                                                $querydonarname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalRrow[donarid]'");
                                                while($donarrow =mysqli_fetch_array($querydonarname)){
                                                    $donarname =$donarrow['username'];
                                                }
                                                static $no=0;
                                                $no++;
                                                echo '<tr>
                                                <th>'.$no.'</th>
                                                <th>'.$hospitalRrow['requestid'].'</th>
                                                <th>'.$hospitalRrow['hospitalname'].'</th>
                                                <th>'.$donarname.'</th>
                                                <th>'.$hospitalRrow['status'].'</th>
                                                <th>'.date("d-M-Y", strtotime($hospitalRrow['senddate'])).'</th>
                                                <th>'.date("h:i:s a", strtotime($hospitalRrow['sendtime'])).'</th>
                                                <th>'.$hospitalRrow['bloodbag'].'</th>
                                                </tr>';
                                              }
                                            '</tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>';
                }else{
                    echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">No Donar Request Found</span>';
                }
        }else{
            if(isset($_GET['acceptid'])){
                $hospitalid =$_GET['acceptid'];

                $querycheckhospital =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$hospitalid' AND hospitalstatus='pendding'");
                if(mysqli_num_rows($querycheckhospital)){
                   while($hospitalrow =mysqli_fetch_assoc($querycheckhospital)){
                       $hospitalid=$hospitalrow['hospitalid'];
                       $hospitalname=$hospitalrow['hospitalname'];
                       $hospitalemail=$hospitalrow['hospitalemail'];
                       $hospitalnumber=$hospitalrow['hospitalnumber'];
                       $hospitalpassword=$hospitalrow['hospitalpassword'];
                   }
                   $querycheckuser=mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$hospitalemail'");
                   if(mysqli_num_rows($querycheckuser)){
                    $updatestatus1=mysqli_query($dlink,"UPDATE hospitalregister SET hospitalstatus='accept' WHERE hospitalid='$hospitalid'");
                                if($updatestatus1){
                                   
                                            echo '<script>
                                            swal({
                                            title: "Something Went TO Wrong",
                                            text: "This user alredy exist ",
                                            icon: "warning",
                                            })
                                            .then((willDelete) => {
                                            if (willDelete) {
                                                window.location.href="hospital?registration";
                                            }else{
                                                window.location.href="hospital?registration";
                                            }
                                            });
                                            </script>';
                                            
                                }
                           }else{
                            $querychangestatus=mysqli_query($dlink,"INSERT INTO userregister (usertype,username,userpassword,userid,useremail,usernumber,userotp) VALUES ('hospital','$hospitalname','$hospitalpassword','$hospitalid','$hospitalemail','$hospitalnumber','')");
                            if($querychangestatus){
                                  $updatestatus=mysqli_query($dlink,"UPDATE hospitalregister SET hospitalstatus='accept' WHERE hospitalid='$hospitalid'");
                                            if($updatestatus){
                                                $msg =' <div class="card shadow-lg p-4">
                                                <div class="logo text-center mt-3">
                                                 <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                                                </div>
                                                <hr class="mx-2">
                                                <div class="content">
                                                  <p class="fs-5">Dear '.$hospitalname.'</p>
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
                                                     $mail->AddAddress($hospitalemail);
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
                                                            window.location.href="hospital?registration";
                                                            } 
                                                        });
                                                        </script>
                                                        ';
                                                     }
                                            }
                            }
                           }
            }
        }else{
            if(isset($_GET['declineid'])){
                $hospitalid =$_GET['declineid'];
                $querycheckuser=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalid'");
                if(mysqli_num_rows($querycheckuser)){
                  
                     $querydeleteuser =mysqli_query($dlink,"DELETE FROM userregister WHERE userid='$hospitalid'");
                     if($querydeleteuser){
                        $queryuserdecline=mysqli_query($dlink,"UPDATE hospitalregister SET hospitalstatus='decline' WHERE hospitalid='$hospitalid'");
                        echo '<script>window.location.href="hospital?registration"</script>';
                     }
                }else{
                   $queryuserdecline=mysqli_query($dlink,"UPDATE hospitalregister SET hospitalstatus='decline' WHERE hospitalid='$hospitalid'");
                   if($queryuserdecline){
                
                    $querycheckuser2=mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$hospitalid'");
                    while($hospitalrow =mysqli_fetch_assoc($querycheckuser2)){
                        $hospitalname1=$hospitalrow['hospitalname'];
                        $hospitalemail1=$hospitalrow['hospitalemail'];
                    }
                    $msg =' <div class="card shadow-lg p-4">
                    <div class="logo text-center mt-3">
                     <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                    </div>
                    <hr class="mx-2">
                    <div class="content">
                      <p class="fs-5">Dear '.$hospitalname1.'</p>
                      <p>Your Account For BloodBuddy Is Declined By Blood Buddy Team</p>
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
                         $mail->AddAddress($hospitalemail1);
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
                                title: "Rejected",
                                text: "You Are Rejected This User!",
                                icon: "success",
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                window.location.href="hospital?registration";
                                } 
                            });
                            </script>
                            ';
                         }
                   }
                }
            }else{
                  if(isset($_GET['editid'])){
                    $queryupdatedata =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$_GET[editid]'");
                    if(mysqli_num_rows($queryupdatedata)){
                          while($hospitaldata =mysqli_fetch_assoc($queryupdatedata)){
                            echo '<div class="">
                                    <div class="text-center">
                                        <img src="../hospital/asset/hospitalprofile/'.$hospitaldata['hospitalprofile'].'" class="rounded-pill border" alt="" height="120px" width="120px">
                                        <p class="mt-2 text-uppercase">'.$hospitaldata['hospitalname'].'</p>
                                    </div>
                                </div>
                                <hr class="mx-5">
                                <form action="includes/adminfiles/update?heditid='.$_GET['editid'].'"  method="post" class="form-group mx-5">
                                    <div class="">
                                    <input type="text" name="hname" id="" class="form-control mt-2" placeholder="hospital name" value="'.$hospitaldata['hospitalname'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="hnumber" id="" class="form-control mt-2" placeholder="hospital dob" value="'.$hospitaldata['hospitalnumber'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="hdname" id="" class="form-control mt-2" placeholder="hospital mobile number" value="'.$hospitaldata['hospitaldrname'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="haddress" id="" class="form-control mt-2" placeholder="hospital Address" value="'.$hospitaldata['hospitaladdress'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="hpassword" id="" class="form-control mt-2" placeholder="hospital password" value="">
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2 btn-block" name="updatehospital">Update</button>
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
                             window.location.href="hospital?deleteid='.$_GET['didid'].'";
                          } else {
                              window.location.href="hospital?registration";
                          }
                        });
                        </script>';
                    }else{
                        if(isset($_GET['deleteid'])){
                            $hospitalid =$_GET['deleteid'];

                            $queryhospital1=mysqli_query($dlink,"DELETE FROM hospitalregister WHERE hospitalid='$hospitalid'");
                            if($queryhospital1){
                              $queryhospital2=mysqli_query($dlink,"DELETE FROM userregister WHERE userid='$hospitalid'");
                              if($queryhospital2){
                                  $queryhospital3=mysqli_query($dlink,"DELETE FROM hospitalappointment WHERE hospitalid='$hospitalid'");
                                  if($queryhospital3){
                                      $queryhospital3=mysqli_query($dlink,"DELETE FROM hospitalrequest WHERE hospitalid='$hospitalid'");
                                      if($queryhospital3){
                                          echo '<script>
                                          swal({
                                              title: "Deleted",
                                              icon: "success",
                                              buttons: true,
                                            })
                                            .then((willDelete) => {
                                              if (willDelete) {
                                                 window.location.href="hospital?registration";
                                              }
                                            });
                                          </script>';
                                      }
                                  }
                              }
                            }
                        }else{
                            if(isset($_GET['pid'])){
                                $queryaboutp =mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalappointmentid='$_GET[pid]'");
                                if(mysqli_num_rows($queryaboutp)){
                                    while($patientrow =mysqli_fetch_assoc($queryaboutp)){
                                       $pname =$patientrow['pname'];
                                       $pemail =$patientrow['pemail'];
                                       $pdisease =$patientrow['pdisease'];
                                       $page =$patientrow['page'];
                                       $pweight =$patientrow['pweight'];
                                       $pbloodgroup =$patientrow['pbloodgroup'];
                                       $hospitalid=$patientrow['hospitalid'];
                                    }
                                    if($pbloodgroup =="AP"){
                                        $pbloodgroup = "A+";
                                    }else{
                                        if($pbloodgroup =="BP"){
                                            $pbloodgroup = "B+";
                                        }else{
                                            if($pbloodgroup =="ABP"){
                                                $pbloodgroup = "AB+";
                                            }else{
                                                if($pbloodgroup =="OP"){
                                                    $pbloodgroup = "O+";
                                                }else{
                                                    if($pbloodgroup =="AM"){
                                                        $pbloodgroup = "A-";
                                                    }else{
                                                        if($pbloodgroup =="BM"){
                                                            $pbloodgroup = "B-";
                                                        }else{
                                                            if($pbloodgroup =="ABM"){
                                                                $pbloodgroup = "AB-";
                                                            }else{
                                                                if($pbloodgroup =="OM"){
                                                                    $pbloodgroup = "O-";
                                                                }else{
                                                                    $pbloodgroup="";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $queryaboutp1 =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$hospitalid'");
                                    while($hospitalrow =mysqli_fetch_assoc($queryaboutp1)){
                                        $hospitalname =$hospitalrow['hospitalname'];
                                     }
                                    echo '<div class="card border-0 p-5 shadow m-4">
                                    <div class="d-flex justify-content-end">
                                    <a href="hospital?appointment"><i class="fa fa-close"></i></a>
                                    </div>
                                     <div class="card-body">
                                          <div class="">
                                              <p class="text-uppercase">'.$hospitalname.'</p>
                                          </div>
                                          <hr class="">
                                          <div class="text-capitalize">
                                            <p>Patient Name : '.$pname.'</p>
                                            <p>Patient Email : '.$pemail.'</p>
                                            <p>Patient Disease : '.$pdisease.'</p>
                                            <p>Patient Age : '.$page.'</p>
                                            <p>Patient Weight : '.$pweight.'</p>
                                            <p>Patient Blood Group : '.$pbloodgroup.'</p>
                                          </div>
                                     </div>
                                </div>';
                                    }
                               }else{
                                    if(isset($_GET['Hinfo'])){
                                        $queryabouthospital =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$_GET[Hinfo]'");
                                        if(mysqli_num_rows($queryabouthospital)){
                                             while($AboutHrow =mysqli_fetch_assoc($queryabouthospital)){
                                                echo '
                                                <div class="card border-0 p-5 shadow m-4">
                                                <div class="d-flex justify-content-end">
                                                <a href="hospital?registration"><i class="fa fa-close"></i></a>
                                                </div>
                                                    <div class="card-body">
                                                        <div class="">
                                                            <img src="../hospital/asset/hospitalprofile/'.$AboutHrow['hospitalprofile'].'" height="80px" width="80px" alt="">
                                                            <p class="text-uppercase">'.$AboutHrow['hospitalname'].'</p>
                                                        </div>
                                                        <hr class="">
                                                        <div class="text-capitalize">
                                                        <p>Hospital Email : '.$AboutHrow['hospitalemail'].'</p>
                                                        <p>hospital Mobile Number : '.$AboutHrow['hospitalnumber'].'</p>
                                                        <p>Hospital License : <a href="../hospital/asset/hospitalfile/'.$AboutHrow['hospitalfile'].'">'.$AboutHrow['hospitalfile'].'</a></p>
                                                        <p>Hospital License Id : '.$AboutHrow['hospitalLid'].'</p>
                                                        <p>Hospital Doctor Name : '.$AboutHrow['hospitaldrname'].'</p>
                                                        <p>Hospital Address : '.$AboutHrow['hospitaladdress'].'</p>
                                                        </div>
                                                        <hr>
                                                        <div class="d-flex">
                                                        <a href="?editid='.$AboutHrow['hospitalid'].'" class="btn btn-success w-100 mx-1">Edit <i class="fa fa-edit"></i></a>
                                                        <a href="?didid='.$AboutHrow['hospitalid'].'" class="btn btn-danger w-100 mx-1">Delete <i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                            </div>';
                                             }
                                        }
                                    }else{
                                        echo '<script>window.location.href="index"</script>';
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