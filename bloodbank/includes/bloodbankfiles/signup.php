<?php
session_start();
require_once "dbconfig.php";

if(isset($_POST['bloodbuddyBloodbankSubmit'])){
    $bloodbankname =$_POST['bloodbankname'];
    $bloodbankLicenseid =$_POST['bloodbankLicenseid'];
    $bloodbankemail =$_POST['bloodbankemail'];
    $bloodbanknumber =$_POST['bloodbanknumber'];
    $bloodbankfile =$_FILES['bloodbankfile']['name'];
    $bloodbankmanagername =$_POST['bloodbankmanagername'];
    $bloodbankpassword =$_POST['bloodbankpassword'];
    $bloodbankcpassword =$_POST['bloodbankcpassword'];
    $bloodbankid =rand(111111,999999);

    if(empty($bloodbankname) && empty($bloodbankLicenseid) && empty($bloodbankemail) && empty($bloodbanknumber) &&empty($bloodbankfile) && empty($bloodbankmanagername) && empty($bloodbankpassword) && empty($bloodbankcpassword)){
      $_SESSION['signup_error']="please filled all details";
      header("location:../../../signup");
    }else{
       if(empty($bloodbankLicenseid)){
            $_SESSION['signup_error']="please enter Your Lincense id";
            header("location:../../../signup");
       }else{
        if(empty($bloodbankemail)){
          $_SESSION['signup_error']="please enter Your email";
          header("location:../../../signup");
          }else{
            if(empty($bloodbanknumber)){
              $_SESSION['signup_error']="please enter Your  mobile number";
              header("location:../../../signup");
            }else{
              if(empty($bloodbankfile)){
                $_SESSION['signup_error']="please select license photo";
                header("location:../../../signup");
              }else{
                if(empty($bloodbankpassword)){
                  $_SESSION['signup_error']="please enter Your password";
                  header("location:../../../signup");
                  }else{
                    if(empty($bloodbankcpassword)){
                      $_SESSION['signup_error']="please enter Your confirm password";
                      header("location:../../../signup");
                      }else{
                        $useremailcheck= mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$bloodbankemail'");
                        if(mysqli_num_rows($useremailcheck)){
                            $_SESSION['signup_error']="this email already exist | try new email";
                            header("location:../../../signup");
                        }else{
                        $useremailcheck2= mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalemail='$bloodbankemail'");
                          if(mysqli_num_rows($useremailcheck2)){
                            $_SESSION['signup_error']="this email already exist | try new email";
                            header("location:../../../signup");
                          }else{
                            if($bloodbankpassword == $bloodbankcpassword){
                              if(strlen($bloodbankpassword) >2){
                                  $querybloodbanknamecheck =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankname='$bloodbankname'");
                                  if(mysqli_num_rows($querybloodbanknamecheck)){
                                    header("location:../../../signup");
                                    $_SESSION['signup_error']="this name is already exist";
                                  }else{
                                        $querybloodbankcheck =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankemail='$bloodbankemail'");
                                        if(mysqli_num_rows($querybloodbankcheck)){
                                          header("location:../../../signup");
                                          $_SESSION['signup_error']="this email is already exist | try new email";
                                        }else{
                                              $querybloodbankcheck =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbanklid='$bloodbanklid'");
                                              if(mysqli_num_rows($querybloodbankcheck)){
                                                header("location:../../../signup");
                                                $_SESSION['signup_error']="something went to wrong";
                                              }else{
                                                $querybloodbankcheck =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbanknumber='$bloodbanknumber'");
                                                  if(mysqli_num_rows($querybloodbankcheck)){
                                                    header("location:../../../signup");
                                                    $_SESSION['signup_error']="this mobile number is alredy exist";
                                                  }else{
                                                    $passwordHash=password_hash($bloodbankpassword, PASSWORD_DEFAULT);
                                                    $querybloodbank =mysqli_query($dlink,"INSERT INTO bloodbankregister (bloodbankname,bloodbankid,bloodbankemail,bloodbanknumber,bloodbankfile,bloodbankLid,bloodbankmanager,bloodbankpassword) VALUES('$bloodbankname','$bloodbankid',LOWER('$bloodbankemail'),'$bloodbanknumber','$bloodbankfile','$bloodbankLicenseid','$bloodbankmanagername','$passwordHash')");
                                                    if($querybloodbank){
                                                      header("location:../../../signup");
                                                      move_uploaded_file($_FILES["bloodbankfile"]["tmp_name"], "../../asset/bloodbankfile/".$_FILES["bloodbankfile"]["name"]);
                                                    }else{
                                                      header("location:../../../signup");
                                                      $_SESSION['signup_error']="something wents to wrong";
                                                    }
                                                  }
                                                    
                                              }
                                              
                                        }
                                  }
                              }else{
                                header("location:../../../signup");
                                $_SESSION['signup_error']="password should be 8 charactor";
                              }
                            }else{
                              header("location:../../../signup");
                              $_SESSION['signup_error']="password and confirm password are not match";
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