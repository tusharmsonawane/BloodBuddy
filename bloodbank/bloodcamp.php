<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');

if(isset($_POST['createcamp'])){
    
    $bloodbankcampname= $_POST['bloodbankcampname'];
    $bloodbankcampaddress= $_POST['bloodbankcampaddress'];
    $bloodbankdate= $_POST['bloodbankdate'];
    $bloodbankcampto= date("h:i a", strtotime($_POST['bloodbankcampto']));
    $bloodbankcampfrom= date("h:i a", strtotime($_POST['bloodbankcampfrom']));
    $bloodcampid =rand(11111111,99999999);

    if(empty($bloodbankcampname) && empty($bloodbankcampaddress) && empty($bloodbankdate) && empty($bloodbankcampto) && empty($bloodbankcampfrom)){
            $_SESSION['bloodcamperror']= "PLEASE FILLED THE DETAILS";
    }else{
         if(empty($bloodbankcampname)){
                $_SESSION['bloodcamperror']= "PLEASE FILL THE BLOOD DONATION CAMP NAME";
         }else{
            if(empty($bloodbankcampaddress)){
                $_SESSION['bloodcamperror']= "PLEASE FILL THE BLOOD DONATION CAMP ADDRESS";
            }else{
                if(empty($bloodbankdate)){
                     $_SESSION['bloodcamperror']= "PLEASE CHOOSE THE BLOOD DONATION CAMP DATE";
                }else{
                    if(empty($bloodbankcampto)){
                       $_SESSION['bloodcamperror']= "PLEASE CHOOSE THE BLOOD DONATION CAMP START TIME";
                    }else{
                        if(empty($bloodbankcampfrom)){
                           $_SESSION['bloodcamperror']= "PLEASE CHOOSE THE BLOOD DONATION CAMP END TIME";
                        }else{
                            $querycampcheck1=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid'");
                            if(mysqli_num_rows($querycampcheck1)){
                                $querycampcheck2 =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid' AND status='pendding'");
                                if(mysqli_num_rows($querycampcheck2)){
                                       $_SESSION['bloodcamperror']= "PLEASE WAIT FOR COMPLETING THE PREVIOUS CAMP";
                                }else{ 
                                       $querycampcheck4 =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid' AND status='complete' AND bloodcampdate='$bloodbankdate'");
                                       if(mysqli_num_rows($querycampcheck4)){
                                            $_SESSION['bloodcamperror']= "OOPS ! CHOOSE ANOTHER DATE";
                                       }else{
                                           $querycampcheck5 =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid' AND status='completed'");
                                           if(mysqli_num_rows($querycampcheck5)){
                                              $querycampcheck6 =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                                              if(mysqli_num_rows($querycampcheck6)){
                                                        $queryregistercamp=mysqli_query($dlink,"INSERT INTO bloodcamp (bloodcampid,bloodbankname,bloodbankid,bloodcampname,bloodcampaddress,bloodcampdate,bloodcamptimeto,bloodcamptimefrom) VALUES('$bloodcampid','$username','$bloodbankid','$bloodbankcampname','$bloodbankcampaddress','$bloodbankdate','$bloodbankcampto','$bloodbankcampfrom')");
                                                        if($queryregistercamp){
                                                            $_SESSION['bloodcampsuccess']= "Successfully register";
                                                        }else{
                                                            $_SESSION['bloodcamperror']= "SOMETHING WENT WRONG";
                                                        }
                                              }else{
                                                 echo '<script>window.location.href="updatestock"</script>';
                                              }
                                           }else{
                                                        $_SESSION['bloodcamperror']= "PLEASE WAIT FOR COMPLETING THE PREVIOUS CAMP";
                                           }
                                       }
                                     
                                    
                                }
                            }else{
                                $querycampcheck6 =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                                if(mysqli_num_rows($querycampcheck6)){
                                    $queryregistercamp=mysqli_query($dlink,"INSERT INTO bloodcamp (bloodcampid,bloodbankname,bloodbankid,bloodcampname,bloodcampaddress,bloodcampdate,bloodcamptimeto,bloodcamptimefrom) VALUES('$bloodcampid','$username','$bloodbankid','$bloodbankcampname','$bloodbankcampaddress','$bloodbankdate','$bloodbankcampto','$bloodbankcampfrom')");
                                    if($queryregistercamp){
                                         $_SESSION['bloodcampsuccess']= "Successfully register";
                                    }else{
                                       $_SESSION['bloodcamperror']= "PLEASE TRY AGAIN";
                                    }
                                }else{
                                    echo '<script>window.location.href="updatestock"</script>';
                                }
                            }
                        }
                    }
                }
            }
         }
    }
}


        $bloodcampbtnstatus="";
        $btnclass="btn-primary my-0 text-white";
        $btnname="Active";


