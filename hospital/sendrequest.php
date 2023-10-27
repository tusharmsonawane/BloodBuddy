<?php
   include "includes/header.php";
   date_default_timezone_set('asia/kolkata');
   if(isset($_POST['sendrequesttobloodbank'])){
      $pname= $_POST['pname'];
      $pemail= $_POST['pemail'];
      $pdisease= $_POST['pdisease'];
      $page= $_POST['page'];
      $pweight= $_POST['pweight'];
      $bloodbag= $_POST['bloodbag'];
      $pbloodgroup= $_POST['pbloodgroup'];
      $bloodbankid= $_POST['bloodbankid'];
      $doctorname= $_POST['doctorname'];
      $hospitalappointmentid=rand(1111111,9999999);
      $sendtime =date("h:i:sa");
      $senddate =date("d-m-Y");
      if(empty($pname) && empty($pemail) && empty($pdisease) && empty($page) && empty($page) && empty($pweight) && empty($doctorname)){
            $_SESSION['sendrequesterror'] =" PLEASE FILLED THE DATA";
      }else{
         if($pbloodgroup == "none"){
            $_SESSION['sendrequesterror'] =" PLEASE SELECT THE BLOOD GROUP";
         }else{
            if($bloodbag == "none"){
               $_SESSION['sendrequesterror'] =" PLEASE SELECT THE BLOOD BAG";
            }else{
               $queryfetchhospitalname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$hospitalid'");
                 if(mysqli_num_rows($queryfetchhospitalname)){
                  while($hospitalrow =mysqli_fetch_assoc($queryfetchhospitalname)){
                     $hospitalname =$hospitalrow['username'];
                  }
                  $querycheckrequest=mysqli_query($dlink,"SELECT * FROM hospitalappointment  WHERE hospitalid='$hospitalid'");
                  if(mysqli_num_rows($querycheckrequest)){
                        $querycheckrequest2=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalid='$hospitalid' AND status='pendding'");
                        if(mysqli_num_rows($querycheckrequest2)){
                           $_SESSION['sendrequesterror'] ="WAIT FOR COMPLITING THE  PREVIOUS REQUEST";
                        }else{
                          $queryinsertdata=mysqli_query($dlink,"INSERT INTO hospitalappointment (hospitalid,hospitalappointmentid,pname,pemail,pdisease,page,pweight,bloodbag,pbloodgroup,doctorname,bloodbankid,status,sendtime,senddate,acceptdate,accepttime,completedate,completetime) VALUES('$hospitalid','$hospitalappointmentid','$pname','$pemail','$pdisease','$page','$pweight','$bloodbag','$pbloodgroup','$doctorname','$bloodbankid','pendding','$sendtime','$senddate','','','','') ");
                          if($queryinsertdata){
                           $_SESSION['sendrequestsuccess'] ="Your request send succesfuly to $hospitalname";
                          }else{
                           $_SESSION['sendrequesterror'] ="SOMETHING WENT WRONG";
                          }
                        }
                  }else{
                      $queryinsertdata=mysqli_query($dlink,"INSERT INTO hospitalappointment (hospitalid,hospitalappointmentid,pname,pemail,pdisease,page,pweight,bloodbag,pbloodgroup,doctorname,bloodbankid,status,sendtime,senddate,acceptdate,accepttime,completedate,completetime) VALUES('$hospitalid','$hospitalappointmentid','$pname','$pemail','$pdisease','$page','$pweight','$bloodbag','$pbloodgroup','$doctorname','$bloodbankid','pendding','$sendtime','$senddate','','','','') ");
                      if($queryinsertdata){
                        $_SESSION['sendrequestsuccess'] ="Your request send succesfuly to $hospitalname";
                      }else{
                        $_SESSION['sendrequesterror'] ="SOMETHING WENT WRONG";
                      }
                  }
                 }else{
                  $_SESSION['sendrequesterror'] ="SOMETHING WENT WRONG";
                 }
            }
         }
      }
   }
?>



<div class="container-fluid">
    <div class="card">
      <div class="m-3">
        <h1 class="text-center">Request For Blood</h1>
          <hr>
                     <form  method="post">
                        <input type="text" name="pname" id="" class="form-control" placeholder="Patient Name">
                        <input type="email" name="pemail" id="" class="form-control" placeholder="Patient Email">
                        <input type="text" name="pdisease" id="" class="form-control" placeholder="Disease">
                        <div class="d-flex">
                        <input type="text" name="page" id="" class="form-control" placeholder="Patient Age" style="margin-right:5px">
                        <input type="text" name="pweight" id="" class="form-control" placeholder="Patient weight">
                        </div>
                        <select name="bloodbag" id="" class="form-control">
                           <option value="none">Select blood bag quantity:</option>
                           <option value="1">1</option>
                           <option value="2">2</option>
                           <option value="3">3</option>
                        </select>
                        <select name="pbloodgroup" id="" class="form-control">
                                 <option value="none">Patient Blood Group:</option>
                                 <option value="AP">A+</option>
                                 <option value="BP">B+</option>
                                 <option value="ABP">AB+</option>
                                 <option value="OP">O+</option>
                                 <option value="AM">A-</option>
                                 <option value="BM">B-</option>
                                 <option value="ABM">AB-</option>
                                 <option value="OM">O-</option>
                        </select>
                        <input type="text" name="doctorname" id="" class="form-control" placeholder="Doctor Name">
                        <select name="bloodbankid" id="" class="form-control">
                        <option value="none">choose blood bank</option>
                        <?php
                        $querybloodbank=mysqli_query($dlink,"SELECT * FROM bloodbankregister");
                        if(mysqli_num_rows($querybloodbank)){
                           while($bloodbankrow =mysqli_fetch_assoc($querybloodbank)){
                              echo '<option value="'.$bloodbankrow['bloodbankid'].'">'.$bloodbankrow['bloodbankname'].'</option>';
                           }
                        }else{
                           echo '<option value="none">no user are availeble</option>';
                        }
                        ?>
                        </select>
                        
                        <div class="d-flex mt-2">
                           <button class="btn btn-danger w-100" style="margin-right:5px">Reset</button>
                           <button type="submit" class="btn btn-success w-100" name="sendrequesttobloodbank">Send Request</button>
                        </div>
                     </form>
      </div>
    </div>
</div>

<?php
   include "includes/footer.php";
?>


<?php
            if(isset($_SESSION['sendrequestsuccess'])){
               echo '<script>
               swal({
                  title: "Success",
                  text:"'.$_SESSION['sendrequestsuccess'].'",
                  icon: "success",
                  button: "Done",
               })
               .then((willDelete) => {
                  if (willDelete) {
                     window.location.href="sendrequest";
                  } else {
                     window.location.href="sendrequest";
                  }
               });
                     </script>';
               unset($_SESSION['sendrequestsuccess']);
            }
           if(isset($_SESSION['sendrequesterror'])){
            echo '<script>
            swal({
               title: "'.$_SESSION['sendrequesterror'].'",
               icon: "warning",
               button: "Done",
             })
             .then((willDelete) => {
               if (willDelete) {
                  window.location.href="sendrequest";
               } else {
                  window.location.href="sendrequest";
               }
             });
                  </script>';
            unset($_SESSION['sendrequesterror']);
           }
?>

