<?php
session_start();
require_once "dbconfig.php";
if(isset($_POST['updatedonar'])){
    $donarid =$_GET['deditid'];
    $donarname =$_POST['dname'];
    $donardob =$_POST['ddob'];
    $donarnumber =$_POST['dnumber'];
    $donaraddress =$_POST['daddress'];
    $donarpassword =$_POST['dpassword'];
    if(empty($donarname) && empty($donardob) && empty($donarnumber) && empty($donaraddress) && empty($donarpassword)){
        header("location:../../donar?eid=$donarid");
        $_SESSION['updateerror'] ="please enter the values";
    }else{
        if(empty($donarname)){
            header("location:../../donar?eid=$donarid");
            $_SESSION['updateerror'] ="please enter the donar name";
        }else{
                if(empty($donardob)){
                    header("location:../../donar?eid=$donarid");
                    $_SESSION['updateerror'] ="please enter the donar birthdate";
            }else{
                if(empty($donarnumber)){
                    header("location:../../donar?eid=$donarid");
                    $_SESSION['updateerror'] ="please enter the donar Mobile Number";
                }else{
                        if(empty($donaraddress)){
                            header("location:../../donar?eid=$donarid");
                            $_SESSION['updateerror'] ="please enter the donar name";
                            }else{
                                    if(empty($donarpassword)){
                                        $querycheck =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$donarid'");
                                        if(mysqli_num_rows($querycheck)){
                                            $queryupdate1 =mysqli_query($dlink,"UPDATE donarregister SET donarname='$donarname',donardob='$donardob',donarnumber='$donarnumber',donaraddress='$donaraddress' WHERE donarid='$donarid'");
                                            if($queryupdate1){
                                                $queryupdate2 =mysqli_query($dlink,"UPDATE userregister SET username='$donarname',usernumber='$donaraddress' WHERE userid='$donarid'");
                                                if($queryupdate2){
                                                    header("location:../../donar?registration");
                                                    $_SESSION['updatesuccess']="donar data is Updated successfuly";
                                                }
                                            }
                                        }
                                    }else{
                                        $querycheck =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarid='$donarid'");
                                                if(mysqli_num_rows($querycheck)){
                                                    $passwordHash=password_hash($donarpassword, PASSWORD_DEFAULT);
                                                    $queryupdate1 =mysqli_query($dlink,"UPDATE donarregister SET donarname='$donarname',donardob='$donardob',donarnumber='$donarnumber',donaraddress='$donaraddress',donarpassword='$passwordHash' WHERE donarid='$donarid'");
                                                    if($queryupdate1){
                                                    $queryupdate2 =mysqli_query($dlink,"UPDATE userregister SET username='$donarname',usernumber='$donaraddress',userpassword='$passwordHash' WHERE userid='$donarid'");
                                                    if($queryupdate2){
                                                        header("location:../../donar?registration");
                                                        $_SESSION['updatesuccess']="donar data is Updated successfuly";
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
    if(isset($_POST['updatehospital'])){
        $hospitalid =$_GET['heditid'];
        $hospitalname =$_POST['hname'];
        $hospitalnumber =$_POST['hnumber'];
        $hospitaladdress =$_POST['haddress'];
        $hospitaldrname =$_POST['hdname'];
        $hospitalpassword =$_POST['hpassword'];
        if(empty($hospitalname) && empty($hospitalnumber) && empty($hospitaladdress) && empty($hospitaldrname) && empty($hospitalpassword)){
            header("location:../../hospital?editid=$hospitalid");
            $_SESSION['updateerror'] ="please enter the values";
        }else{
            if(empty($hospitalname)){
                header("location:../../hospital?editid=$hospitalid");
                $_SESSION['updateerror'] ="please enter the hospital name";
            }else{
                    if(empty($hospitalnumber)){
                        header("location:../../hospital?editid=$hospitalid");
                        $_SESSION['updateerror'] ="please enter the hospital number";
                }else{
                    if(empty($hospitaladdress)){
                        header("location:../../hospital?editid=$hospitalid");
                        $_SESSION['updateerror'] ="please enter the hospital Address";
                    }else{
                            if(empty($hospitaldrname)){
                                header("location:../../hospital?editid=$hospitalid");
                                $_SESSION['updateerror'] ="please enter the hospital Doctor Name";
                                }else{
                                        if(empty($hospitalpassword)){
                                            $querycheck =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$hospitalid'");
                                            if(mysqli_num_rows($querycheck)){
                                                $queryupdate1 =mysqli_query($dlink,"UPDATE hospitalregister SET hospitalname='$hospitalname',hospitalnumber='$hospitalnumber',hospitaldrname='$hospitaldrname',hospitaladdress='$hospitaladdress' WHERE hospitalid='$hospitalid'");
                                                if($queryupdate1){
                                                    $queryupdate2 =mysqli_query($dlink,"UPDATE userregister SET username='$hospitalname',usernumber='$hospitalnumber' WHERE userid='$hospitalid'");
                                                    if($queryupdate2){
                                                        header("location:../../hospital?registration");
                                                        $_SESSION['updatesuccess']="hospital data is Updated successfuly";
                                                    }
                                                }
                                            }
                                        }else{
                                            $querycheck =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalid='$hospitalid'");
                                                    if(mysqli_num_rows($querycheck)){
                                                        $passwordHash=password_hash($hospitalpassword, PASSWORD_DEFAULT);
                                                        $queryupdate1 =mysqli_query($dlink,"UPDATE hospitalregister SET hospitalname='$hospitalname',hospitalnumber='$hospitalnumber',hospitaldrname='$hospitaldrname',hospitaladdress='$hospitaladdress',hospitalpassword='$passwordHash' WHERE hospitalid='$hospitalid'");
                                                        if($queryupdate1){
                                                        $queryupdate2 =mysqli_query($dlink,"UPDATE userregister SET username='$hospitalname',usernumber='$hospitalnumber',userpassword='$passwordHash' WHERE userid='$hospitalid'");
                                                        if($queryupdate2){
                                                            header("location:../../hospital?registration");
                                                            $_SESSION['updatesuccess']="hospital data is Updated successfuly";
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
        if(isset($_POST['updatebloodbank'])){
            $bloodbankid =$_GET['beditid'];
            $bloodbankname =$_POST['bname'];
            $bloodbanknumber =$_POST['bnumber'];
            $bloodbankmanager =$_POST['bmname'];
            $bloodbankpassword =$_POST['bpassword'];
            if(empty($bloodbankname) && empty($bloodbanknumber) && empty($bloodbankmanager) && empty($bloodbankpassword)){
                header("location:../../bloodbank?editid=$bloodbankid");
                $_SESSION['updateerror'] ="please enter the values";
            }else{
                if(empty($bloodbankname)){
                    header("location:../../bloodbank?editid=$bloodbankid");
                    $_SESSION['updateerror'] ="please enter the bloodbank name";
                }else{
                        if(empty($bloodbanknumber)){
                            header("location:../../bloodbank?editid=$bloodbankid");
                            $_SESSION['updateerror'] ="please enter the bloodbank number";
                    }else{
                                if(empty($bloodbankmanager)){
                                    header("location:../../bloodbank?editid=$bloodbankid");
                                    $_SESSION['updateerror'] ="please enter the bloodbank manager Name";
                                    }else{
                                            if(empty($bloodbankpassword)){
                                                $querycheck =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankid='$bloodbankid'");
                                                if(mysqli_num_rows($querycheck)){
                                                    $queryupdate1 =mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankname='$bloodbankname',bloodbanknumber='$bloodbanknumber',bloodbankmanager='$bloodbankmanager' WHERE bloodbankid='$bloodbankid'");
                                                    if($queryupdate1){
                                                        $queryupdate2 =mysqli_query($dlink,"UPDATE userregister SET username='$bloodbankname',usernumber='$bloodbanknumber' WHERE userid='$bloodbankid'");
                                                        if($queryupdate2){
                                                            header("location:../../bloodbank?registration");
                                                            $_SESSION['updatesuccess']="bloodbank data is Updated successfuly";
                                                        }
                                                    }
                                                }
                                            }else{
                                                $querycheck =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankid='$bloodbankid'");
                                                        if(mysqli_num_rows($querycheck)){
                                                            $passwordHash=password_hash($bloodbankpassword, PASSWORD_DEFAULT);
                                                            $queryupdate1 =mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankname='$bloodbankname',bloodbanknumber='$bloodbanknumber',bloodbankmanager='$bloodbankmanager',bloodbankpassword='$passwordHash' WHERE bloodbankid='$bloodbankid'");
                                                            if($queryupdate1){
                                                            $queryupdate2 =mysqli_query($dlink,"UPDATE userregister SET username='$bloodbankname',usernumber='$bloodbanknumber',userpassword='$passwordHash' WHERE userid='$bloodbankid'");
                                                            if($queryupdate2){
                                                                header("location:../../bloodbank?registration");
                                                                $_SESSION['updatesuccess']="bloodbank data is Updated successfuly";
                                                            }
                                                            }
                                                        }
                                            }
                            }
        
                    }
                }
            }
        }else{
            echo "<script>window.location.href='../../index'</script>";
        }
    }
}





?>