if(isset($_POST['bloodcampstock'])){
    $bloodcampid= $_GET['bi'];
    $AP =$_POST['AP'];
    $BP =$_POST['BP'];
    $ABP =$_POST['ABP'];
    $OP =$_POST['OP'];
    $AM =$_POST['AM'];
    $BM =$_POST['BM'];
    $ABM =$_POST['ABM'];
    $OM =$_POST['OM'];

    if(empty($AP) && empty($BP) && empty($ABP) && empty($OP) && empty($AM) &&empty($BM) && empty($ABM) && empty($OM)){
         $_SESSION['bloodcamperror']= "Please Filled The Details";
    }else{
            $querycheckcampstock=mysqli_query($dlink,"SELECT * FROM bloodcampstock WHERE bloodcampid='$bloodcampid' AND bloodbankid='$bloodbankid'");
            if(mysqli_num_rows($querycheckcampstock)){
            echo "<script>alert('Something went to wrong');window.location.href='bloodcamp'</script>";
            }else{
                $queryupdatedata=mysqli_query($dlink,"INSERT INTO bloodcampstock (bloodbankid,bloodcampid,AP,BP,ABP,OP,AM,BM,ABM,OM) VALUES('$bloodbankid','$bloodcampid','$AP','$BP','$ABP','$OP','$AM','$BM','$ABM','$OM')");
                if($queryupdatedata){
                $queryupdatestatus=mysqli_query($dlink,"UPDATE bloodcamp SET status='completed' WHERE bloodcampid='$bloodcampid'");
                if($queryupdatestatus){
                    $queryfetchstockdata=mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                        while($bloodstockrow =mysqli_fetch_assoc($queryfetchstockdata)){
                        $AP1 =$bloodstockrow['AP'];
                        $BP1 =$bloodstockrow['BP'];
                        $ABP1 =$bloodstockrow['ABP'];
                        $OP1 =$bloodstockrow['OP'];
                        $AM1 =$bloodstockrow['AM'];
                        $BM1 =$bloodstockrow['BM'];
                        $ABM1 =$bloodstockrow['ABM'];
                        $OM1 =$bloodstockrow['OM'];
                        }
                    $queryupdatestock =mysqli_query($dlink,"UPDATE bloodstock SET AP=($AP1 + $AP),BP=($BP1 + $BP),ABP=($ABP1 + $ABP),OP=($OP1 + $OP),AM=($AM1 + $AM),BM=($BM1 + $BM),ABM=($ABM1 + $ABM),OM=($OM1 + $OM) WHERE bloodbankid='$bloodbankid'");
                    if($queryupdatestock){
                        echo "<script>alert('updated successfuly');window.location.href='bloodcamp'</script>";
                    }else{
                        echo "<script>alert('Something went wrong');window.location.href='bloodcamp'</script>";
                    }
                }
                }else{
                echo "<script>alert('Something went wrong');window.location.href='bloodcamp'</script>";
                }
            }

    }

}

