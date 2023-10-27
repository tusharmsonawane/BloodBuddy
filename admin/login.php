<?php
session_start();
require_once "includes/adminfiles/dbconfig.php";
if(isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] === true){
    echo "<script>window.location.href='index'</script>";
    exit;
  }
  if(isset($_SESSION["donarlogin"]) && $_SESSION["donarlogin"] === true){
    echo "<script>window.location.href='../donar/index'</script>";
    exit;
  }
  if(isset($_SESSION["hospitallogin"]) && $_SESSION["hospitallogin"] === true){
    echo "<script>window.location.href='../hospital/index'</script>";
    exit;
  }
  if(isset($_SESSION["bloodbanklogin"]) && $_SESSION["bloodbanklogin"] === true){
    echo "<script>window.location.href='../bloodbank/index'</script>";
    exit;
  }
  if(isset($_SESSION["emailverificationpage"]) && $_SESSION["emailverificationpage"] === true){
    echo "<script>window.location.href='../otpverification'</script>";
    exit;
  }
if(isset($_POST['Alogin'])){
   $useremail =$_POST['useremail'];
   $userpassword =$_POST['userpassword'];
   $currentdate = date("d:M:Y");
   $currenttime = date("h:i:s a");
   
   if(empty($useremail) && empty($userpassword)){
    $_SESSION['login_error'] ="Please enter email and password";
   }else{
        if(empty($useremail)){
            $_SESSION['login_error'] ="Please enter the email";
        }else{
            if(empty($userpassword)){
                $_SESSION['login_error'] ="Please enter the password";
            }else{
                $queryadmincheck =mysqli_query($dlink,"SELECT * FROM adminregister WHERE adminemail='$useremail'");
                if(mysqli_num_rows($queryadmincheck)){
                      while($adminrow =mysqli_fetch_assoc($queryadmincheck)){
                        if(password_verify($userpassword, $adminrow['adminpassword'])){
                            header("location:index");
                            $_SESSION['adminemail'] = $useremail;
                            $_SESSION['adminlogin'] = true;
                            $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,date,time,status) VALUES ('$useremail','admin','$currentdate','$currenttime','success')");
                          }else{
                            $_SESSION['login_error'] ="Email and password are invalid";
                            header("location:login");
                        }
                      }
                }else{

                }
            }
        }
   }
}

date_default_timezone_set('asia/kolkata');
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link href="asset/css/admin.min.css" rel="stylesheet">
    <link href="asset/css/admin.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
            body{
               font-family: 'Merriweather', serif;   
               font-size:22px;         
          }
          @media screen and (max-width:1009px){
              .card .card-body .title{
                font-size:25px;
              }
          }
          @media screen and (max-width:800px){
            .w-50{
                width:100% !important;
            }
          }
          @media screen and (max-width:400px){
            .card .card-body .title{
                display:none;
            }
            .card .card-body .p-5{
                margin:20px;
                padding:10px !important;
            }
          }

    </style>
</head>
<body class="bg-primary">
<div class="container  d-flex justify-content-center align-items-center" style="min-height:100vh">
        <div class="card border-0 shadow-lg my-5 w-50">
            <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="text-uppercase text-black fw-bold title">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
                                <h1 class="h4 text-gray-900 mb-4 my-2">Welcome To Admin!</h1>
                            </div>
                            <hr class="border border-dark">
                            <?php
                                if(isset($_SESSION['login_error']) && $_SESSION['login_error'] !=''){
                                echo '<div class="alert alert-success alert-dismissible fade show text-danger mt-2 fs-5" role="alert">
                                '.$_SESSION['login_error'].'
                                <button type="button" class="btn-close fs-6" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                                unset($_SESSION['login_error']);
                                }
                                ?>
                            <form class="user" method="post">
                                <div class="form-group">
                                    <input type="email" name="useremail" class="form-control form-control-user fs-5" placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="userpassword" class="form-control form-control-user fs-5" placeholder="Enter Password...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block fs-6" name="Alogin">LOGIN</button>
                            </form>
                            <hr class="border border-dark">
                            <div class="text-center">
                                <a class="small text-uppercase text-black text-decoration-none" href="../login">Back To Home</a>
                            </div>
                        </div>
            </div>
        </div>

    </div>
</body>
</html>