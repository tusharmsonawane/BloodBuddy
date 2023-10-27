<?php
session_start();
require_once "includes/hospitalfiles/dbconfig.php";
date_default_timezone_set('asia/kolkata');
if(!isset($_SESSION["hospitalpasswordaccess"]) || $_SESSION["hospitalpasswordaccess"] !== true){
    echo "<script>window.location.href='../login'</script>";
    exit;
  }

  if(isset($_POST['resetpassword'])){
    $hospitalpassword =$_POST['hospitalpassword'];
    $hospitalconfirmpassword =$_POST['hospitalconfirmpassword'];
    $useremail =$_SESSION['hospitalemail'];

   if(empty($hospitalpassword) && empty($hospitalconfirmpassword)){
       $_SESSION['resetpassworderror']="please enter the password";
   }else{
      if(empty($hospitalpassword)){
          $_SESSION['resetpassworderror1']="please enter the reset password";
      }else{
         if(empty($hospitalconfirmpassword)){
          $_SESSION['resetpassworderror2']="please enter the confirm password";
         }else{
           if(strlen($hospitalpassword)>2){
              if($hospitalpassword == $hospitalconfirmpassword){
                   $querypasswordcheck=mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$useremail'");
                   while($passwordfetch =mysqli_fetch_assoc($querypasswordcheck)){
                      if(password_verify($hospitalpassword, $passwordfetch['userpassword'])){
                          $_SESSION['resetpassworderror']="please use another password";
                      }else{
                          $resethashpassword = password_hash($hospitalpassword, PASSWORD_DEFAULT);
                          $querypasswordupdate=mysqli_query($dlink,"UPDATE userregister SET userpassword='$resethashpassword' WHERE useremail='$useremail'");
                          if($querypasswordupdate){
                               $querypasswordupdatehospital=mysqli_query($dlink,"UPDATE hospitalregister SET hospitalpassword=' $resethashpassword' WHERE hospitalemail='$useremail'");
                               if($querypasswordupdatehospital){
                                   session_destroy();
                                   header("location:../login");
                               }else{
                                  $_SESSION['resetpassworderror']="something wents to wrong";
                               }
                          }else{
                              $_SESSION['resetpassworderror']="Something wents to wrong";
                          }
                      }
                   }
              }else{
                  $_SESSION['resetpassworderror']="password and confirm password are not match";
              }
           }else{
              $_SESSION['resetpassworderror']="password should be greater than 7 charector";
           }
          }
      }
   }
  }




  if(isset($_GET['outpage'])){
    header("location:../login");
    session_destroy();
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
            height:50px; 
            padding:0 20px;
            font-size:20px;
            margin-top: 10px;
        }
        .passwordEye{
            position: absolute;
            top:  16%;
            right: 15px;
            color: #aaa;
        }
        .passwordEye:hover{
            color: #000;
        }
        .btn-success{
            height: 50px;
            font-size: 25px;
            margin-top: 10px;
        }
        .card{
            padding: 30px;
        }
        @media screen and (max-width:500px){
            p{
                display: none;
            }
            h1{
                font-size:50px;
            }
        }
        @media screen and (max-width:420px){
            .card{
                padding: 30px;
            }
        }
    </style>
</head>
<body>
  <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="min-height:100vh">
           <div class="card shadow-lg">
                <h1 class="text-center">Reset Your Password</h1>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <?php
                if(isset($_SESSION['resetpassworderror']) && $_SESSION['resetpassworderror'] !=''){
                echo '<div class="alert alert-success alert-dismissible fade show text-uppercase text-danger" role="alert">
                '.$_SESSION['resetpassworderror'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['resetpassworderror']);
                }
                ?>
                <hr class="mx-2">
                <form action="#" method="post">
                    <div class="form-items position-relative">
                        <input type="password" name="hospitalpassword" id="" class="form-control rounded-pill" placeholder="Enter New Password">
                        <span class="passwordEye"><i class="fa-solid fa-eye"></i></span>
                        <?php
                            if(isset($_SESSION['resetpassworderror1']) && $_SESSION['resetpassworderror1'] !=''){
                            echo '<span class="alert text-danger">'.$_SESSION['resetpassworderror1'].'</span>';
                            unset($_SESSION['resetpassworderror1']);
                            }
                        ?>
                    </div>
                    <div class="form-items position-relative">
                        <input type="password" name="hospitalconfirmpassword" id="" class="form-control rounded-pill" placeholder="Enter Confirm Password">
                        <span class="passwordEye"><i class="fa-solid fa-eye"></i></span>
                        <?php
                            if(isset($_SESSION['resetpassworderror2']) && $_SESSION['resetpassworderror2'] !=''){
                            echo '<span class="alert text-danger">'.$_SESSION['resetpassworderror2'].'</span>';
                            unset($_SESSION['resetpassworderror2']);
                            }
                        ?>
                    </div>
                    <div class="form-items">
                        <button type="submit" class="btn btn-success w-100 rounded-pill" name="resetpassword">Reset Password</button>
                    </div>
                </form>
                <hr class="mx-2">
                <a href="hospitalforgetpassword?outpage" class="text-center text-decoration-none">Back To Home</a>
           </div>
      </div>
  </div>
</body>
</html>