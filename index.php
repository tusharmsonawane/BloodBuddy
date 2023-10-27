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
  if(isset($_POST['clientForm'])){
      $clientFname=$_POST['clientFname'];
      $clientLname=$_POST['clientLname'];
      $clientEmail=$_POST['clientEmail'];
      $clientNumber=$_POST['clientNumber'];
      $clientMessage=$_POST['clientMessage'];
      $date =date("d-m-Y");
      $time =date("h:i:sa");
      if(empty($clientFname) && empty($clientLname) && empty($clientEmail) && empty($clientNumber) && empty($clientMessage)){
        $_SESSION['textError'] = "Please Enter The All Filled";
      }else{
                  if(empty($clientFname)){
                    $_SESSION['textError'] = "Please Enter The First Name";
              }else{
                if(empty($clientLname)){
                  $_SESSION['textError'] = "Please Enter The Last Name";
                }else{
                  if(empty($clientEmail)){
                    $_SESSION['textError'] = "Please Enter The Email Address";
                  }else{
                    if(empty($clientNumber)){
                      $_SESSION['textError'] = "Please Enter The Mobile Number";
                    }else{
                      if(empty($clientMessage)){
                        $_SESSION['textError'] = "Please Enter The Message";
                      }else{
                        $querycheck =mysqli_query($dlink,"SELECT * FROM userfeedback WHERE email='$clientEmail'");
                        if(mysqli_num_rows($querycheck)){
                          $_SESSION['textError'] ="This Email Alredy Exist";
                        }else{
                          $queryInsertData =mysqli_query($dlink,"INSERT INTO userfeedback(firstname,lastname,email,mobileno,message,date,time) VALUES ('$clientFname','$clientLname','$clientEmail','$clientNumber','$clientMessage','$date','$time')");
                            if($queryInsertData){
                              $_SESSION['textError'] ="Your Message Is Send Successfuly";
                            }else{
                              $_SESSION['textError'] ="something went to wrong";
                            }
                        }
                      }
                    }
                  }
                }
              }
      }
  }

  if(isset($_SESSION['textError'])){
      echo "<script>alert('$_SESSION[textError]');window.location.href='index'</script>";
    unset($_SESSION['textError']);
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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BloodBuddy | Blood Bank Management system</title>



  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="asset/css/style.css" rel="stylesheet" />
  <link href="asset/css/bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
 
</head>
<body>
  
  <div class="MainContent">
    <header class="HeaderSection" id="HeaderSection">
      <div class="container">
        <nav class="navbar navbar-expand-lg CustomNavContainer w-100">
          <a class="navbar-brand text-uppercase" href="index">
            <span>
              Blood<i class="fa-solid fa-handshake"></i>Buddy
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center ">
              <ul class="navbar-nav ">
                <li class="nav-item active">
                  <a class="nav-link active" href="index">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#AboutSection">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#ContactSection">Contact us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?bloodcamp">Blood Camp</a>
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


    <section class="HomeSection position-relative" >
      <div class="container">
              <div class="row">
                <div class="col-md-6">
                <div class="DetailBox">
                          <h1>
                            You Save Life Of Human<br />
                            <span class="MainTitle">Blood Buddy</span>
                          </h1>
                        
                          <?php
                                                          $querycheckcamp=mysqli_query($dlink,"SELECT * FROM userregister WHERE usertype LIKE 'bloodbank'");
                                                          if(mysqli_num_rows($querycheckcamp)){
                                                           while($bloodbankrow=mysqli_fetch_assoc($querycheckcamp)){
                                                               $bloodcampstatus = '<option value="'.$bloodbankrow['userid'].'" class="text-uppercase">'.$bloodbankrow['username'].'</option>';
                                                           }
                                                          }else{
                                                           $bloodcampstatus = '
                                                             <option value="" class="text-uppercase">no blood bank available</option>';
                                                          }
                              if(isset($_GET['bloodcamp'])){

                                    echo '<div class="BloodSearch w-100 mt-3">
                                    <h3 class="text-uppercase">Search Blood Camp</h3>
                                                  <form action="bloodcamp.php" method="post" class="d-flex gap-2 ">
                                                    <select name="bloodbankname" id="" class="text-uppercase w-100">
                                                    <option value="">Choose BloodBank</option>
                                                        '.$bloodcampstatus.'
                                                    </select>
                                                    <button type="submit" class="Btn1" name="bloodcamp">Search</button>
                                                  </form>
                                    </div>';
                              }else{
                                echo ' <p>
                               Blood banks store blood for transfusions. They ensure there is a constant supply of blood available for patients who need it and promote blood donation."Blood donation costs you nothing, but it can mean everything to someone in need." 
                              </p>
                              <div class="BtnBox d-flex">
                              <a href="signup" class="Btn1 shadow">Lets Start</a>
                            </div>';
                              }
                              ?>
                      </div>
    


      </div>
    </section>
  </div>

  <section class="BloodGroupDetails mt-5 p-4 position-relative" id="BloodGroupDetails">
    <div class="container">
      <div class="BloodContainer">
        <h2>
          About BloodGroup
        </h2>
        <p>
          A blood group or blood type is a blood classification, categorized on the basis of the presence and absence of antibodies and genetically derived antigenic particles on the surface of RBCs
        </p>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="BloodBox BloodBox1">
            <div class="BloodImg">
              <h1>A</h1>
            </div>
            <div class="BloodAbout">
              <h6>Blood group : <b>A</b></h6>
              <p>Blood group A individuals have the A antigen on the surface of their RBCs, and blood serum containing IgM antibodies against the B antigen. <a href="#">more</a></p>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="BloodBox BloodBox2">
            <div class="BloodImg">
              <h1>B</h1>
            </div>
            <div class="BloodAbout">
              <h6>Blood group : <b>B</b></h6>
              <p>Blood group B individuals have the B antigen on the surface of their RBCs, and blood serum containing IgM antibodies against the A antigen. <a href="#">more</a></p>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="BloodBox BloodBox3">
            <div class="BloodImg">
              <h1>AB</h1>
            </div>
            <div class="BloodAbout">
              <h6>
                Blood group : <b>AB</b>
              </h6>
              <p>Blood group AB individuals have both A and B antigens on the surface of their RBCs, and their blood plasma does not contain any antibodies against either A or B antigen. <a href="#">more</a></p>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="BloodBox BloodBox4">
            <div class="BloodImg">
              <h1>O</h1>
            </div>
            <div class="BloodAbout">
              <h6>Blood group : <b>O</b></h6>
              <p>Blood group O (or blood group zero in some countries) individuals do not have either A or B antigens on the surface of their RBCs, and their blood serum contains IgM anti-A and anti-B antibodie <a href="#">more</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>









  <section class="AboutSection" id="AboutSection">
    <div class="container-fluid">
      <div class="row p-5">
        <div class="col-md-5">
          <div class="BloodImg animate__animated">
            <img src="asset/img/bg-2.jpg" alt="" height="350px" width="100%">
          </div>
        </div>
        <div class="col-md-7">
          <div class="BloodAbout">
              <h2>About Us</h2>
            <p>
              It is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
              of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
              desktop publishing packages and web
              It is a long established fact that a reader will be distracted by the readable content of a page when
              looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
              of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
              desktop publishing packages and web
              It is a long established fact that a reader will be distracted by the readable content of a page when
            </p>
            <div>
              <a href="#" class="Btn1 shadow">Read More</a>
            </div>

          </div>
        </div>
      </div>
    </div>


  </section>
  <section>
  <div class="d-flex justify-content-center align-items-center">
        <div class="content p-3 ">
              <div class="card position-relative border-0">
                    <div class="" id="image">
                        
                    </div>
                  <div class="bloodbox p-2 text-center mt-3 d-flex justify-content-center">
                    <p class="bloodgroup bloodgroup-4 mx-2 border  text-decoration-none fs-4" onclick="bloodgroup4()" id="O">O</p>
                    <p class="bloodgroup bloodgroup-1 mx-2 border  text-decoration-none fs-4" onclick="bloodgroup1()" id="A">A</p>
                    <p class="bloodgroup bloodgroup-2 mx-2 border  text-decoration-none fs-4" onclick="bloodgroup2()" id="B">B</p>
                    <p class="bloodgroup bloodgroup-3 mx-2 border  text-decoration-none fs-4" onclick="bloodgroup3()" id="AB">AB</p>
                  </div>
              </div>
        </div>
      </div>
  </section>

  <section class="ContactSection p-3" id="ContactSection">
    <div class="container ">
      <div class="HeadingContainer">
        <h2 class="p-5 my-0 h1 fw-bold">
          Contact Us
        </h2>
      </div>
    </div>
    <div class="container">
          <form method="post">
            <div>
              <input type="text" name="clientFname" id="" placeholder="First Name" >
            </div>
            <div>
              <input type="text" name="clientLname" id="" placeholder="Last Name" >
            </div>
            <div>
              <input type="email" name="clientEmail" id="" placeholder="Email Address" />
            </div>
            <div>
              <input type="number" name="clientNumber" id="" placeholder="Mobile Number" />
            </div>
            <div>
              <input type="text" name="clientMessage" id="" placeholder="Message" />
            </div>
            <div class="mt-2 ">
              <button type="submit" class="w-100 shadow-lg" name="clientForm">SEND MESSAGE</button>
            </div>
          </form>
    </div>
  </section>


  <section class="FooterSection">
    <div class="container p-3">
      <div class="row">
        <div class="col-md-3">
          <div class="BloodLogo mt-5">
            <div class="">
              <a href="#" class="text-decoration-none text-white text-uppercase h3 ">blood<i class="fa-solid fa-handshake"></i>buddy</a>
               <div class="d-flex justify-content-evenly me-5">
                   <a href="https://www.instagram.com/accounts/login/" class="text-decoration-none text-white h4"><i class="fa-brands fa-instagram"></i></a>
                   <a href="https://www.linkedin.com/login" class="text-decoration-none text-white h4"><i class="fa-brands fa-linkedin-in"></i></a>
                   <a href="https://www.facebook.com/" class="text-decoration-none text-white h4"><i class="fa-brands fa-facebook"></i></a>
                   <a href="https://twitter.com/i/flow/login" class="text-decoration-none text-white h4"><i class="fa-brands fa-twitter"></i></a>
               </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="FooterDetails">
            <h5>Contact Us</h5>
              <div class="mt-1">
                 <bold><i class="fa-sharp fa-solid fa-phone"></i></bold>
                 <span>99999999999</span>
              </div>
              <div class="mt-1">
                 <bold><i class="fa-sharp fa-solid fa-phone"></i></bold>
                 <span>99999999999</span>
              </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="FooterDetails">
            <h5>About Us</h5>
            <p class="small">
              Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec
              odio. Quisque volutpat mattis eros
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="FooterDetails float-center">
            <h5>BloodBuddy Team</h5>
            <ul class="">
              <li class="small">Deven Wagh</li>
              <li  class="small">Tushar Sonawane</li>
              <li  class="small">Gaurav Patil</li>
              <li  class="small">Shailesh Pahade</li>
            </ul>
          </div>
        </div>
      </div>
      <p class="text-center mt-2">
        &copy; 2023 All Rights Reserved By
        <a href="index.html" class="text-decoration-none text-white fw-bold medium text-uppercase">blood<i class="fa-solid fa-handshake"></i>buddy</a>
      </p>
    </div>
  </section>


    <div class="BottomTotop position-fixed bottom-0 end-0">
         <div class="shadow-lg">
             <a href="#HeaderSection" class="text-decoration-none"><i class="fa-solid fa-arrow-up fs-4 text-white"></i></a>
         </div>
    </div>


   
   <script>
    window.addEventListener("scroll", function () {
    var header =document.querySelector('header');
    var navbar =document.querySelector('.navbar-nav');
    var navitem =document.querySelector('.nav-item');
    var name =document.querySelector('.name');
    var icon =document.querySelector('.fa-solid');
    var BottomTotop =document.querySelector('.BottomTotop');
            BottomTotop.classList.toggle('active',window.scrollY > 0);
            navbar.classList.toggle('active',window.scrollY > 0);
            navitem.classList.toggle('active',window.scrollY > 0);
            name.classList.toggle('active',window.scrollY > 0);
            icon.classList.toggle('active',window.scrollY > 0);
     })
   </script>
     <script>
        
        function bloodgroup1() {
            document.getElementById("image").innerHTML='<img src="asset/img/bloodgroup/ap.png" alt="" class="card-img h-100 w-100 animate__animated animate__jackInTheBox">';
        }
        function bloodgroup2() {
            document.getElementById("image").innerHTML='<img src="asset/img/bloodgroup/bp.png" alt="" class="card-img h-100 w-100 animate__animated animate__jackInTheBox">';
        }
        function bloodgroup3() {
            document.getElementById("image").innerHTML='<img src="asset/img/bloodgroup/abp.png" alt="" class="card-img h-100 w-100 animate__animated animate__jackInTheBox">';
        }
        function bloodgroup4() {
            document.getElementById("image").innerHTML='<img src="asset/img/bloodgroup/op.png" alt="" class="card-img h-100 w-100 animate__animated animate__jackInTheBox">';
        }
        
        document.getElementById("image").innerHTML='<img src="asset/img/bloodgroup/op.png" alt="" class="card-img h-100 w-100 animate__animated animate__jackInTheBox">';
        
    </script>
</body>
</html>