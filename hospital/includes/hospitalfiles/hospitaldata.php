<?php

$hospitalemail =$_SESSION['email'];

$queryhospitaldatafetch =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalemail='$hospitalemail'");
if(mysqli_num_rows($queryhospitaldatafetch)){
      while($hospitalrow=mysqli_fetch_assoc($queryhospitaldatafetch)){
        $hospitalid= $hospitalrow['hospitalid'];
         $username = $hospitalrow['hospitalname'];
         $useremail = $hospitalrow['hospitalemail'];
         $usernumber = $hospitalrow['hospitalnumber'];
         $useraddress = $hospitalrow['hospitaladdress'];
         $userprofile = $hospitalrow['hospitalprofile'];
      }
}else{
    header("location:../../index");
}
?>