if(isset($_GET['bi'])){
    $bloodcampbtnstatus="data-bs-toggle='modal' data-bs-target='#bloodcampcomplete'";
    $btnname="click again";
}else{
     $bloodcampbtnstatus="";
     $btnname ="complete";
}
?>

<div class="container-fluid">
     <div class="card">
         <h1 class="text-uppercase text-black text-center p-2 mt-2 my-0">Blood donation Camp</h1>
         <hr class="mx-2">

         <form method="post" class="m-3">
             <input type="text" name="bloodbankcampname" id="" class="form-control" placeholder="Blood Camp Name">
             <input type="text" name="bloodbankcampaddress" id="" class="form-control" placeholder="Blood Camp Address">
             <input type="date" min="<?php echo $currentdate;?>"  name="bloodbankdate" id="" class="form-control" placeholder="Blood Bank date" style="margin-right:5px">
              <div class="d-flex">
              <input type="time"  name="bloodbankcampto" id="" class="form-control" placeholder="Blood Bank time to">
              <input type="time" name="bloodbankcampfrom" id="" class="form-control" placeholder="Blood Bank  time from">
              </div>
              <button class="btn btn-success text-uppercase w-100 mt-2" name="createcamp">upload</button>
         </form>
     </div>

     <div class="camphistory">
         <div class="card mt-2"> 
            <h2 class="m-2 mt-1 mx-3">Previous Camp</h2>
            <hr>
            <?php
              $querytable=mysqli_query($dlink,"SELECT * FROM bloodcamp");
              if($totalrow =mysqli_num_rows($querytable)){
                  if($totalrow >10){
                     $class="dataTable";
                  }else{
                     $class="";
                  }
              }
            ?>
            <div class="table-responsive position-relative p-2">
         <table class="table table-bordered text-capitalize" width="100%" id="<?php echo $class;?>" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Camp Id</th>
                                    <th>Blood Camp Name:</th>
                                    <th>Date</th>
                                    <th>More</th>
                                    <th>About Camp</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                           
                           
                           $querycampfetch =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid'");
                           if(mysqli_num_rows($querycampfetch)){
                                 while($camprow =mysqli_fetch_assoc($querycampfetch)){
                                    $bloodcampid = $camprow['bloodcampid'];
                                     
                                    $querybloodcampstatus =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampid='$bloodcampid' AND status='pendding'  AND bloodcampid='$bloodcampid'");
                                    if(mysqli_num_rows($querybloodcampstatus)){
                                        $bloodcampbtnstatus="";
                                        $btnclass="btn-warning text-white my-0 m-0";
                                        $btnname="pendding"; 
                                    }else{
                                        $querybloodcampstatus =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampid='$bloodcampid' AND status='active' AND bloodcampid='$bloodcampid'");
                                        if(mysqli_num_rows($querybloodcampstatus)){
                                            $bloodcampbtnstatus="";
                                            $btnclass="btn-primary text-white my-0 m-0";
                                            $btnname="Active"; 
                                        }else{
                                            $querybloodcampstatus =mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampid='$bloodcampid' AND status='complete' AND bloodcampid='$bloodcampid'");
                                            if(mysqli_num_rows($querybloodcampstatus)){
                                                $btnclass="btn-warning text-white my-0 m-0";
                                            }else{
                                                $btnclass="btn-primary text-white my-0 m-0";
                                                $btnname="completed";
                                                $bloodcampbtnstatus="";
                                            }
                                        }
                                    }

                                   static $no = 0;
                                          $no++;

                                    echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.$camprow['bloodcampid'].'</td>
                                    <td>'.$camprow['bloodbankname'].'</td>
                                    <td>'.date("d-M-Y", strtotime($camprow['bloodcampdate'])).'</td>
                                    <td><a href="?aboutcamp='.$camprow['bloodcampid'].'" class="text-decoration-none">More</a></td>
                                    <td>
                                    <a href="?bi='.$camprow['bloodcampid'].'" class="btn '.$btnclass.' w-100 text-uppercase fw-bolder text-black " '.$bloodcampbtnstatus.'>'.$btnname.'</a>
                                    </td>
                                </tr>';
                                $appointmentid=$camprow['bloodcampid'];


                                                    $querycampstatus=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid' AND status='pendding' AND bloodcampid='$appointmentid'");
                                                    if(mysqli_num_rows($querycampstatus)){
                                                        $currenttime= date("h:i a");
                                                        $currentdate =date("Y-m-d");     
                                                        $queryupdatestatus1=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampdate='$currentdate' AND bloodcampid='$appointmentid'");
                                                        if(mysqli_num_rows($queryupdatestatus1)){
                                                            $queryupdatestatus2=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcamptimeto ='$currenttime'");
                                                            if(mysqli_num_rows($queryupdatestatus2)){
                                                                $queryupdatestatusvalue1=mysqli_query($dlink,"UPDATE bloodcamp SET status='active' WHERE bloodbankid='$bloodbankid' AND status='pendding' AND bloodcampid='$appointmentid'");
                                                                if($queryupdatestatusvalue1){
                                                                    echo "
                                                                        <script>
                                                                        window.setTimeout( function() {
                                                                        window.location.reload();
                                                                        }, 100);
                                                                        </script>
                                                                    ";
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        $currenttime= date("h:i a");
                                                        $currentdate =date("Y-m-d"); 
                                                        $queryupdatestatus3=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcamptimefrom ='$currenttime' AND status='active' AND bloodcampid='$appointmentid'");
                                                        if(mysqli_num_rows($queryupdatestatus3)){
                                                            $queryupdatestatusvalue2=mysqli_query($dlink,"UPDATE bloodcamp SET status='complete' WHERE bloodbankid='$bloodbankid' AND status='active' AND bloodcampid='$appointmentid'");
                                                                if($queryupdatestatusvalue2){
                                                                    echo "
                                                                    <script>
                                                                    window.setTimeout( function() {
                                                                    window.location.reload();
                                                                    }, 100);
                                                                    </script>
                                                                ";
                                                                }
                                                        }
                                                    }


                                 }
                           }else{
                                echo '<span class="fs-5 text-uppercase" >No Blood Camp available</span>';
                           }


   


                           ?>
                            
                            </tbody>

                        </table>
                        </div>
         </div>
     </div>

</div>




<?php
if(isset($_GET['didid'])){
    echo '<script>
    swal({
      title: "Are You Sure?",
      text: "Once deleted, you will not be able to recover this data!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
         window.location.href="bloodcamp?deleteid='.$_GET['didid'].'";
      } else {
          window.location.href="bloodcamp";
      }
    });
    </script>';
}
if(isset($_GET['deleteid'])){
     $campid =$_GET['deleteid'];

     $querycheckcamp = mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampid='$campid'");
     if(mysqli_num_rows($querycheckcamp)){
        $querycheckstock = mysqli_query($dlink,"SELECT * FROM bloodcampstock WHERE bloodcampid='$campid'");
        if(mysqli_num_rows($querycheckstock)){
            $querydelete1 = mysqli_query($dlink,"DELETE  FROM bloodcamp WHERE bloodcampid='$campid'");
            $querydelete2 = mysqli_query($dlink,"DELETE  FROM bloodcampstock WHERE bloodcampid='$campid'");

            if( $querydelete1){
                echo '<script>
                swal({
                  title: "Successfuly Deleted",
                  icon: "success",
                  buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="bloodcamp";
                    }
                  });
                </script>';
            }
        }else{
            $querydelete1 = mysqli_query($dlink,"DELETE  FROM bloodcamp WHERE bloodcampid='$campid'");
            
            if( $querydelete1){
                echo '<script>
                swal({
                  title: "Successfuly Deleted",
                  icon: "success",
                  buttons: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href="bloodcamp";
                    }
                  });
                </script>';
            }
        }
         
     }else{
       echo "";
     }

}

