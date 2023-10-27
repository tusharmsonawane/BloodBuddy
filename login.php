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

  

if(isset($_POST['userlogin'])){
     $username =$_POST['username'];
     $password =$_POST['password'];
     $currentdate = date("d-M-Y");
     $currenttime = date("h:i:s a");


     if(empty($username)&&empty($password)){
         $_SESSION['login_error'] ="Please filled the all input";
     }else{
         if(empty($username)){
            $_SESSION['username_error'] ="Please filled the username";
         }else{
            if(empty($password)){
                $_SESSION['password_error'] ="Please filled the password";
            }else{
                if(strlen($password)>2){
                    $donarlogin =mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$username' AND usertype='donar'");
                    if(mysqli_num_rows($donarlogin)){
                                while($loginrow=mysqli_fetch_assoc($donarlogin)){
                                    if(password_verify($password, $loginrow['userpassword'])){
                                        header("location:donar/index");
                                        $_SESSION['email'] = $username;
                                        $_SESSION['donarlogin'] = true;
                                        $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time,status) VALUES ('$username','donar','Null','$currentdate','$currenttime','success')");
                                    }else{
                                        $_SESSION['login_error'] ="username and password are invalid";
                                        $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time,status) VALUES ('$username','donar','$password','$currentdate','$currenttime','Failed')");
                                    }
                                }
                    }else{
                        $hospitallogin =mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$username' AND usertype='hospital'");
                        if(mysqli_num_rows($hospitallogin)){
                          while($loginrow=mysqli_fetch_assoc($hospitallogin)){
                            if(password_verify($password, $loginrow['userpassword'])){
                                header("location:hospital/index");
                                $_SESSION['email'] = $username;
                                $_SESSION['hospitallogin'] = true;
                                $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time,status) VALUES ('$username','hospital','Null','$currentdate','$currenttime','success')");
                            }else{
                                $_SESSION['login_error'] ="username and password are invalid";
                                $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time) VALUES ('$username','hospital','$password','$currentdate','$currenttime','failed')");
                            }
                          }
                        }else{
                            $bloodbanklogin =mysqli_query($dlink,"SELECT * FROM userregister WHERE useremail='$username' AND usertype='bloodbank'");
                            if(mysqli_num_rows($bloodbanklogin)){
                                while($loginrow=mysqli_fetch_assoc($bloodbanklogin)){
                                    if(password_verify($password, $loginrow['userpassword'])){
                                        header("location:bloodbank/index");
                                        $_SESSION['email'] = $username;
                                        $_SESSION['bloodbanklogin'] = true;
                                        $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time,status) VALUES ('$username','bloodbank','Null','$currentdate','$currenttime','success')");
                                    }else{
                                        $_SESSION['login_error'] ="username and password are invalid";
                                        $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time,status) VALUES ('$username','hospital','$password','$currentdate','$currenttime','failed')");
                                    }
                                }
                            }else{
                                $_SESSION['login_error'] ="username and password are invalid";
                                $querydonar=mysqli_query($dlink,"INSERT INTO userlogin (useremail,usertype,userpassword,date,time,status) VALUES ('$username','new user','$password','$currentdate','$currenttime','failed')");
                            }
                        }
                    }
               }else{
                $_SESSION['login_error'] ="password should be 8 characters";
               }
            }
         }
     }
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
            height:50px; 
            padding:0 20px;
            font-size:20px;
            margin-top: 10px;
        }
        .passwordEye{
            position: absolute;
            top:  25%;
            right: 18px;
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
           .lowertext{
            font-size:15px;
           }
        }
        @media screen and (max-width:420px){

            .lowertext{
            font-size:12px;
           }
        }
        @media screen and (max-width:370px){
            .container-fluid .card h1{
                 font-size:40px;
               
            }
            .lowertext{
            font-size:10px;
           }
        }
    </style>
</head>
<body>
  <div class="container-fluid">
      <div class="d-flex justify-content-center align-items-center" style="min-height:100vh">
           <div class="card shadow-lg p-5">
                <h1 class="text-center text-uppercase">Sign In</h1>
                <p class="text-center my-0">Welcome to <b>Blood<i class="fa-sharp fa-solid fa-handshake"></i>Buddy</b> Blood bank  | Login Now</p>
                <div class="">
                <?php
                if(isset($_SESSION['login_error']) && $_SESSION['login_error'] !=''){
                echo '<div class="alert alert-success alert-dismissible fade show text-capitalize text-danger mt-2" role="alert">
                '.$_SESSION['login_error'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['login_error']);
                }
                ?>
                </div>
                <hr class="mx-2">
                <form  method="post">
                    <div class="form-items">
                        <input type="email" name="username" id="" class="form-control rounded-pill" placeholder="Enter Username">
                    <?php
                    if(isset($_SESSION['username_error']) && $_SESSION['username_error'] !=''){
                    echo '<span class="alert text-danger">'.$_SESSION['username_error'].'</span>';
                    unset($_SESSION['username_error']);
                    }
                    ?>
                        
                       
                    </div>
                    <div class="form-items position-relative passwordinput">
                        <input type="password" name="password" id="" class="form-control rounded-pill" placeholder="Enter Password">
                        <span class="passwordEye"><i class="fa-solid fa-eye"></i></span>
                    <?php
                    if(isset($_SESSION['password_error']) && $_SESSION['password_error'] !=''){
                    echo '<span class="alert text-danger">'.$_SESSION['password_error'].'</span>';
                    unset($_SESSION['password_error']);
                    }
                    ?>
                    </div>
                    <div class="form-items">
                        <button type="submit" class="btn btn-success w-100 rounded-pill" name="userlogin">Login</button>
                    </div>
                </form>
                <hr class="mx-2">
                <a href="signup" class="text-center text-decoration-none text-uppercase text-black lowertext small">If you have not create account | <span class="text-primary">sign up</span></a>
                <a href="forgetpassword" class="text-center text-decoration-none text-uppercase text-black lowertext small">Forget Password</a>
           </div>
      </div>
  </div>

  <script>
    const passtext = document.querySelector("form .passwordinput input[type='password']");
      passwordeyebtn =document.querySelector("form .passwordEye i");

      passwordeyebtn.onclick = () =>{
     if(passtext.type=='password'){
         passtext.type='text';
         passwordeyebtn.classList.add("active");
     }else{
         passtext.type='password';
         passwordeyebtn.classList.remove("active");
     }
   }
  </script>
</body>
</html>