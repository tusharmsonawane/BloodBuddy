<?php
session_start();
date_default_timezone_set('asia/kolkata');
require_once "donar/includes/donarfiles/dbconfig.php";
if(isset($_SESSION["donarlogin"]) && $_SESSION["donarlogin"] === true){
    echo "<script>window.location.href='donar/index'</script>";
    exit;
  }
  if(isset($_SESSION["hospitallogin"]) && $_SESSION["hospitallogin"] === true){
    echo "<script>window.location.href='hospital/index'</script>";
    exit;
  }
  if(isset($_SESSION["bloodbanklogin"]) && $_SESSION["bloodbanklogin"] === true){
    echo "<script>window.location.href='bloodbank/index'</script>";
    exit;
  }
  if(isset($_SESSION["emailverificationpage"]) && $_SESSION["emailverificationpage"] === true){
    echo "<script>window.location.href='otpverification'</script>";
    exit;
  }
  if(isset($_SESSION["adminlogin"]) && $_SESSION["adminlogin"] === true){
    echo "<script>window.location.href='admin/index'</script>";
    exit;
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

  if(isset($_POST['bloodcamp'])){
       $bloodbankid=$_POST['bloodbankname'];
       $currentdate=date("Y-m-d");

       if(empty($bloodbankid)){
        echo "<script>window.location.href='index'</script>";
       }else{
            $querycheckbank=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$bloodbankid'");
            if(mysqli_num_rows($querycheckbank)){
                $querycheckcamp=mysqli_query($dlink,"SELECT * FROM bloodcamp WHERE bloodbankid='$bloodbankid' && status='active' && bloodcampdate='$currentdate'");
                 if(mysqli_num_rows($querycheckcamp)){
                     while($bcamprow =mysqli_fetch_assoc($querycheckcamp)){
                           $bloodcampcard='<div class="p-3 my-0" style="min-height:50vh">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <span class="text-uppercase">'.$bcamprow['bloodbankname'].'</span>
                                            <span>'.$bcamprow['bloodcampdate'].'</span>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title h2 text-uppercase">'.$bcamprow['bloodcampname'].'</h5>
                                            <p class="my-1">Start Time : '.$bcamprow['bloodcamptimeto'].'</p>
                                            <p class="my-1">End Time : '.$bcamprow['bloodcamptimefrom'].'</p>
                                            <p class="my-1">Address : '.$bcamprow['bloodcampaddress'].'</p>
                                            <p class="my-1">Status : <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span></p>
                                        </div>
                                    </div>
                            </div>';
                     }
                 }else{
                  echo '<script>alert("Blood Camp Are Not Active Today");window.location.href="index"</script>';
                 }
            }else{
              echo '<script>alert("Something Went To Wrong");window.location.href="index"</script>';
            }
       }
  }else{
      echo "<script>window.location.href='index'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>BloodBuddy | Blood Camp</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="asset/css/style.css" rel="stylesheet" />
  <link href="asset/css/bootstrap.css" rel="stylesheet" />
  <style>
       .campbox::-webkit-scrollbar{
          width:0px;
       }
  </style>
</head>

<body>
  <div class="MainContent">
    <header class="HeaderSection" id="HeaderSection">
      <div class="container">
        <nav class="navbar navbar-expand-lg CustomNavContainer">
          <a class="navbar-brand text-uppercase" href="index">
            <span>
              Blood<i class="fa-solid fa-handshake"></i>Buddy
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav ">
                <li class="nav-item active">
                  <a class="nav-link active" href="index">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index#AboutSection"> About </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index#ContactSection"> Contact us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="bloodcamp"> Blood Camp</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login">SignIn</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>


    <section class="HomeSection" >
           <div class="position-absolute top-0 start-50 translate-middle">
               <h1 class="text-uppercase"><span class="text-white">BloodCamp</span> | Donate blood</h1>
           </div>
          <div class="campbox w-100 p-3 overflow-y-scroll" style="height:70vh;margin-top:100px">
              <?php
              echo
               $bloodcampcard;
              ?>
          </div>
    </section>


</body>
</html>