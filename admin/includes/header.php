<?php
session_start();
require_once "adminfiles/dbconfig.php";
if(!isset($_SESSION["adminlogin"]) || $_SESSION["adminlogin"] !== true){
    header("location:login");
    exit;
  }
  date_default_timezone_set('asia/kolkata');
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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BloodBuddy - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="asset/css/admin.min.css" rel="stylesheet">
    <link href="asset/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="asset/js/sweetalert.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
    body{
        font-family: 'Merriweather', serif;
        font-weight:400;
    }

    @media screen and (max-width:500px){
        body{
            font-size:14px;
        }
        .sidebar{
             width:0px;
             transition: all .4s ease-in-out;
             overflow:hidden;
           
        }
        .sidebar.active{
            width:8rem;
            display:block;
            overflow:visible;
        }

        .searchbar{
        display:none;
        }
    }
    
    @media screen and (max-width:570px){
        .searchbar{
        display:none;
    }
    }
</style>

</head>

<body>
<div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                <div class="sidebar-brand-icon">
                <i class="fa-sharp fa-solid fa-handshake"></i>
                </div>
                <div class="sidebar-brand-text mx-1">Blood Buddy</div>
            </a>
            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link fs-2" href="index">
                    <i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#AboutDonar">
                    <i class="fa fa-user"></i>
                    <span>Donor</span>
                </a>
                <div id="AboutDonar" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">About Donor:</h6>
                        <a class="collapse-item" href="donar?registration">Registration</a>
                        <a class="collapse-item" href="donar?appointment">Appointment</a>
                        <a class="collapse-item" href="donar?request">Hospital Request</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#AboutHospital">
                    <i class="fa fa-hospital"></i>
                    <span>Hospital</span>
                </a>
                <div id="AboutHospital" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">About Hospital:</h6>
                        <a class="collapse-item" href="hospital?registration">Registration</a>
                        <a class="collapse-item" href="hospital?appointment">Appointment</a>
                        <a class="collapse-item" href="hospital?request">Donor Request</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#AboutBloodbank">
                <i class="fa-solid fa-building-columns"></i>
                    <span>Blood Bank</span>
                </a>
                <div id="AboutBloodbank" class="collapse">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">About Blood bank:</h6>
                        <a class="collapse-item" href="bloodbank?registration">Registration</a>
                        <a class="collapse-item" href="bloodbank?bloodstock">Blood Stock</a>
                        <a class="collapse-item" href="bloodbank?bloodcamp">Blood Camp</a>
                        <a class="collapse-item" href="bloodbank?dappointment">Donor Appointment</a>
                        <a class="collapse-item" href="bloodbank?bappointment">Blood Bank Request</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="adminregister">
                    <i class="fa fa-plus"></i>
                    <span>Admin Registration</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="userfeedback">
                    <i class="fa fa-users"></i>
                    <span>User Feedback</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="userlogin">
                    <i class="fa fa-users"></i>
                    <span>User Login</span></a>
            </li>
        </ul>

