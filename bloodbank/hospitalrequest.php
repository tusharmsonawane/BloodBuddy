<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');

if(isset($_GET['a'])){
    $requestid=$_GET['a'];
    $acceptdate=date("d-m-Y");
    $accepttime=date("h:s:ma");
    $queryhospitalstatus=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalappointmentid='$requestid' ");
    if(mysqli_num_rows($queryhospitalstatus)){
        while($bloodstock=mysqli_fetch_assoc($queryhospitalstatus)){
         $bloodgroup=$bloodstock['pbloodgroup'];
         $bloodbag=$bloodstock['bloodbag'];
            $querybloodstock=mysqli_query($dlink,"SELECT * FROM bloodstock WHERE ".$bloodgroup.">='$bloodbag'");
                if(mysqli_num_rows($querybloodstock)){
                    $updatestatus=mysqli_query($dlink,"UPDATE hospitalappointment SET status='accept',acceptdate='$acceptdate',accepttime='$accepttime' WHERE hospitalappointmentid='$requestid' AND status='pendding'");
                    if($updatestatus){
                        $_SESSION['updatestocksuccess'] ="Request is successfuly accepted";
                    }
                }else{
                    $_SESSION['updatestockfailed'] ="Oops ! insufficient blood stock";
                }
        }
    }
}


if(isset($_GET['d'])){
    $requestid=$_GET['d'];
    $acceptdate=date("d-m-Y");
    $accepttime=date("h:s:ma");

    $queryhospitalstatus=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE hospitalappointmentid='$requestid' AND status='pendding'");
    if(mysqli_num_rows($queryhospitalstatus)){
        $updatestatus=mysqli_query($dlink,"UPDATE hospitalappointment SET status='decline',acceptdate='$acceptdate',accepttime='$accepttime' WHERE hospitalappointmentid='$requestid' AND status='pendding'");
         if($updatestatus){
            $_SESSION['updatestockfailed'] ="YOU DECLINE THE REQUEST";
         }
    }
}
$querytablerow =mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE bloodbankid='$bloodbankid'");
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
            <div class="card h-100">
                <div class="card-header py-3 position-relative">
                    <a class="m-0 font-weight-bold text-black text-uppercase fs-5 text-decoration-none">Hospital</a>
                </div>
                <div class="card-body p-2 mt-2 ">
                   <div class="table-responsive  position-relative ">
                   <table class="table cell-border border text-capitalize table-bordered" id="<?php echo $dataclass; ?>" width="100%" cellspacing="0">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Appointment Id</th>
                                <th>Hospital Name:</th>
                                <th>patient Name</th>
                                <th>disease</th>
                                <th>doctor name</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $queryhospitaldata=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE bloodbankid='$bloodbankid'");
                            if(mysqli_num_rows($queryhospitaldata)){
                              while($rownow =mysqli_fetch_array($queryhospitaldata)){
                                  $querycheckstatus1=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE status='pendding' AND hospitalappointmentid='$rownow[hospitalappointmentid]'");
                                      if(mysqli_num_rows($querycheckstatus1)){
                                      $status = '<a href="?a='.$rownow['hospitalappointmentid'].'" class="btn btn-success">Accept</a>
                                      <a href="?d='.$rownow['hospitalappointmentid'].'" class="btn btn-danger">Decline</a>';
                                      }else{
                                          $querycheckstatus1=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE status='accept' AND hospitalappointmentid='$rownow[hospitalappointmentid]'");
                                          if(mysqli_num_rows($querycheckstatus1)){
                                              $status = '<h6 class="btn btn-primary my-0 w-100 d-flex align-items-center justify-content-center">
                                              <div class="spinner-grow text-light spinner-grow-sm" role="status">
                                              </div>
                                              <div class="spinner-grow text-light spinner-grow-sm" role="status">
                                              </div>
                                              <div class="spinner-grow text-light spinner-grow-sm" role="status">
                                              </div>
                                              </h6>';
                                          }else{
                                              $querycheckstatus1=mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE status='complete' AND hospitalappointmentid='$rownow[hospitalappointmentid]'");
                                                  if(mysqli_num_rows($querycheckstatus1)){
                                                      $status = '<h6 class="btn btn-success w-100">Complete</h6>';
                                                  }else{
                                                      $status = '<h6 class="btn btn-danger w-100">Decline</h6>';
                                                  }
                                          }
                                      }

                                      $queryfetchhospitalname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$rownow[hospitalid]'");
                                      if(mysqli_num_rows($queryfetchhospitalname)){
                                        while($rowhospitalname =mysqli_fetch_array($queryfetchhospitalname)){
                                            $hospitalname =$rowhospitalname['username'];
                                        }
                                      }
                                      static $no= 0;
                                      $no++;
                                  echo '<tr>
                                  <td>'.$no.'</td>
                                  <td>'.$rownow['hospitalappointmentid'].'</td>
                                  <td>'.$hospitalname.'</td>
                                  <td>'.$rownow['pname'].'</td>
                                  <td>'.$rownow['pdisease'].'</td>
                                  <td>'.$rownow['doctorname'].'</td>
                                  <td>'.date("d-M-Y", strtotime($rownow['senddate'])).'</td>
                                  <td>'.$status.'</td>

                              </tr>';
                              }
                            }else{
                                echo '<span class="fs-5 text-uppercase" >No Hospital request found</span>';
                            }
                             ?>
                        </tbody>
                    </table>
                   </div>
                </div>
             </div>
        </div>

      
<?php
if(isset($_SESSION['updatestockfailed'])){
      
    echo '<script>
    swal({
        title: "'.$_SESSION['updatestockfailed'].'",
        icon: "warning",
        button: "Done",
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href="hospitalrequest";
        } else {
            window.location.href="hospitalrequest";
        }
      });
    </script>';

    unset($_SESSION['updatestockfailed']);
}

if(isset($_SESSION['updatestocksuccess'])){
      
    echo '<script>
    swal({
        title: "Success",
        text:"'.$_SESSION['updatestocksuccess'].'",
        icon: "success",
        button: "Done",
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href="hospitalrequest";
        } else {
            window.location.href="hospitalrequest";
        }
      });
    </script>';

    unset($_SESSION['updatestocksuccess']);
}
include "includes/footer.php";
?>
