<?php
include_once "includes/header.php";
date_default_timezone_set('asia/kolkata');
?>

 <div class="donarCards d-flex  justify-content-between p-2">
 <?php

                  $donarrequest =mysqli_query($dlink,"SELECT * FROM donarappointment WHERE  bloodbankid='$bloodbankid' AND status='pendding'");
                  if($totaldonarrequest =mysqli_num_rows($donarrequest)){
                     $totaldonarrequest;
                  }else{
                    $totaldonarrequest;
                  }
                 ?>
                  <a href="donarrequest" class="text-decoration-none w-100 mx-2 shadow-lg">
                    <div class="card border-5 border-start border-0 border-danger">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                            <p><i class="fa-solid fa-user"></i></p>
                            <p class="donarCardTitle">
                                <span>Donor Request</span>
                                <span class="text-end">:<?php echo  $totaldonarrequest; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>

                  <?php
                  $hospitalrequest =mysqli_query($dlink,"SELECT * FROM hospitalappointment WHERE bloodbankid='$bloodbankid' AND status='pendding'");
                  if($totalhospitalrequest =mysqli_num_rows($hospitalrequest)){
                     $totalhospitalrequest;
                  }else{
                    $totalhospitalrequest;
                  }
                 ?>
                  <a href="hospitalrequest" class="text-decoration-none w-100 mx-2 shadow-lg">
                    <div class="card border-5 border-start border-0 border-success">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                            <p><i class="fa-solid fa-hospital"></i></p>
                            <p class="donarCardTitle">
                                <span>Hospital Request</span>
                                <span class="text-end">: <?php echo  $totalhospitalrequest; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                  <?php
                  $bloodcamp =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid' AND status='active'");
                  if($totalbloodcamp =mysqli_num_rows($bloodcamp)){
                     $totalbloodcamp;
                  }else{
                    $totalbloodcamp;
                  }
                 ?>
                  <a href="bloodcamp" class="text-decoration-none w-100 mx-2 shadow-lg">
                    <div class="card border-5 border-start border-0 border-warning">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                            <p><i class="fa-solid fa-tent"></i></p>
                            <p class="donarCardTitle">
                                <span>Blood Camp</span>
                                <span class="text-end">: <?php echo  $totalbloodcamp; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
             </div>

             <div class="card mx-3">
               <div class="row mx-1 p-2">
                <?php
                    $bloodbankstockAP =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockAP)){
                           while($totalbloodAP=mysqli_fetch_assoc($bloodbankstockAP)){
                            $totalbloodAP2 = $totalbloodAP['AP'];
                           }
                        }else{
                          $totalbloodAP2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">A+</span>
                                <span class="text-black h3">: <?php echo  $totalbloodAP2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockBP =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockBP)){
                           while($totalbloodBP=mysqli_fetch_assoc($bloodbankstockBP)){
                            $totalbloodBP2 = $totalbloodBP['BP'];
                           }
                        }else{
                          $totalbloodBP2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">B+</span>
                                <span class="text-black h3">: <?php echo  $totalbloodBP2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockABP =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockABP)){
                           while($totalbloodABP=mysqli_fetch_assoc($bloodbankstockABP)){
                            $totalbloodABP2 = intval($totalbloodABP['ABP']);
                           }
                        }else{
                          $totalbloodABP2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">AB+</span>
                                <span class="text-black h3">: <?php echo  $totalbloodABP2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockOP =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockOP)){
                           while($totalbloodOP=mysqli_fetch_assoc($bloodbankstockOP)){
                            $totalbloodOP2 = $totalbloodOP['OP'];
                           }
                        }else{
                          $totalbloodOP2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">O+</span>
                                <span class="text-black h3">: <?php echo  $totalbloodOP2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockAM =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockAM)){
                           while($totalbloodAM=mysqli_fetch_assoc($bloodbankstockAM)){
                            $totalbloodAM2 = $totalbloodAM['AM'];
                           }
                        }else{
                          $totalbloodAM2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">A-</span>
                                <span class="text-black h3">: <?php echo  $totalbloodAM2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockBM =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockBM)){
                           while($totalbloodBM=mysqli_fetch_assoc($bloodbankstockBM)){
                            $totalbloodBM2 = $totalbloodBM['BM'];
                           }
                        }else{
                          $totalbloodBM2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">B-</span>
                                <span class="text-black h3">: <?php echo  $totalbloodBM2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockABM =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockABM)){
                           while($totalbloodABM=mysqli_fetch_assoc($bloodbankstockABM)){
                            $totalbloodABM2 = $totalbloodABM['ABM'];
                           }
                        }else{
                          $totalbloodABM2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">AB-</span>
                                <span class="text-black h3">: <?php echo  $totalbloodABM2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>

                <?php
                    $bloodbankstockOM =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        if(mysqli_num_rows($bloodbankstockOM)){
                           while($totalbloodOM=mysqli_fetch_assoc($bloodbankstockOM)){
                            $totalbloodOM2 = $totalbloodOM['OM'];
                           }
                        }else{
                          $totalbloodOM2="00";
                        }
                 ?>
                <div class="col-md-3">
                <a  class="text-decoration-none w-100 mx-2">
                    <div class="card border shadow  p-1 ">
                        <div class=" d-flex align-items-center justify-content-between p-1 mx-3" style="min-height:50px">
                             <img src="asset/img/bloodbank.svg" alt="" height="100px" width="auto">
                            <p class="donarCardTitle d-grid">
                                <span class="text-black h2">O-</span>
                                <span class="text-black h3">: <?php echo  $totalbloodOM2; ?></span>
                            </p>
                        </div>
                    </div>
                  </a>
                </div>


               </div>
           </div>
        
<?php
include_once "includes/footer.php";
?>

