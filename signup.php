<?php
session_start();
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
    <title>Blood Buddy | Sign Up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        .signUp{
            padding: 30px 9%;
        }
        .signUp .card .form-control,
        .btn{
            margin-top: 15px;
            height: 45px;
            font-size: 18px;
            text-transform: uppercase;
        }
        .hospitalSection{
            display: none;
        }

        .bloodbankSection{
            display: none;
        }
        .donarSection{
            display: none;
        }
        @media screen and (max-width:590px){
            .logintxt{
                font-size:15px;
            }
        }
    </style>
</head>
<body>
<section class="signUp">
     <div class="card shadow-lg p-3 h-100 <?php echo $class1; ?>">
         <h1 class="text-uppercase">Register Now </h1>
               <?php
                if(isset($_SESSION['signup_error']) && $_SESSION['signup_error'] !=''){
                echo '<div class="alert alert-success alert-dismissible fade show text-uppercase text-danger" role="alert">
                '.$_SESSION['signup_error'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                unset($_SESSION['signup_error']);
                }
                ?>
               
            <div class="my-0">
                <select name="usertype" id="UserType" class="form-control UserType">
                    <option value="">Select your type:</option>
                    <option value="donar">Donar</option>
                    <option value="hospital">hospital</option>
                    <option value="bloodbank">Blood Bank</option>
                </select>
            </div>
            <div class="donarSection donar">
                <form action="donar/includes/donarfiles/signup" method="post">
                    <div class="row">
                        <div class="col-md-6">
                        <input type="text" name="donarname" id="" class="form-control" placeholder="Full Name" >
                        </div>
                        <div class="col-md-6">
                        <input type="email" name="donaremail" id="" class="form-control" placeholder="Email Adddress" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        <select name="donargender" id="" class="form-control" >
                            <option value="">select Your gender:</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="transgender">transgender</option>
                        </select>
                        </div>
                        <div class="col-md-4">
                        <input type="date" name="donardob" id="" class="form-control" >
                        </div>
                        <div class="col-md-4">
                                <select name="donarbloodgroup" id="" class="form-control" >
                                    <option value="">select Your Blood group:</option>
                                    <option value="AP">A+</option>
                                    <option value="BP">B+</option>
                                    <option value="ABP">AB+</option>
                                    <option value="OP">O+</option>
                                    <option value="OM">O-</option>
                                    <option value="ABM">AB-</option>
                                    <option value="BM">B-</option>
                                    <option value="AM">A-</option>    
                                </select>
                        </div>
                    </div>
                    <div class="">
                        <input type="number" name="donarnumber" id="" class="form-control" placeholder="Mobile Number" >
                    </div>
                    <div class="">
                        <input type="text" name="donaraddress" id="" class="form-control" placeholder="Adddress" >
                    </div>
                    <div class="">
                        <input type="text" name="donaroccupation" id="" class="form-control" placeholder="Occupation" >
                    </div>
                    <div class="">
                    <input type="password" name="donarpassword" id="" class="form-control" placeholder="Password" >
                    </div>
                    <div class="">
                    <input type="password" name="donarcpassword" id="" class="form-control" placeholder="Confirm Password" >
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <button type="reset" class="btn btn-danger w-100">Reset</button>
                    </div>
                    <div class="col-md-6">
                    <button type="submit" class="btn btn-success w-100" name="bloodbuddyDonarSubmit">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="hospitalSection hospital">
                    <form action="hospital/includes/hospitalfiles/signup" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                            <input type="text" name="hospitalname" id="" class="form-control" placeholder="Hospital Name.." >
                            </div>
                            <div class="col-md-6">
                            <input type="text" name="hospitalLicenseid" id="" class="form-control" placeholder="Hospital License Id.." >
                            </div>
                        </div>
                        <div class="">
                            <input type="email" name="hospitalemail" id="" class="form-control" placeholder="Hospital Email" >
                        </div>
                        <div class="">
                            <input type="number" name="hospitalnumber" id="" class="form-control" placeholder="Hospital mobile Number" >
                        </div>
                        <div class="">
                            <input type="file" name="hospitalfile" id="" class="form-control" >
                        </div>
                        <div class="">
                            <input type="text" name="hospitaldrname" id="" class="form-control" placeholder="Dr. name" >
                        </div>
                        <div class="">
                            <input type="text" name="hospitaladdress" id="" class="form-control" placeholder="Hospital Address" >
                        </div>
                        <div class="">
                            <input type="password" name="hospitalpassword" id="" class="form-control" placeholder="Password" >
                        </div>
                        <div class="">
                            <input type="password" name="hospitalcpassword" id="" class="form-control" placeholder="Confirm Password" >
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <button type="reset" class="btn btn-danger w-100">Reset</button>
                            </div>
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-success w-100" name="bloodbuddyHospitalSubmit">Submit</button>
                            </div>
                            
                        </div>
                    </form>
            </div>
            <div class="bloodbankSection bloodbank">
                    <form action="bloodbank/includes/bloodbankfiles/signup" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                            <input type="text" name="bloodbankname" id="" class="form-control" placeholder="Blood Bank Name.." >
                            </div>
                            <div class="col-md-6">
                            <input type="text" name="bloodbankLicenseid" id="" class="form-control" placeholder="Blood Bank Id.." >
                            </div>
                        </div>
                        <div class="">
                            <input type="text" name="bloodbankemail" id="" class="form-control" placeholder="Blood Bank Email" >
                        </div>
                        <div class="">
                            <input type="number" name="bloodbanknumber" id="" class="form-control" placeholder="Blood Bank mobile Number" >
                        </div>
                        <div class="">
                            <input type="file" name="bloodbankfile" id="" class="form-control" >
                        </div>
                        <div class="">
                            <input type="text" name="bloodbankmanagername" id="" class="form-control" placeholder="Blood Bank manager" >
                        </div>
                        <div class="">
                            <input type="password" name="bloodbankpassword" id="" class="form-control" placeholder="password" >
                        </div>

                        <div class="">
                            <input type="password" name="bloodbankcpassword" id="" class="form-control" placeholder="Confirm Password" >
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <button type="reset" class="btn btn-danger w-100">Reset</button>
                            </div>
                            <div class="col-md-6">
                            <button type="submit" class="btn btn-success w-100" name="bloodbuddyBloodbankSubmit">Submit</button>
                            </div>
                        </div>
                    </form>
            </div>
            <hr>
            <a href="login" class="text-center p-2 text-decoration-none text-black text-uppercase logintxt">if you have alredy create account please login Now</a>
     </div>
</section>
<script>

    $(document).ready(function(){
  $("#UserType").change(function(){
    var name =$("#UserType").val();
     $(".donarSection").hide();
     $(".hospitalSection").hide();
     $(".bloodbankSection").hide();
     $("."+name).show();

  })
});
</script>
</body>
</html>