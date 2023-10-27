<?php
session_start();
require_once "dbconfig.php";
include('../../../asset/smtp/PHPMailerAutoload.php');


if(isset($_POST['bloodbuddyDonarSubmit'])){
 $donarname = $_POST['donarname'];
 $donaremail = $_POST['donaremail'];
 $donargender = $_POST['donargender'];
 $donardob = $_POST['donardob'];
 $donarbloodgroup = $_POST['donarbloodgroup'];
 $donarnumber = $_POST['donarnumber'];
 $donaraddress = $_POST['donaraddress'];
 $donaroccupation = $_POST['donaroccupation'];
 $donarpassword = $_POST['donarpassword'];
 $donarcpassword = $_POST['donarcpassword'];
 $donarid= rand(111111, 999999);
 $currentdate = date('Y-m-d');
 $time=time();
 $otp = rand(111111,999999);
 $date1 =date_create($currentdate);
 $date2 =date_create( $donardob);
 $datediff= date_diff($date1, $date2);
 $donarage=$datediff->format("%y");

 if(empty($donarname)&&empty($donaremail)&&empty($donargender)&&empty($donardob)&&empty($donarbloodgroup)&&empty($donarnumber)&&empty($donaraddress)&&empty($donaroccupation)){
        $_SESSION['signup_error']="please filled all details";
        header("location:../../../signup"); 
 }else{
    if(empty($donarname)){
        $_SESSION['signup_error']="please enter your name";
        header("location:../../../signup"); 
    }else{
        if(empty($donaremail)){
            $_SESSION['signup_error']="please enter your email";
            header("location:../../../signup"); 
        }else{
            if(empty($donargender)){
                $_SESSION['signup_error']="please enter your gender";
                header("location:../../../signup"); 
            }else{
                if(empty($donardob)){
                    $_SESSION['signup_error']="please select birthdate";
                    header("location:../../../signup"); 
                }else{
                    if(empty($donarbloodgroup)){
                        $_SESSION['signup_error']="please select your blood group";
                        header("location:../../../signup"); 
                    }else{
                        if(empty($donarnumber)){
                            $_SESSION['signup_error']="please enter your mobile number";
                            header("location:../../../signup"); 
                        }else{
                            if(empty($donaraddress)){
                                $_SESSION['signup_error']="please enter your address";
                                header("location:../../../signup"); 
                            }else{
                                if(empty($donaroccupation)){
                                    $_SESSION['signup_error']="please enter your occupation";
                                    header("location:../../../signup"); 
                                }else{
                                    if(empty($donarpassword)){
                                        $_SESSION['signup_error']="please enter your password";
                                        header("location:../../../signup"); 
                                    }else{
                                        $donaremailVerify = mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$donaremail'");
                                        if(mysqli_num_rows($donaremailVerify)){
                                              $donaremailverify2=mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$donaremail'");
                                              if(mysqli_num_rows($donaremailverify2)){
                                               $_SESSION['signup_error']="this email is already exist please enter new email";
                                               header("location:../../../signup");
                                              }else{
                                                  $queryotpupdate=mysqli_query($dlink,"UPDATE donarregister SET donarotp='$otp' WHERE donaremail='$donaremail'");
                                                  //  mail sending
                                                  $msg='<div style="padding:5px 10px;display:flex;justify-content:center;align-items:center;min-height:100vh">
                                                  <div style="padding:5px;height:100%;width:450px">
                                                     <div style="border:1px solid #000;">
                                                         <h1 style="text-align:center;text-transform:uppercase;background:#222730;color:#fff">Bloodbuddy</h1>
                                                     </div>
                                                     <div  style="padding:10px;border:1px solid #000;">
                                                       <h2 style="padding:5px 5px;font-weight:800;">Verify Your Email Address:</h2>
                                                        <p style="padding:5px 0px 7px 5px">Thanks For Register For Donar in BloodBuddy.we want to make sure its really you.please enter the following Verification code when promoted.</p>
                                                         <h4 style="text-align:center;padding:7px 0px 0px 0px;font-size:22px;font-weight:500">Verification Code :</h4>
                                                        <h1 style="text-align:center;padding:5px 0px">'.$otp.'</h1>
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
                                                  $mail->AddAddress($donaremail);
                                                  $mail->Subject = "SignUp | Otp Verification";
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
                                                    $_SESSION['useremail']= $donaremail;
                                                    header("location:../../../otpverification");
                                                  }
                                              }
                                        }else{
                                           $donaremailverify2=mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalemail='$donaremail'");
                                           if(mysqli_num_rows($donaremailverify2)){
                                               header("location:../../../signup");
                                                    $_SESSION['signup_error']="this email is already exist please enter new email";
                                           }else{
                                               $donaremailverify3=mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankemail='$donaremail'");
                                               if(mysqli_num_rows($donaremailverify3)){
                                                   header("location:../../../signup");
                                                   $_SESSION['signup_error']="this email is already exist please enter new email";
                                               }else{
                                                   if(strlen($donarnumber)>=10){
                                                       if($donarage >18){
                                                                       if(strlen($donarpassword) > 3){
                                                                               if($donarpassword == $donarcpassword){
                                                                                   $passwordHash=password_hash($donarpassword, PASSWORD_DEFAULT);
                                                                                   $donarquery =mysqli_query($dlink,"INSERT INTO donarregister(donarid,donarname,donaremail,donargender,donardob,donarbloodgroup,donarnumber,donaraddress,donaroccuption,donarpassword,donarotp) VALUES('$donarid','$donarname',LOWER('$donaremail'),'$donargender','$donardob','$donarbloodgroup','$donarnumber','$donaraddress','$donaroccupation','$passwordHash','$otp')");
                                                                                   if($donarquery){
                                                                                        $_SESSION['emailverificationpage'] =true;
                                                                                        $_SESSION['useremail']= $donaremail;
                                                                                        header("location:../../../otpverification");
                                                                                        //  mail sending
                                                                                   
                                                                                        $msg='<div style="padding:5px 10px;display:flex;justify-content:center;align-items:center;min-height:100vh">
                                                                                        <div style="padding:5px;height:100%;width:450px">
                                                                                           <div style="border:1px solid #000;">
                                                                                               <h1 style="text-align:center;text-transform:uppercase;padding:10px;background:#222730;color:#fff">Bloodbuddy</h1>
                                                                                           </div>
                                                                                           <div  style="padding:10px;border:1px solid #000;">
                                                                                             <h2 style="padding:10px 5px;font-weight:800;">Verify Your Email Address:</h2>
                                                                                              <p style="padding:5px 0px 10px 5px">Thanks For Register For Donar in BloodBuddy.we want to make sure its really you.please enter the following Verification code when promoted.</p>
                                                                                               <h4 style="text-align:center;padding:10px 0px 0px 0px;font-size:22px;font-weight:500">Verification Code :</h4>
                                                                                              <h1 style="text-align:center;padding:5px 0px">'.$otp.'</h1>
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
                                                                                        $mail->AddAddress($donaremail);
                                                                                        $mail->Subject = "SignUp | Otp Verification";
                                                                                        $mail->Body =$msg;
                                                                                        $mail->SMTPOptions=array('ssl'=>array(
                                                                                            'verify_peer'=>false,
                                                                                            'verify_peer_name'=>false,
                                                                                            'allow_self_signed'=>false
                                                                                        ));
                                                                                        if(!$mail->Send()){
                                                                                            echo $mail->ErrorInfo;
                                                                                        }
                                                                                               
                                                                                   }else{
                                                                                   header("location:../../../signup");
                                                                                   $_SESSION['signup_error']="something went to wrong";                                   
                                                                                }
                                                                               }else{
                                                                               header("location:../../../signup");
                                                                               $_SESSION['signup_error']="password does not match";
                                                                               }
                                                                  }else{
                                                                       header("location:../../../signup");
                                                                       $_SESSION['signup_error']="password should be 8 charactors";
                                                                  }
                                                 
                                                       }else{
                                                         header("location:../../../signup");
                                                         $_SESSION['signup_error']="your age maximum 18 years";
                                                       }
                                                   }else{
                                                     header("location:../../../signup");
                                                     $_SESSION['signup_error']="mobile number should be 10 number"; 
                                             
                                                   }
                                               }
                                           }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

}else{
    header("location:../../../signup.php");
}


?>