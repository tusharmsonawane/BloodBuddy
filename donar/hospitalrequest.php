<?php
   include "includes/header.php";
   date_default_timezone_set('asia/kolkata');
?>


<?php

   if(isset($_GET['about'])){
          $hospitalid=$_GET['about'];
          $queryhAbout=mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$hospitalid'");
          if(mysqli_num_rows($queryhAbout)){
            while($AboutHrow=mysqli_fetch_assoc($queryhAbout)){
                echo '<div class="aboutHospital h-100 p-2">
                              <div class="card border-0 shadow p-4 h-100">
                              <div class="d-flex justify-content-end">
                              <a href="hospitalrequest "><i class="fa fa-close"></i></a>
                              </div>
                                 <div class="card-body">
                                       <div class="">
                                          <img src="../hospital/asset/hospitalprofile/'.$AboutHrow['hospitalprofile'].'" height="80px" width="80px" alt="">
                                          <p class="text-uppercase">'.$AboutHrow['hospitalname'].'</p>
                                       </div>
                                       <hr class="">
                                       <div class="">
                                       <p> Email : '.$AboutHrow['hospitalemail'].'</p>
                                       <p> Mobile Number : '.$AboutHrow['hospitalnumber'].'</p>
                                       <p> Doctor Name : '.$AboutHrow['hospitaldrname'].'</p>
                                       <p> Address : '.$AboutHrow['hospitaladdress'].'</p>
                                       </div>
                                    
                                 </div>
                              </div>
                      </div>';
            }
          }

   }else{
      $querycheckrequest =mysqli_query($dlink, "SELECT * FROM hospitalrequest WHERE donarid='$donarid' ORDER BY id DESC");
      if(mysqli_num_rows($querycheckrequest)){
            while($fetchdatarow =mysqli_fetch_assoc($querycheckrequest)){
               $querycheckrequest1 =mysqli_query($dlink, "SELECT * FROM hospitalregister WHERE hospitalid='$fetchdatarow[hospitalid]'");
               while($fetchdatarow1 =mysqli_fetch_assoc($querycheckrequest1)){
                   $hospitalprofile=$fetchdatarow1['hospitalprofile'];
               }
               if($fetchdatarow['status'] == "accept"){
                  $requeststatus ='<div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                    </div> process';
               }else{
                  if($fetchdatarow['status'] == "complete"){
                     $requeststatus ='<i class="fa-solid fa-check"></i> Complete';
                  }else{
                     $requeststatus='<i class="fa-solid fa-ban"></i> Decline';
                  }
               }
               $queryaceeptstatus=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$fetchdatarow[requestid]' AND donarid='$donarid' AND status='accept' OR requestid='$fetchdatarow[requestid]' AND donarid='$donarid' AND status='decline' OR requestid='$fetchdatarow[requestid]' AND donarid='$donarid' AND status='complete'");
               if(mysqli_num_rows($queryaceeptstatus)){
   
                   
                  echo '  <div class="appointment">
                                 <div class="p-2">
                                 <div class="card shadow-lg position-relative ">
                                 <div class="row">
                                    <div class="col-md-4 text-center">
                                       <img src="../hospital/asset/hospitalprofile/'.$hospitalprofile.'" alt="" class="img-fluid w-75" style="height:220px">
                                    </div>
                                    <div class="col-md-8 p-4">
                                          <div class="d-flex mt-2 justify-content-between">
                                          <h2 class="card-title text-uppercase">'.$fetchdatarow['hospitalname'].'</h2>
                                          <a href="?about='.$fetchdatarow['hospitalid'].'"><i class="fa-sharp fa-solid fa-ellipsis-vertical  fs-5 mx-3"></i></a>
                                          </div>
                                          <small class="text-uppercase mx-1 my-0">'.date("d-M-Y", strtotime($fetchdatarow['senddate'])).' | '.date("h:m a", strtotime($fetchdatarow['sendtime'])).'</small>
                                       <p class="p-1 my-0">"Dear valued donor, we are in urgent need of blood donations at our hospital. Your donation could save a life. Please consider donating blood at your earliest convenience. Thank you for your support."</p>
                  
                                       <div class="float-end p-2 mx-2">        
                                          <button class="btn btn-light">'.$requeststatus.'</button>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </div>
                        </div>';
               }else{
                  echo '<div class="appointment">
                  <div class="p-2">
                                 <div class="card shadow-lg">
                                 <div class="row">
                                    <div class="col-md-4 text-center">
                                       <img src="../hospital/asset/hospitalprofile/'.$hospitalprofile.'" alt="" class="img-fluid w-75" style="height:220px">
                                    </div>
                                    <div class="col-md-8 p-4">
                                          <div class="d-flex mt-2 justify-content-between">
                                          <h2 class="card-title text-uppercase">'.$fetchdatarow['hospitalname'].'</h2>
                                          <a href="?about='.$fetchdatarow['hospitalid'].'"><i class="fa-sharp fa-solid fa-ellipsis-vertical  fs-5 mx-3"></i></a>
                                          </div>
                                          <small class="text-uppercase mx-1 my-0">'.date("d-M-Y", strtotime($fetchdatarow['senddate'])).' | '.date("h:m a", strtotime($fetchdatarow['sendtime'])).'</small>
                                       <p class="p-1">"Dear valued donor, we are in urgent need of blood donations at our hospital. Your donation could save a life. Please consider donating blood at your earliest convenience. Thank you for your support."</p>
                                       <div class="d-flex gap-2 mb-2">
                                       <a href="?acceptid='.$fetchdatarow['requestid'].'" class="btn btn-success w-100">Accept</a>
                                       <a href="?declineid='.$fetchdatarow['requestid'].'" class="btn btn-danger w-100 mx-2">Decline</a>
                                       </div>
                        
                                    </div>
                                 </div>
                           </div>
                        </div>
                        </div>';
               }
            }
      }else{
         echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no request found</span>';
      }
   }







   if(isset($_GET['acceptid'])){
       $requestid =$_GET['acceptid'];
       $responsetime= date("h:i:sa");
       $responsedate=date("d-m-Y");
   
       $querycheckhospital=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$requestid' AND donarid='$donarid' AND status='pendding'");
       if(mysqli_num_rows($querycheckhospital)){
         while($row=mysqli_fetch_assoc($querycheckhospital)){
            $hospitalname =$row['hospitalname'];
         }
            $queryupdatestatus=mysqli_query($dlink,"UPDATE hospitalrequest SET status='accept',responsetime='$responsetime',responsedate='$responsedate',completedate='',completetime=''  WHERE requestid='$requestid' AND donarid='$donarid'");
            if( $queryupdatestatus){
                $_SESSION['requestsuccess']="Thank you for accepting  request of  $hospitalname";
            }else{
               $_SESSION['requesterror']="$hospitalname | Oops your request is not accepted";
            }
       }else{
         $_SESSION['requesterror']="Something went to wrong";
       }  
   }else{
      $hospitalid='';
   }




   if(isset($_GET['declineid'])){
      $requestid =$_GET['declineid'];
      $responsetime= date("h:i:sa");
      $responsedate=date("d-m-Y");
      $querycheckhospital=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE requestid='$requestid' AND donarid='$donarid' AND status='pendding'");
      if(mysqli_num_rows($querycheckhospital)){
         while($row=mysqli_fetch_assoc($querycheckhospital)){
            $hospitalname =$row['hospitalname'];
          }

           $queryupdatestatus=mysqli_query($dlink,"UPDATE hospitalrequest SET status='decline',responsetime='$responsetime',responsedate='$responsedate',completedate='',completetime=''  WHERE requestid='$requestid' AND donarid='$donarid'");
           if( $queryupdatestatus){
                    $_SESSION['requesterror']="Oops you declined the request of  $hospitalname";
           }else{
            $_SESSION['requesterror']="Something went  Wrong";
           }
      }else{
         $_SESSION['requesterror']="Something went  Wrong";
      }
  }else{
     $hospitalid='';
  }


  if(isset($_SESSION['requestsuccess'])){
   echo '<script>
   swal({
     title: "SUCCESS",
     text: "'.$_SESSION['requestsuccess'].'",
     icon: "success",
     button: "Done",
   })
     .then((willDelete) => {
       if (willDelete) {
          window.location.href="hospitalrequest";
       }else{
        window.location.href="hospitalrequest";
       }
     });
   </script>';
   unset($_SESSION['requestsuccess']);
}


if(isset($_SESSION['requesterror'])){
   echo '<script>
   swal({
     text: "'.$_SESSION['requesterror'].'",
     icon: "error",
     button: "Done",
   })
     .then((willDelete) => {
       if (willDelete) {
          window.location.href="hospitalrequest";
       }else{
        window.location.href="hospitalrequest";
       }
     });
   </script>';
   unset($_SESSION['requesterror']);
}
?>



<?php
   include "includes/footer.php";
?>