<?php

$adminemail =$_SESSION['adminemail'];

$queryadmindatafetch =mysqli_query($dlink,"SELECT * FROM adminregister WHERE adminemail='$adminemail'");
if(mysqli_num_rows($queryadmindatafetch)){
      while($donarrow=mysqli_fetch_assoc($queryadmindatafetch)){
         $useremail = $donarrow['adminemail'];
         echo $username = $donarrow['adminname'];
      }
}else{
    header("location:../../index");
}
?>