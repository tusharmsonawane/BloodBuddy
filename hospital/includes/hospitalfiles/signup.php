<?php
session_start();
require_once "dbconfig.php";

if(isset($_POST['bloodbuddyHospitalSubmit'])){
    $hospitalname =$_POST['hospitalname'];
    $hospitalLicenseid =$_POST['hospitalLicenseid'];
    $hospitalemail =$_POST['hospitalemail'];
    $hospitalnumber =$_POST['hospitalnumber'];
    $hospitalfile =$_FILES['hospitalfile']['name'];
    $hospitaldrname =$_POST['hospitaldrname'];
    $hospitaladdress =$_POST['hospitaladdress'];
    $hospitalpassword =$_POST['hospitalpassword'];
    $hospitalcpassword =$_POST['hospitalcpassword'];
    $hospitalid =rand(111111,999999);

    if(empty($hospitalname) && empty($hospitalLicenseid) && empty($hospitalemail) && empty($hospitalnumber) &&empty($hospitalfile) && empty($hospitaldrname) && empty($hospitaladdress) && empty($hospitalpassword) && empty($hospitalcpassword)){
           $_SESSION['signup_error']="please filled all details";
           header("location:../../../signup");
    }else{
         if(empty($hospitalname)){
              $_SESSION['signup_error']="please enter you name";
              header("location:../../../signup");
         }else{
          if(empty($hospitalLicenseid)){
            $_SESSION['signup_error']="please enter license id";
            header("location:../../../signup");
              }else{
                if(empty($hospitalemail)){
                  $_SESSION['signup_error']="please enter you email";
                  header("location:../../../signup");
                  }else{
                    if(empty($hospitalnumber)){
                      $_SESSION['signup_error']="please enter you mobile number";
                      header("location:../../../signup");
                      }else{
                        if(empty($hospitalfile)){
                          $_SESSION['signup_error']="please select the lincense photo";
                          header("location:../../../signup");
                          }else{
                            if(empty($hospitaldrname)){
                              $_SESSION['signup_error']="please enter you doctor name";
                              header("location:../../../signup");
                              }else{
                                if(empty($hospitalpassword)){
                                  $_SESSION['signup_error']="please enter you password";
                                  header("location:../../../signup");
                                    }else{
                                      $useremailcheck= mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$hospitalemail'");
                                      if(mysqli_num_rows($useremailcheck)){
                                       $_SESSION['signup_error']="this email already exist | try new email";
                                       header("location:../../../signup");
                                      }else{
                                       $useremailcheck2= mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankemail='$hospitalemail'");
                                       if(mysqli_num_rows($useremailcheck2)){
                                         $_SESSION['signup_error']="this email already exist | try new email";
                                         header("location:../../../signup");
                                       }else{
                                         if(strlen($hospitalnumber) <11){
                                           if($hospitalpassword == $hospitalcpassword){
                                             if(strlen($hospitalpassword) >2){

                                                   $queryhospitalnamecheck =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalname='$hospitalname'");
                                                   if(mysqli_num_rows($queryhospitalnamecheck)){
                                                     $_SESSION['signup_error']="This Hospital name alredy exist";
                                                     header("location:../../../signup");
                                                   }else{
                                                     $queryhospitallidcheck =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalLid='$hospitalLicenseid'");
                                                       if(mysqli_num_rows($queryhospitallidcheck)){
                                                         $_SESSION['signup_error']="something wents to wrong";
                                                         header("location:../../../signup");
                                                       }else{
                                                           $queryhospitalemailcheck =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalemail='$hospitalemail'");
                                                           if(mysqli_num_rows($queryhospitalemailcheck)){
                                                             $_SESSION['signup_error']="this email already exist | try new email";
                                                             header("location:../../../signup");
                                                           }else{
                                                             $passwordHash=password_hash($hospitalpassword, PASSWORD_DEFAULT);
                                                             $queryhospital =mysqli_query($dlink,"INSERT INTO hospitalregister (hospitalname,hospitalid,hospitalemail,hospitalnumber,hospitalfile,hospitalLid,hospitaldrname,hospitaladdress,hospitalpassword) VALUES('$hospitalname','$hospitalid',LOWER('$hospitalemail'),'$hospitalnumber','$hospitalfile','$hospitalLicenseid','$hospitaldrname','$hospitaladdress','$passwordHash')");
                                                             if($queryhospital){
                                                               move_uploaded_file($_FILES["hospitalfile"]["tmp_name"], "../../asset/hospitalfile/".$_FILES["hospitalfile"]["name"]);
                                                               header("location:../../../signup");
                                                             }else{
                                                               $_SESSION['signup_error']="something wents to wrong";
                                                               header("location:../../../signup");
                                                             }
                                                           }
                                                         }
                                                       }
                                                       
                                             }else{
                                               $_SESSION['signup_error']="password should be 8 charactors";
                                               header("location:../../../signup");
                                             }
                                           }else{
                                             $_SESSION['signup_error']="password and confirm password are not match";
                                             header("location:../../../signup");
                                           }
                                         }else{
                                           $_SESSION['signup_error']="Hospital Number should be 10 number";
                                           header("location:../../../signup");
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
    header("location:../../../signup");
}

?>