if(isset($_GET['aboutcamp'])){
   $querycamp=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampid='$_GET[aboutcamp]'");
   if(mysqli_num_rows($querycamp)){
      while($aboutrow =mysqli_fetch_array($querycamp)){
        $querybankabout1=mysqli_query($dlink,"SELECT * FROM bloodcampstock WHERE bloodcampid='$_GET[aboutcamp]'");
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
        echo '
        <div class="card border-0 p-2 shadow m-4 position-absolute top-0 end-0 me-5">
        <div class="d-flex justify-content-end me-2 mt-1">
        <a href="bloodcamp"><i class="fa fa-close fs-5"></i></a>
        </div>
            <div class="card-body">
                <div class="">
                <p>BloodCamp Name : '.$aboutrow['bloodcampname'].'</p>
                <p>BloodBank Name : '.$aboutrow['bloodbankname'].'</p>
                <p>BloodCamp Id : '.$aboutrow['bloodcampid'].'</p>
                <p>BloodCamp Address : '.$aboutrow['bloodcampaddress'].'</p>
                <p>BloodCamp Time : '.$aboutrow['bloodcamptimeto'].'</p>
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
                                                 
                <div class="d-flex">
                <a href="?didid='.$aboutrow['bloodcampid'].'" class="btn btn-danger w-100 mx-1">Delete <i class="fa fa-trash"></i></a>
                </div>
            </div>
    </div>
    ';
      }
   }
}else{
    echo "";
}

