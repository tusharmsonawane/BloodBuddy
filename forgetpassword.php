<?php
session_start();
require_once "donar/includes/donarfiles/dbconfig.php";
include('asset/smtp/PHPMailerAutoload.php');
date_default_timezone_set('asia/kolkata');

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

if(isset($_POST['SendOtpBtn'])){
    $useremail = $_POST['useremail'];
    $otp = rand(111111,999999);
     $currentdate =date("d/m/Y");
     $currenttime =date("h:i:sa");

    if(empty($useremail)){
       $_SESSION['forgeterror'] = 'please filled the email id';
    }else{
       $usercheck =mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$useremail'");
       if(mysqli_num_rows($usercheck)){
            while($userrow =mysqli_fetch_assoc($usercheck)){
              $username= $userrow['username'];
            }
            $userverification =mysqli_query($dlink,"UPDATE userregister SET userotp='$otp' WHERE useremail='$useremail'");
            if($userverification){
              $msg ='<div style="display:flex;justify-content:center;align-items:center;min-height:100vh">
              <div style="padding:5px;height:100%;width:450px">
                 <div style="border:1px solid #000;">
                     <h1 style="text-align:center;text-transform:uppercase;padding:5px;background:#222730;color:#fff">Bloodbuddy</h1>
                 </div>
                 <div  style="padding:10px;border:1px solid #000;">
                 <p style="padding:5px 5px;">DEAR ,<span style="text-transform:uppercase">'.$username.'</span></p>
                   <h2 style="padding:5px 5px 0px 0px;font-weight:800;">forget Password:</h2>
                    <p style="line-height:20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae optio laudantium deserunt?</p>
                     <h4 style="text-align:center;padding:4px 0px 0px 0px;font-size:22px;font-weight:500">Verification Code :</h4>
                    <h1 style="text-align:center">'.$otp.'</h1>
                    <p style="text-align:center">(This code is valid for once.)</p>
                 </div>
                 <div style="border:1px solid #000;padding:10px;line-height:20px">
                     <p><b>BloodBuddy Team</b> will never email you and ask you to disclose or verify you password.credit card or banking account number.</p>
                 </div>
              </div>
           </div>';

              $mail = new PHPMailer(); 
              $mail->IsSMTP(); 
              $mail->SMTPAuth = true; 
              $mail->SMTPSecure = 'ssl'; 
              $mail->Host = "smtp.gmail.com";
              $mail->Port = 465; 
              $mail->IsHTML(true);
              $mail->CharSet = 'UTF-8';
              $mail->Username = "isttush@gmail.com";
              $mail->Password = "foyixrosiqxhhoes";
              $mail->SetFrom("BloodBuddy Team");
              $mail->AddAddress($useremail);
              $mail->Subject = "Forget Password: Otp Verification";
              $mail->Body =$msg;
              $mail->SMTPOptions=array('ssl'=>array(
                  'verify_peer'=>false,
                  'verify_peer_name'=>false,
                  'allow_self_signed'=>false
              ));
              if(!$mail->Send()){
                  echo $mail->ErrorInfo;
              }else{
                $_SESSION['emailverificationpage'] =true;
                $_SESSION['useremail']= $useremail;
                header("location: otpverification");
              }
            }
           
       }else{
        $_SESSION['forgeterror'] = 'please enter valid email';
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
        @media screen and (max-width:390px){
            .SendOtpCard h1{
                  font-size:18px;
            }
        }
    </style>
</head>
<body>
  <div class="container">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
             <div class="card shadow-lg p-5 SendOtpCard">
                  <h1 class="text-center text-uppercase">
                    Forget Password
                  </h1>
                   <hr class="mx-2">
                   <form  method="post">
                     <div class="form-items">
                        <input type="email" name="useremail" id="" class="form-control rounded-pill SendOtpInput " placeholder="Enter Email" required>
                         <?php
                            if(isset($_SESSION['forgeterror']) && $_SESSION['forgeterror'] !=''){
                            echo '<span class="alert">'.$_SESSION['forgeterror'].'</span>';
                            unset($_SESSION['forgeterror']);
                            }
                            ?>
                     </div>
                      <button type="submit" class="btn btn-primary w-100 rounded-pill mt-2 SendOtpBtn" name="SendOtpBtn">Send Otp</button>
                   </form>
                   <hr class="mx-2">
                   <a href="login" class="text-center text-uppercase text-decoration-none text-black">Back to Page</a>
             </div>
        </div>
  </div>

</body>
</html>