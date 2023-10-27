<?php
   include "includes/header.php";
   date_default_timezone_set('asia/kolkata');
   $totaldonar=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalid='$hospitalid'");
   if($total = mysqli_num_rows($totaldonar)){
       if($total >= 10){
        $hospitaltable='dataTable';
       }
   }else{
    $hospitaltable='';
   }

   if(isset($_POST['completeprocess'])){
        $requestid =$_POST['requestid'];
        $status = $_POST['status'];
        $completedate = date("d-m-Y");
        $completetime =date("h:i:sa");

        $fetchbloodbag=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalappointmentid='$requestid' AND status='accept'");
        if(mysqli_num_rows($fetchbloodbag)){
             while($bloodbagrow =mysqli_fetch_assoc($fetchbloodbag)){
                 $bloodbag =$bloodbagrow['bloodbag'];
                 $patientbloodgroup=$bloodbagrow['pbloodgroup'];
                 $bloodbankid=$bloodbagrow['bloodbankid'];
             }
             $queryupdatedata1=mysqli_query($dlink,"UPDATE hospitalappointment SET status='$status' WHERE hospitalappointmentid='$requestid' AND status='accept'");
             if($queryupdatedata1){
                    $queryupdatedata2=mysqli_query($dlink,"UPDATE hospitalappointment SET completedate='$completedate',completetime='$completetime' WHERE hospitalappointmentid='$requestid'");
                    if($queryupdatedata2){
                            $fetchbloodstock=mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid' AND $patientbloodgroup");
                            if(mysqli_num_rows($fetchbloodstock)){
                                while($blooddata=mysqli_fetch_assoc($fetchbloodstock)){
                                     $bloodbag1= $blooddata[$patientbloodgroup];
                                }
                            }

                            $updatebloodstock=mysqli_query($dlink,"UPDATE bloodstock SET $patientbloodgroup=($bloodbag1 - $bloodbag) WHERE bloodbankid='$bloodbankid'");
                            if($updatebloodstock){
                                $_SESSION['appointmenterror'] ="PROCESS COMPLETED";
                            }
                    }
             }
        }else{
            $_SESSION['appointmenterror'] ="SOMETHING WENT WRONG";
        }

   }



   if(isset($_SESSION['appointmenterror'])){
    echo '<script>
    swal({
       title: "'.$_SESSION['appointmenterror'].'",
       icon: "success",
       button: "Done",
     })
     .then((willDelete) => {
       if (willDelete) {
          window.location.href="appointment";
       } else {
          window.location.href="appointment";
       }
     });
    </script>';
    unset($_SESSION['appointmenterror']);
  }
   
?>


<div class="card h-100">
                <div class="card-header py-3 position-relative  p-0">
                   <a class="text-decoration-none text-uppercase fs-5 mx-3 text-black">Appointment</a>
                   <a href="#" class="btn btn-primary mt-0 shadow-sm text-decoration-none text-uppercase fs-5 mx-3  float-end" data-bs-toggle="modal" data-bs-target="#updatestatus">Update</a>
                </div>
                <div class="card-body p-2 overflow-scroll hospitalhistory">
                <table class="table table-bordered p-2 text-capitalize" id="<?php echo $hospitaltable; ?>" width="100%" cellspacing="0">
                                    <thead ">
                                        <tr>
                                             <th>No</th>
                                            <th>Appointment Id</th>
                                            <th>patient Name</th>
                                            <th>Blood Group</th>
                                            <th>Diasese</th>
                                            <th>status</th>
                                            <th>Quantity</th>
                                            <th>date</th>
                                            <th>time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                       $queryfetcdata=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalid='$hospitalid'");
                                       if(mysqli_num_rows($queryfetcdata)){
                                             while($hospitalrow =mysqli_fetch_assoc($queryfetcdata)){

                                                if($hospitalrow['pbloodgroup'] =="AP"){
                                                   $hospitalbloodgroup = "A+";
                                               }else{
                                                   if($hospitalrow['pbloodgroup'] =="BP"){
                                                      $hospitalbloodgroup = "B+";
                                                   }else{
                                                       if($hospitalrow['pbloodgroup'] =="ABP"){
                                                           $hospitalbloodgroup = "AB+";
                                                       }else{
                                                           if($hospitalrow['pbloodgroup'] =="OP"){
                                                               $hospitalbloodgroup = "O+";
                                                           }else{
                                                               if($hospitalrow['pbloodgroup'] =="AM"){
                                                                   $hospitalbloodgroup = "A-";
                                                               }else{
                                                                   if($hospitalrow['pbloodgroup'] =="BM"){
                                                                       $hospitalbloodgroup = "B-";
                                                                   }else{
                                                                       if($hospitalrow['pbloodgroup'] =="ABM"){
                                                                           $hospitalbloodgroup = "AB-";
                                                                       }else{
                                                                           if($hospitalrow['pbloodgroup'] =="OM"){
                                                                               $hospitalbloodgroup = "O-";
                                                                           }else{
                                                                              $hospitalrow['pbloodgroup']="";
                                                                           }
                                                                       }
                                                                   }
                                                               }
                                                           }
                                                       }
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
                                                   <td>'.$hospitalrow['hospitalappointmentid'].'</td>
                                                   <td>'.$hospitalrow['pname'].'</td>
                                                   <td>'.$hospitalbloodgroup.'</td>
                                                   <td>'.$hospitalrow['pdisease'].'</td>
                                                   <td>'.$hospitalspi.' '.$hospitalrow['status'].'</td>
                                                   <td>'.$hospitalrow['bloodbag'].'</td>
                                                   <td>'.date("d-M-Y", strtotime($hospitalrow['senddate'])).'</td>
                                                   <td class="text-uppercase">'.date("h:i a", strtotime($hospitalrow['sendtime'])).'</td>
                                                </tr>';
                                             
                                             }
                                       }else{
                                       };
                                    
                               
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
                           <select name="requestid" id="" class="form-control text-uppercase">
                              <?php
                              $fetchdata =mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalid='$hospitalid' AND status='accept'");
                              if(mysqli_num_rows($fetchdata)){ 
                                 while($fetchrow=mysqli_fetch_assoc($fetchdata)){ echo "<option value='$fetchrow[hospitalappointmentid]' class='text-uppercase'>$fetchrow[pname]</option>";}
                              }else{
                                 echo "<option value='none' class='text-uppercase'>No Appointment</option>";
                              }
                              ?>
                           </select>
                           <select name="status" id="" class="form-control">
                              <option value="complete">Received</option>
                              <option value="decline">Not Received</option>
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