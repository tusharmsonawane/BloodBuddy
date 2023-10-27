<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');
?>

             <div class="donarCards ">
                <div class="p-1 row my-0">
                <div class="col-md-4">
              <?php
                  $donarrequest =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE status='pendding' AND donaremail='$useremail' OR status='accept' AND donaremail='$useremail'");
                  if($totalpendding=mysqli_num_rows($donarrequest)){
                     $totalpendding;
                  }else{
                    $totalpendding= "00";
                  }
                 ?>
                  <a href="donarappointment" class="text-decoration-none w-100 mx-2">
                    <div class="card border-5 border-start border-0 border-danger shadow-lg">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                            <p><i class="fa-solid fa-clock-rotate-left"></i></p>
                            <p class="donarCardTitle">
                                <span>Appointment</span>
                                <span class="text-end">: <?php echo $totalpendding; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
              </div>
              <div class="col-md-4 my-0">
              <?php
                  $donarrequest =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE status='complete' AND donaremail='$useremail'");
                  if($totalcomplete=mysqli_num_rows($donarrequest)){
                     $totalcomplete;
                  }else{
                    $totalcomplete= "00";
                  }
                 ?>
                  <a href="history" class="text-decoration-none w-100 mx-2">
                    <div class="card border-5 border-start border-0 border-success shadow-lg">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                            <p><i class="fa-solid fa-check-circle"></i></p>
                            <p class="donarCardTitle">
                                <span>Complete</span>
                                <span class="text-end">: <?php echo $totalcomplete; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
              </div>
              <div class="col-md-4 my-0">
              <?php
                  $donarrequest =mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE status='pendding' AND donarid='$donarid'");
                  if($totalhospitalrequest=mysqli_num_rows($donarrequest)){
                     $totalhospitalrequest;
                  }else{
                    $totalhospitalrequest= "00";
                  }
                 ?>
                  <a href="hospitalrequest" class="text-decoration-none w-100 mx-2">
                    <div class="card border-5 border-start border-0 border-warning shadow-lg">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                            <p><i class="fa-solid fa-hospital"></i></p>
                            <p class="donarCardTitle">
                                <span>Hospital</span>
                                <span class="text-end">: <?php echo $totalhospitalrequest; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
              </div>
                </div>
             </div>








<?php
include "includes/footer.php";
?>