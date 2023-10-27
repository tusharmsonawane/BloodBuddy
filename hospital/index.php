<?php
include "includes/header.php";
include('../asset/smtp/PHPMailerAutoload.php');
date_default_timezone_set('asia/kolkata');
if(isset($_POST['checkdonar'])){
  $bloodgroup =$_POST['bloodgroup'];
  $donarbox ='';
 if($bloodgroup == "none"){
    $donarbox ="please select blood group";
}else{
     $querycheck =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarbloodgroup ='$bloodgroup'");
     if(mysqli_num_rows($querycheck)){
        while($donarrow =mysqli_fetch_assoc($querycheck)){
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
                                            $donarbloodgroup="";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $donarbox .='<div class=" p-3">
            <div class="card shadow-lg p-2">
            <div class="row">
               <div class="col-md-4">
                  <img src="../donar/asset/donarprofile/'.$donarrow['donarprofile'].'" alt="" class="img-fluid w-100" style="height:220px">
               </div>
               <div class="col-md-8">
                     <div class="d-flex mt-2 justify-content-between">
                     <h2 class="card-title text-uppercase">'.$donarrow['donarname'].'</h2>
                     </div>
                     <small class="mx-1 my-0 text-uppercase">Last donation : '.date("d-M-Y", strtotime($donarrow['lastdate'])).'</small>
                     <hr class="my-0">
                     <div class="mx-1">
                       <p class="my-0">Blood group : '.$donarbloodgroup.'</p>
                       <p class="my-0">Mobile number : '.$donarrow['donarnumber'].'</p>
                       <p class="my-0">Gender : '.$donarrow['donargender'].'</p>
                       <p class="my-0 mb-1">Occupation : '.$donarrow['donaroccuption'].'</p>
                     </div>
                <div class="me-2">
                <a href="?userid='.$donarrow['donarid'].'" class="btn btn-info w-100 text-uppercase">Send Request</a>

                </div>
               </div>
            </div>
      </div>
   </div>';
        }
       
     }else{
        $donarbox ='<span class="p-2">Donor is not available</span>';
     }                
}
}else{
    $donarbox ='';
}
if(isset($_GET['userid'])){
$userid= $_GET['userid'];
$sendtime= date("h:i:sa");
$senddate=date("d-m-Y");
$requestid=rand(11111111,99999999);


$querycheckrequest=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE hospitalid='$hospitalid'");
if(mysqli_num_rows($querycheckrequest)){
        $querycheckstatus=mysqli_query($dlink,"SELECT * FROM hospitalrequest WHERE hospitalid='$hospitalid' AND donarid='$userid' AND status='pendding' OR hospitalid='$hospitalid' AND donarid='$userid' AND status='accept'");
        if(mysqli_num_rows($querycheckstatus)){
        $_SESSION['hospitalerror']='WAIT FOR ACCEPTING THE  PREVIOUS REQUEST';
}else{
    $querysendrequest=mysqli_query($dlink,"INSERT INTO hospitalrequest (requestid,hospitalname,hospitalid,donarid,senddate,sendtime,responsedate,responsetime,completedate,completetime) VALUES('$requestid','$username','$hospitalid','$userid','$senddate','$sendtime','','','','')");
    if($querysendrequest){
        $queryfetchdonardata=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$userid'");
          while($donarrow =mysqli_fetch_assoc($queryfetchdonardata)){
            $donaremail =$donarrow['useremail'];
            $donarname =$donarrow['username'];
          }
            $msg =' <div class="card shadow-lg p-4">
            <div class="logo text-center mt-3">
            <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
            </div>
            <hr class="mx-2">
            <div class="content">
                <p class="fs-5">Dear '.$donarname.'</p>
                <p>'.$username.' can Send you Request For Need Of Blood Please Accept The Request</p>
                <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Login Now</p>
            </div>
            </div>';
           //  mail sending
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
           $mail->Subject = "Hospital Request";
           $mail->Body = $msg;
           $mail->SMTPOptions=array('ssl'=>array(
               'verify_peer'=>false,
               'verify_peer_name'=>false,
               'allow_self_signed'=>false
           ));
           if(!$mail->Send()){
               echo $mail->ErrorInfo;
           }else{
            $_SESSION['hospitalerror']='YOUR REQUEST IS SEND SUCCESSFULY';
           }
    }else{
            $_SESSION['hospitalerror']='SOMETHING WENTS WRONG';
    }
}
}else{
    $querysendrequest=mysqli_query($dlink,"INSERT INTO hospitalrequest (requestid,hospitalname,hospitalid,donarid,senddate,sendtime,responsedate,responsetime,completedate,completetime) VALUES('$requestid','$username','$hospitalid','$userid','$senddate','$sendtime','','','','')");
    if($querysendrequest){
        $queryfetchdonardata=mysqli_query($dlink,"SELECT * FROM userregister WHERE userid='$userid'");
          while($donarrow =mysqli_fetch_assoc($queryfetchdonardata)){
            $donaremail =$donarrow['useremail'];
            $donarname =$donarrow['username'];
          }
          $msg =' <div class="card shadow-lg p-4">
            <div class="logo text-center mt-3">
            <h1 class="fw-bolder text-uppercase">Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</h1>
            </div>
            <hr class="mx-2">
            <div class="content">
                <p class="fs-5">Dear '.$donarname.'</p>
                <p>'.$username.' can Send you Request For Need Of Blood Please Accept The Request</p>
                <p>Please Go <a href="http://localhost/blood%20bank/login">http://localhost/blood%20bank/login</a> | Login Now</p>
            </div>
            </div>';
        //  mail sending
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
        $mail->Subject = "Hospital Request";
        $mail->Body =$msg;
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if(!$mail->Send()){
            echo $mail->ErrorInfo;
        }else{
         $_SESSION['hospitalerror']='YOUR REQUEST IS SEND SUCCESSFULY';
        }
    }else{
    $_SESSION['hospitalerror']='SOMETHING WENTS WRONG';
    }
}

}


