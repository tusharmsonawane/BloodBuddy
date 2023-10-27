<?php
session_start();
require_once "hospitalfiles/dbconfig.php";
include_once "hospitalfiles/hospitaldata.php";
if(!isset($_SESSION["hospitallogin"]) || $_SESSION["hospitallogin"] !== true){
    header("location:../login");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30">
    <title>Blood Buddy | Hospital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.semanticui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="asset/js/sweetalert.js"></script>
    <link rel="stylesheet" href="asset/css/style.css">
    
</head>
<body>
<div class="">
     <div class="navbar shadow p-3">
        <div class="logo">
            <a href="#" class="navbar-brand text-uppercase">Blood<span><i class="fa-sharp fa-solid fa-handshake"></i></span>Buddy</a>
        </div>
        <div class="bars d-flex align-items-center ">
             <span class="profiletitle text-uppercase">welcome ,<?php echo $username; ?>| </span>
             <a href="profile"> <span class="mx-1"><img src="asset/hospitalprofile/<?php echo $userprofile;?> " alt="" height="35px" width="35px" class="rounded-pill"></span></a>
             <span class="fs-4 mx-2 menutoggle"><i class="fa-solid fa-bars"></i></span>
        </div>
     </div>
    <div class="d-flex">
        <div class="sidebar">
             <ul>
                <li>
                    <a href="index">
                        <span class="icon"><i class="fa-solid fa-home"></i></span>
                        <span class="title">Home</span>
                    </a>
                </li>
                <li>
                    <a href="appointment">
                        <span class="icon"><i class="fa-sharp fa-solid fa-calendar-check"></i></span>
                        <span class="title">Appointment</span>
                    </a>
                </li>
                <li>
               
                    <a href="donarrequest">
                        <span class="icon"><i class="fa-sharp fa-solid fa-handshake-simple"></i></span>
                        <span class="title">Donar</span>
                    </a>
                </li>
                <li>
                    <a href="sendrequest">
                        <span class="icon"><i class="fa-solid fa-building-columns"></i></span>
                        <span class="title">Blood Bank</span>
                    </a>
                </li>

                <li>
                    <a href="?logout" class="logoutBtn">
                        <span class="icon"><i class="fa-solid fa-right-to-bracket"></i></span>
                        <span class="title">Log Out</span>
                    </a>
                </li>
             </ul>
         </div>

         <div class="content overflow-y-scroll">