?>



<?php
include "includes/footer.php";
?>

<?php
                if(isset($_SESSION['bloodcampsuccess'])){
                        echo '<script>
                                swal({
                                    title: "'.$_SESSION['bloodcampsuccess'].'",
                                    icon: "success",
                                    button: "Done",
                                })
                                .then((willDelete) => {
                                    if (willDelete) {
                                        window.location.href="bloodcamp";
                                    } else {
                                        window.location.href="bloodcamp";
                                    }
                                });
                            </script>';
                        unset($_SESSION['bloodcampsuccess']);
                }

                if(isset($_SESSION['bloodcamperror'])){
                    echo '<script>
                            swal({
                                title: "'.$_SESSION['bloodcamperror'].'",
                                icon: "warning",
                                button: "Done",
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    window.location.href="bloodcamp";
                                } else {
                                    window.location.href="bloodcamp";
                                }
                            });
                        </script>';
                    unset($_SESSION['bloodcamperror']);
            }
                ?>



<div class="modal fade" id="bloodcampcomplete">
             <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4>Blood Camp Status</h4>
                        <a href="bloodcamp" class="btn-close" ></a>
                    </div>
                    <div class="modal-body">
                        <form  method="post">
                                <input type="text" name="AP" id=""  class="form-control" placeholder="A+" value="0">
                                <hr class="mx-3">

                                <input type="text" name="BP" id="" class="form-control" placeholder="B+" value="0">
                                <hr class="mx-3">

                                <input type="text" name="ABP" id=""  class="form-control" placeholder="AB+" value="0">
                                <hr class="mx-3">

                                <input type="text" name="OP" id="" class="form-control" placeholder="O+" value="0">
                                <hr class="mx-3">

                                <input type="text" name="AM" id="" class="form-control" placeholder="A-" value="0">
                                <hr class="mx-3">

                                <input type="text" name="BM" id="" class="form-control" placeholder="B-" value="0">
                                <hr class="mx-3">

                                <input type="text" name="ABM" id="" class="form-control" placeholder="AB-" value="0">
                                <hr class="mx-3">

                                <input type="text" name="OM" id="" class="form-control" placeholder="O-" value="0">
                                <hr class="mx-3">

                                <button type="submit" class="btn btn-success text-uppercase" name="bloodcampstock">Done</button>
                        </form>
                    </div>
                  </div>
             </div>
        </div>