?>
<style>
   .card form select{
       height:45px;
       font-size: 18px;
   }
   .btn-success{
    height:45px;
    width:120px;
    font-size:18px;
    margin-top:10px;
    margin-left:5px;
   }
   @media screen and (max-width:580px){
    .container-fluid{
       margin:0!important;
       padding:0!important;
    }
   }
</style>
<div class="container-fluid">
     <div class="card">
         <form  method="post" class="d-flex mx-2 m-2">
              <select name="bloodgroup" id="" class="form-control">
                <option value="none">Search For Donor</option>
                <option value="AP">A+</option>
                <option value="BP">B+</option>
                <option value="ABP">AB+</option>
                <option value="OP">O+</option>
                <option value="AM">A-</option>
                <option value="BM">B-</option>
                <option value="ABM">AB-</option>
                <option value="OM">O-</option>
              </select>
              <button type="submit" class="btn btn-success border" name="checkdonar"><i class="fa fa-search"></i></button>
         </form>
     </div>
     <div class="card mt-2 donarCard">
        <div class="p-2">
        <?php echo $donarbox;?>
        </div>
    </div>

</div>

<?php
if(isset($_SESSION['hospitalerror'])){
    echo '<div class="errorbg h-100 w-100">
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast d-block animate__animated animate__heartBeat">
        <div class="toast-header">
        <img src="asset/hospitalprofile/'.$userprofile.'" class="rounded me-2" alt="..." height="40px" width="40px">
        <strong class="me-auto text-uppercase fw-bolder">'.$username.'</strong>
        <small>'.date("h:i a", strtotime($sendtime)).'</small>
        <a href="index" class="btn-close" aria-label="Close"></a>
        </div>
        <div class="toast-body text-uppercase fw-bolder">
         '.$_SESSION['hospitalerror'].'
        </div>
    </div>
</div>
</div>';
    unset($_SESSION['hospitalerror']);
}
?>
<?php
include "includes/footer.php";
?>