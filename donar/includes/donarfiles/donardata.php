<?php

$donaremail =$_SESSION['email'];

$querydonardatafetch =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$donaremail'");
if(mysqli_num_rows($querydonardatafetch)){
      while($donarrow=mysqli_fetch_assoc($querydonardatafetch)){
        $donarid= $donarrow['donarid'];
         $username = $donarrow['donarname'];
         $useremail = $donarrow['donaremail'];
         $usergender = $donarrow['donargender'];
         $userdob = $donarrow['donardob'];
         $userbloodgroup = $donarrow['donarbloodgroup'];
         $usernumber = $donarrow['donarnumber'];
         $useraddress = $donarrow['donaraddress'];
         $useroccupation = $donarrow['donaroccuption'];
         $userprofile = $donarrow['donarprofile'];
         $completedate = $donarrow['lastdate'];
      }
}else{
    header("location:../../index");
}
?>