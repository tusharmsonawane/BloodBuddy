<?php
session_start();
require_once "donar/includes/donarfiles/dbconfig.php";

if(!isset($_SESSION["emailverificationpage"]) || $_SESSION["emailverificationpage"] !== true){
    echo "<script>window.location.href='login'</script>";
    exit;
  }
  if(isset($_SESSION["donarpasswordaccess"]) && $_SESSION["donarpasswordaccess"] === true){
    echo "<script>window.location.href='donar/donarforgetpassword'</script>";
    exit;
  }
  if(isset($_SESSION["hospitalpasswordaccess"]) && $_SESSION["hospitalpasswordaccess"] === true){
    echo "<script>window.location.href='hospital/hospitalforgetpassword'</script>";
    exit;
  }
  if(isset($_SESSION["bloodbankpasswordaccess"]) && $_SESSION["bloodbankpasswordaccess"] === true){
    echo "<script>window.location.href='bloodbank/bloodbankforgetpassword'</script>";
    exit;
  }
 $useremail = $_SESSION['useremail'];


$queryfetchdata =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$useremail'");
        while($row = mysqli_fetch_assoc($queryfetchdata)){
            $donarname= $row['donarname'];
            $donarid= $row['donarid'];
            $donaremail =$row['donaremail'];
            $donarpassword= $row['donarpassword'];
            $donarnumber= $row['donarnumber'];
        }

if(isset($_POST['ConfirmOtpBtn'])){
    $userotp = $_POST['otpconfirm'];
    if(empty($userotp)){
         echo "empty";
         $_SESSION['otpverificationerror']="please enter otp";
    }else{
        $usercheck =mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$useremail' AND userotp='$userotp'");
        if(mysqli_num_rows($usercheck)){
                $queryuserotpupdate=mysqli_query($dlink,"UPDATE userregister SET userotp='' WHERE useremail='$useremail'");
                $querydonarforgetpassword=mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$useremail' AND usertype='donar'");
                if(mysqli_num_rows($querydonarforgetpassword)){
                        $_SESSION['donarpasswordaccess']= true;
                        $_SESSION['donaremail']= $useremail;
                        header("location:donar/donarforgetpassword");
                }else{
                    $queryhospitalforgetpassword=mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$useremail' AND usertype='hospital'");
                    if(mysqli_num_rows($queryhospitalforgetpassword)){
                        $_SESSION['hospitalpasswordaccess']= true;
                        $_SESSION['hospitalemail']= $useremail;
                        header("location:hospital/hospitalforgetpassword");
                    }else{
                        $querybloodbankforgetpassword=mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$useremail' AND usertype='bloodbank'");
                        if(mysqli_num_rows($querybloodbankforgetpassword)){
                            $_SESSION['bloodbankpasswordaccess']= true;
                            $_SESSION['bloodbankemail']= $useremail;
                            header("location:bloodbank/bloodbankforgetpassword");
                        }else{
                            $_SESSION['otpverificationerror']="something wents to wrong";
                        }
                    }
                }
        }else{
            $userverify2 =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarotp='$userotp' AND donaremail='$useremail'");
            if(mysqli_num_rows($userverify2)){
                     $queryupdateotp=mysqli_query($dlink,"UPDATE donarregister SET donarotp ='' WHERE donaremail='$useremail'");
                     if($queryupdateotp){
                        $querylogin =mysqli_query($dlink,"INSERT INTO userregister(usertype,username,userid,userpassword,useremail,usernumber,userotp) VALUES('donar','$donarname','$donarid','$donarpassword','$donaremail','$donarnumber','')");
                        if($querylogin){
                                    session_destroy();
                                    header("location:login");
                        }else{
                            $_SESSION['otpverificationerror']="something wents to wrong";
                        }
                     }else{
                        $_SESSION['otpverificationerror']="something wents to wrong";
                     }
                
            }else{
                $_SESSION['otpverificationerror']="please enter valid otp";
            }
        }
    }
  }

if(isset($_GET['outpage'])){
    session_destroy();
    header("location:login");
}

$currenttime= date("h:i a");
$currentdate =date("Y-m-d"); 

$querycheckdate=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcampdate='$currentdate'");
if(mysqli_num_rows($querycheckdate)){
    $querychecktime=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcamptimeto ='$currenttime'");
    if(mysqli_num_rows($querychecktime)){
        $querycheckstatus=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE status='pendding'");
        if(mysqli_num_rows($querycheckstatus)){
              echo "<script>window.location.reload();</script>";
             $queryupdatecamp=mysqli_query($dlink,"UPDATE bloodcamp SET status='active' WHERE status='pendding'");
        }
    }else{
        $querychecktime=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodcamptimefrom ='$currenttime'");
        if(mysqli_num_rows($querychecktime)){
            $querycheckstatus=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE status='active'");
            if(mysqli_num_rows($querycheckstatus)){
              echo "<script>window.location.reload();</script>";
              $queryupdatecamp=mysqli_query($dlink,"UPDATE bloodcamp SET status='complete' WHERE status='active'");
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodBuddy | SignIn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        .form-control{
            height: 50px;
        }
        .alert{
            text-transform: capitalize;
            color: red;
            letter-spacing: 2px;
            
        }
        .btn-primary{
            height: 45px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
  <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">

             <div class="card shadow-lg p-5  ConfirmOtpCard">
                <h1 class="text-center text-uppercase">
                    Email Verification
                </h1>
                 <hr class="mx-2">
                 <form action="otpverification" method="post">
                   <div class="form-items">
                      <input type="number" name="otpconfirm" id="" class="form-control rounded-pill" placeholder="Enter Otp" required>
                            <?php
                            if(isset($_SESSION['otpverificationerror']) && $_SESSION['otpverificationerror'] !=''){
                            echo '<span class="alert">'.$_SESSION['otpverificationerror'].'</span>';
                            unset($_SESSION['otpverificationerror']);
                            }
                            ?>
                   </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill mt-2 ConfrimOtpBtn" name="ConfirmOtpBtn">Confirm Otp</button>
                 </form>
                 <hr class="mx-2">
                 <a href="otpverification?outpage" class="text-center text-uppercase text-decoration-none text-black">Back to Page</a>
           </div>
          
        </div>
  </div>

</body>
</html>


