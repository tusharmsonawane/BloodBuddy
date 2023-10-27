<?php
   include "includes/header.php";
   date_default_timezone_set('asia/kolkata');
   include('../asset/smtp/PHPMailerAutoload.php');
   $totaldonar=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE hospitalid='$hospitalid'");
   if($total = mysqli_num_rows($totaldonar)){
       if($total >= 10){
           $hospitaltable='dataTable';
       }
   }else{
    $hospitaltable='';
   }
    if(isset($_POST['completeprocess'])){
        $requestid =$_POST['requestid'];
        $bloodbag =$_POST['bloodbag'];
        $status =$_POST['status'];
        $completetime= date("h:i:sa");
        $completedate=date("d-m-Y");
        if($requestid == "No Donar"){
         $_SESSION['donarerror'] ="NO DONOR EXIST";
        }else{
         if($bloodbag == "none"){
            $_SESSION['donarerror'] ="PLEASE SELECT THE BLOOD BAG";
         }else{
            if($status == "complete"){
               $querycheckdata=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$requestid'");
               if(mysqli_num_rows($querycheckdata)){
                 $queryupdatebag=mysqli_query($dlink,"UPDATE hospitalrequest SET bloodbag='$bloodbag',status='$status',completetime='$completetime',completedate='$completedate' WHERE requestid='$requestid'");
                        if($queryupdatebag){
                          
                           $queryfetchdonardata1=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$requestid'");
                           while($donarrow1 =mysqli_fetch_assoc($queryfetchdonardata1)){
                               $donarid =$donarrow1['donarid'];
                           } 
                           $querylastdate=mysqli_query($dlink,"UPDATE donarregister SET lastdate='$completedate' WHERE donarid='$donarid'"); /// update last date of donation

                           $queryfetchdonardata2=mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$donarid'");
                           while($donarrow2 =mysqli_fetch_assoc($queryfetchdonardata2)){
                               $donarname =$donarrow2['donarname'];
                               $donaremail =$donarrow2['donaremail'];
                           } 
                                    $msg =' <div class="card shadow-lg p-4">
                                    <div class="logo text-center mt-3">
                                    <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                                    </div>
                                    <hr class="mx-2">
                                    <div class="content">
                                    <p class="fs-5">Dear '.$donarname.'</p>
                                    <p>Your Response of Blood Donation Is Successfuly Completed. Blood Buddy Team Say Thanks To You</p>
                                    <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Check Now</p>
                                    <p>Date '.$completedate.': '.$completetime.' |</p>
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
                                           $mail->Subject = "Donation Status";
                                           $mail->Body =$msg;
                                           $mail->SMTPOptions=array('ssl'=>array(
                                               'verify_peer'=>false,
                                               'verify_peer_name'=>false,
                                               'allow_self_signed'=>false
                                           ));
                                           if(!$mail->Send()){
                                               echo $mail->ErrorInfo;
                                           }else{
                                             $_SESSION['donarsuccess'] ="Donor process completed";
                                           }
                        }
               }else{
                  $_SESSION['donarerror'] ="SOMETHING WENT WRONG";
               }
            }else{
               $querycheckdata=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$requestid'");
               if(mysqli_num_rows($querycheckdata)){
                 $queryupdatebag=mysqli_query($dlink,"UPDATE hospitalrequest SET bloodbag='0' WHERE requestid='$requestid'");
                       if($queryupdatebag){
                          $queryupdatestatus=mysqli_query($dlink,"UPDATE hospitalrequest SET status='$status' WHERE requestid='$requestid'");
                          if($queryupdatestatus){
                             $queryupdatetime=mysqli_query($dlink,"UPDATE hospitalrequest SET completetime='$completetime' WHERE requestid='$requestid'");
                             if($queryupdatetime){
                                $queryupdatedate=mysqli_query($dlink,"UPDATE hospitalrequest SET completedate='$completedate' WHERE requestid='$requestid'");
                                if($queryupdatedate){
                                 $queryfetchdonardata1=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$requestid'");
                                 while($donarrow1 =mysqli_fetch_assoc($queryfetchdonardata1)){
                                     $donarid =$donarrow1['donarid'];
                                 } 
      
                                 $queryfetchdonardata2=mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$donarid'");
                                 while($donarrow2 =mysqli_fetch_assoc($queryfetchdonardata2)){
                                     $donarname =$donarrow2['donarname'];
                                     $donaremail =$donarrow2['donaremail'];
                                 } 
                                 $msg =' <div class="card shadow-lg p-4">
                                 <div class="logo text-center mt-3">
                                  <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                                 </div>
                                 <hr class="mx-2">
                                 <div class="content">
                                   <p class="fs-5">Dear '.$donarname.'</p>
                                   <p>Your Response of Blood Donation Is Successfuly Completed. Blood Buddy Team Say Thanks To You</p>
                                   <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Check Now</p>
                                   <p>Date '.$completedate.': '.$completetime.' |</p>
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
                                                   $_SESSION['donarsuccess'] ="Donor process completed";
                                                 }
                                }
                             }
                          }
                       }
               }else{
                  $_SESSION['donarerror'] ="SOMETHING WENT WRONG";
               }
            }
          }
        }

    }else{
      $requestid='';
    }


    if(isset($_SESSION['donarsuccess'])){
      echo '<script>
      swal({
         title: "Success",
         text: "'.$_SESSION['donarsuccess'].'",
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
      unset($_SESSION['donarsuccess']);
    }

    
    if(isset($_SESSION['donarerror'])){
      echo '<script>
      swal({
         title: "'.$_SESSION['donarerror'].'",
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
      unset($_SESSION['donarerror']);
    }
  
    

?>


<style>
   .card .card-body::-webkit-scrollbar{
      height:0px;
   }
</style>

           <div class="card h-100">
                <div class="card-header py-3 position-relative">
                <a class="text-uppercase text-decoration-none text-dark mx-2 fs-5">request</a>
                <a href="#" class="text-uppercase text-decoration-none mx-2 fs-5 float-end btn btn-primary mt-0" data-bs-toggle="modal" data-bs-target="#updatestatus">Update</a>
                </div>
                <div class="card-body p-2 overflow-scroll">
                <table class="table p-2 text-capitalize table-bordered" id="<?php echo $hospitaltable; ?>" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Request Id</th>
                                            <th>Hospital Name</th>
                                            <th>Donor Name</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       $queryfetcdata=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE hospitalid='$hospitalid'");
                                       if(mysqli_num_rows($queryfetcdata)){
                                             while($hospitalrow =mysqli_fetch_assoc($queryfetcdata)){
                                                $queryfetcdata2=mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$hospitalrow[donarid]'");
                                                if(mysqli_num_rows( $queryfetcdata2)){
                                                   while($donarnamerow=mysqli_fetch_assoc($queryfetcdata2)){
                                                      $donarname=$donarnamerow['donarname'];
                                                   }
                                                }
                                                if($hospitalrow['status'] == 'pendding'){
                                                   $hospitalspi ='<div class="spinner-border spinner-border-sm" role="status">
                                                   <span class="visually-hidden">Loading...</span>
                                                 </div>';
                                                }else{
                                                   if($hospitalrow['status'] == 'complete'){
                                                      $hospitalspi ='<i class="fa-solid fa-circle-check text-success"></i>';
                                                   }else{
                                                      if($hospitalrow['status'] == 'decline'){
                                                         $hospitalspi ='<i class="fa-solid fa-ban"></i>';
                                                      }else{
                                                         if($hospitalrow['status'] == 'accept'){
                                                            $hospitalspi ='<i class="fa-solid fa-check"></i>';
                                                         }else{
                                                            $hospitalspi ='';
                                                         }
                                                      }
                                                   }
                                                }
                                                static $no=0;
                                                $no++;
                                                   echo '<tr>
                                                   <td>'.$no.'</td>
                                                   <td>'.$hospitalrow['requestid'].'</td>
                                                   <td>'.$hospitalrow['hospitalname'].'</td>
                                                   <td>'.$donarname.'</td>
                                                   <td>'.$hospitalspi.' '.$hospitalrow['status'].'</td>
                                                   <td>'.$hospitalrow['bloodbag'].'</td>
                                                   <td>'.date("d-M-Y", strtotime($hospitalrow['senddate'])).'</td>
                                                   <td class="text-uppercase">'.date("h:i a", strtotime($hospitalrow['sendtime'])).'</td>
                                                </tr>';
                                             }
                                       }else{
                                          echo '<span class="fs-5 text-uppercase" >no request found a</span>';
                                       }

                                  ?>
          
                                  </tbody>
                                </table>
                </div>
             </div>
        </div>

   <div class="modal fade" id="updatestatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Hospital Process</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <div class="modal-body">
                        <form  method="post"> 
                           <select name="requestid" id="" class="form-control">
                                       <?php
                                       $fetchdata =mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE hospitalid='$hospitalid' AND status='accept'");
                                       if(mysqli_num_rows($fetchdata)){ 
                                          while($fetchrow=mysqli_fetch_assoc($fetchdata)){
                                             echo "<option value='$fetchrow[requestid]'>$fetchrow[requestid]</option>";
                                          }
                                       }else{
                                          echo '<option value="none">No Donor Available</option>';
                                       }
                                       ?>
                           </select>
                           <select name="status" id="" class="form-control">
                              <option value="complete">complete</option>
                              <option value="decline">decline</option>
                           </select>
                           <select name="bloodbag" id="" class="form-control">
                           <option value="none">Please Select Number of Bag:</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                           </select>
                           <button type="submit" class="btn btn-success w-100 mt-3" name="completeprocess">Complete</button>
                        </form>
            </div>
         </div>
       </div>
     </div>
<?php
 
   include "includes/footer.php";
?>