<?php
 include "includes/header.php";
 include "includes/topbar.php";
 
?>

<?php
if(isset($_GET['registration'])){
    $querydonarregister=mysqli_query($dlink,"SELECT * FROM donarregister");
     if($registerrow=mysqli_num_rows($querydonarregister)){
        if($registerrow>=10){
             $tableclass="dataTable";
        }else{
            $tableclass="";
        }
            echo '
            <div class="card shadow  m-2 ">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">Donor Registrations: </h6>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                      <table class="table table-bordered" id="'.$tableclass.'" width="100%" cellspacing="0">
                         <thead>
                             <td>No</td>
                             <td>D. Id</td>
                             <td>Name</td>
                             <td>Email</td>
                             <td>About</td>
                         </thead>
                         <tbody class="text-capitalize">';
                         while($donarrow =mysqli_fetch_assoc($querydonarregister)){
                            if($donarrow['donarbloodgroup'] =="AP"){
                                $donarbloodgroup = "A+";
                            }else{
                                if($donarrow['donarbloodgroup'] =="BP"){
                                $donarbloodgroup = "B+";
                                }else{
                                    if($donarrow['donarbloodgroup'] =="ABP"){
                                        $donarbloodgroup = "AB+";
                                    }else{
                                        if($donarrow['donarbloodgroup'] =="OP"){
                                            $donarbloodgroup = "O+";
                                        }else{
                                            if($donarrow['donarbloodgroup'] =="AM"){
                                                $donarbloodgroup = "A-";
                                            }else{
                                                if($donarrow['donarbloodgroup'] =="BM"){
                                                    $donarbloodgroup = "B-";
                                                }else{
                                                    if($donarrow['donarbloodgroup'] =="ABM"){
                                                        $donarbloodgroup = "AB-";
                                                    }else{
                                                        if($donarrow['donarbloodgroup'] =="OM"){
                                                            $donarbloodgroup = "O-";
                                                        }else{
                                                        $donarrow['donarbloodgroup']="";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            static $no =0;
                            $no++;

                            echo '<tr>
                             <th>'.$no.'</th>
                             <th>'.$donarrow['donarid'].'</th>
                             <th>'.$donarrow['donarname'].'</th>
                             <th>'.$donarrow['donaremail'].'</th>
                             <th class="d-flex h-100">
                               <a href="?Dinfo='.$donarrow['donarid'].'">More</a>
                             </th>
                             </tr>';
                         }
                         '</tbody>
                      </table>
                 </div>
             </div>
         </div>';
     }else{
        echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Donor found</span>';
     }
}else{
   if(isset($_GET['appointment'])){
    $querydonarappointment=mysqli_query($dlink,"SELECT * FROM donarappointment ");
    if($appointmentrow = mysqli_num_rows($querydonarappointment)){
        if($appointmentrow >=10){
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
                                <table class="table table-bordered" id="'.$tableclass.'" width="100%" cellspacing="0">
                                    <thead>
                                        <td>No</td>
                                        <td>Appointment Id</td>
                                        <td>Name</td>
                                        <td>B. Name</td>
                                        <td>date</td>
                                        <td>Time</td>
                                        <td>Status</td>
                                    </thead>
                                    <tbody class="text-capitalize">';
                                    while($donarArow =mysqli_fetch_assoc($querydonarappointment)){
                                        $querybankname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$donarArow[bloodbankid]'");
                                            while($bankrow =mysqli_fetch_array($querybankname)){
                                                $bloodbankname =$bankrow['username'];
                                            }
                                            static $no =0;
                                            $no++;
                                            $querydonarstatus=mysqli_query($dlink,"SELECT * FROM donarappointment WHERE appointmentid='$donarArow[appointmentid]' AND status='complete'");
                                            if(mysqli_num_rows($querydonarstatus)){
                                               while($appointmentdate=mysqli_fetch_assoc($querydonarstatus)){
                                                 $statusdate= $appointmentdate['completedate'];
                                               }
                                            }else{
                                                $statusdate= $donarArow['bookdate'];
                                            }

                                        echo '<tr>
                                        <th>'.$no.'</th>
                                        <th>'.$donarArow['appointmentid'].'</th>
                                        <th>'.$donarArow['donarname'].'</th>
                                        <th>'.$bloodbankname.'</th>
                                        <th>'.date("d-M-Y", strtotime($statusdate)).'</th>
                                        <th>'.date("h:i a", strtotime($donarArow['completetime'])).'</th>
                                        <th>'.$donarArow['status'].'</th>
                                        </tr>';
                                        }
                                    '</tbody>
                                </table>
                            </div>
                        </div>
                    </div>';
        }else{
            echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Donor appointment found</span>';
        }
   }else{
       if(isset($_GET['request'])){
        $querydonarrequest=mysqli_query($dlink,"SELECT * FROM hospitalrequest");
            if($requestrow = mysqli_num_rows($querydonarrequest)){
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
                                                    <table class="table table-bordered" id="'.$tableclass.'" width="100%" cellspacing="0">
                                                    <thead>
                                                        <td>No</td>
                                                        <td>Request Id</td>
                                                        <td>Name</td>
                                                        <td>H. Name</td>
                                                        <td>status</td>
                                                        <td>Date</td>
                                                        <td>Time</td>
                                                    </thead>
                                                    <tbody class="text-capitalize">';
                                                    while($donaRrow =mysqli_fetch_assoc($querydonarrequest)){
                                                        $querydonarname=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$donaRrow[donarid]'");
                                                            while($donarnrow =mysqli_fetch_array($querydonarname)){
                                                                $donarname =$donarnrow['username'];
                                                            }

                                                        static $no =0;
                                                        $no++;

                                                        echo '<tr>
                                                        <th>'.$no.'</th>
                                                        <th>'.$donaRrow['requestid'].'</th>
                                                        <th>'.$donarname.'</th>
                                                        <th>'.$donaRrow['hospitalname'].'</th>
                                                        <th>'.$donaRrow['status'].'</th>
                                                        <th>'.date("d-M-Y", strtotime($donaRrow['responsedate'])).'</th>
                                                        <th>'.date("h:i a", strtotime($donaRrow['responsetime'])).'</th>
                                                        </tr>';
                                                    }
                                                    '</tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>';
            }else{
                echo '<span class="d-flex justify-content-center align-items-center fs-1 text-uppercase fw-bolder" style="height:50vh">no Donor request found</span>';
            }
       }else{
        if(isset($_GET['did'])){
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
                   window.location.href="donar?deleteid='.$_GET['did'].'";
                } else {
                    window.location.href="donar?registration";
                }
              });
              </script>';
        }else{
             if(isset($_GET['deleteid'])){
                  $donarid =$_GET['deleteid'];

                  $querydonar1=mysqli_query($dlink,"DELETE FROM donarregister WHERE donarid='$donarid'");
                  if($querydonar1){
                    $querydonar2=mysqli_query($dlink,"DELETE FROM userregister WHERE userid='$donarid'");
                    if($querydonar2){
                        $querydonar3=mysqli_query($dlink,"DELETE FROM donarappointment WHERE donarid='$donarid'");
                        if($querydonar3){
                            $querydonar3=mysqli_query($dlink,"DELETE FROM hospitalrequest WHERE donarid='$donarid'");
                            if($querydonar3){
                                echo '<script>
                                swal({
                                    title: "Deleted",
                                    icon: "success",
                                    buttons: true,
                                  })
                                  .then((willDelete) => {
                                    if (willDelete) {
                                       window.location.href="donar?registration";
                                    }
                                  });
                                </script>';
                            }
                        }
                    }
                  }
             }else{
                 if(isset($_GET['eid'])){
                    $queryupdatedata =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$_GET[eid]'");
                    if(mysqli_num_rows($queryupdatedata)){
                          while($donardata =mysqli_fetch_assoc($queryupdatedata)){
                            echo '<div class="">
                                    <div class="text-center">
                                        <img src="../donar/asset/donarprofile/'.$donardata['donarprofile'].'" class="rounded-pill border" alt="" height="120px" width="120px">
                                        <p class="mt-2 text-uppercase">'.$donardata['donarname'].'</p>
                                    </div>
                                </div>
                                <hr class="mx-5">
                                <form action="includes/adminfiles/update?deditid='.$_GET['eid'].'"  method="post" class="form-group mx-5">
                                    <div class="">
                                    <input type="text" name="dname" id="" class="form-control mt-2" placeholder="Donor name" value="'.$donardata['donarname'].'">
                                    </div>
                                    <div class="">
                                    <input type="date" name="ddob" id="" class="form-control mt-2" placeholder="Donor dob" value="'.$donardata['donardob'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="dnumber" id="" class="form-control mt-2" placeholder="Donor mobile number" value="'.$donardata['donarnumber'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="daddress" id="" class="form-control mt-2" placeholder="Donor Address" value="'.$donardata['donaraddress'].'">
                                    </div>
                                    <div class="">
                                    <input type="text" name="dpassword" id="" class="form-control mt-2" placeholder="Donor password" value="">
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2 btn-block" name="updatedonar">Update</button>
                                </form>';
                          }
                    }else{
                       echo "<script>window.location.href='index'</script>";
                    }
                 }else{
                    if(isset($_GET['Dinfo'])){
                        $donarid =$_GET['Dinfo'];

                        $querydonarinfo =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$donarid'");
                        if(mysqli_num_rows($querydonarinfo)){
                           while($donarrow=mysqli_fetch_assoc($querydonarinfo)){
                                        if($donarrow['donarbloodgroup'] =="AP"){
                                            $donarbloodgroup = "A+";
                                        }else{
                                            if($donarrow['donarbloodgroup'] =="BP"){
                                            $donarbloodgroup = "B+";
                                            }else{
                                                if($donarrow['donarbloodgroup'] =="ABP"){
                                                    $donarbloodgroup = "AB+";
                                                }else{
                                                    if($donarrow['donarbloodgroup'] =="OP"){
                                                        $donarbloodgroup = "O+";
                                                    }else{
                                                        if($donarrow['donarbloodgroup'] =="AM"){
                                                            $donarbloodgroup = "A-";
                                                        }else{
                                                            if($donarrow['donarbloodgroup'] =="BM"){
                                                                $donarbloodgroup = "B-";
                                                            }else{
                                                                if($donarrow['donarbloodgroup'] =="ABM"){
                                                                    $donarbloodgroup = "AB-";
                                                                }else{
                                                                    if($donarrow['donarbloodgroup'] =="OM"){
                                                                        $donarbloodgroup = "O-";
                                                                    }else{
                                                                    $donarrow['donarbloodgroup']="";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    echo '<div class="card border-0 p-5 shadow m-4">
                                    <div class="d-flex justify-content-end">
                                    <a href="donar?registration"><i class="fa fa-close"></i></a>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                        <img src="../donar/asset/donarprofile/'.$donarrow['donarprofile'].'" height="150px" width="150px" class="rounded-circle">
                                            <p class="text-uppercase mt-2">'.$donarrow['donarname'].'</p>
                                        </div>
                                        <hr class="">
                                        <div class="">
                                            <p class="text-capitalize">Donor Name : '.$donarrow['donarname'].'</p>
                                            <p class="text-capitalize">Donor Email : '.$donarrow['donaremail'].'</p>
                                            <p>Donor Mobile Number : '.$donarrow['donarnumber'].'</p>
                                            <p class="text-capitalize">Donor Gender : '.$donarrow['donargender'].'</p>
                                            <p class="text-capitalize">Donor Birthdate : '.date("d-M-Y", strtotime($donarrow['donardob'])).'</p>
                                            <p class="text-capitalize">Donor Blood Group : '.$donarbloodgroup.'</p>
                                            <p class="text-capitalize">Donor Address : '.$donarrow['donaraddress'].'</p>
                                            <p class="text-capitalize">Donor Occupation : '.$donarrow['donaroccuption'].'</p>
                                        </div>
                                        <hr>
                                        <div class="d-flex">
                                        <a href="?eid='.$donarrow['donarid'].'" class="btn btn-success w-100 mx-1">Edit <i class="fa fa-edit"></i></a>
                                        <a href="?did='.$donarrow['donarid'].'" class="btn btn-danger w-100 mx-1">Delete <i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>';
                           }
                        }else{
                            echo "<script>window.location.href='index'</script>";
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