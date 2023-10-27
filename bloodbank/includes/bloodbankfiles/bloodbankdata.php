<?php
$bloodbankemail =$_SESSION['email'];

$querybloodbankdatafetch =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankemail='$bloodbankemail'");
if(mysqli_num_rows($querybloodbankdatafetch)){
      while($bloodbankrow=mysqli_fetch_assoc($querybloodbankdatafetch)){
        $bloodbankid= $bloodbankrow['bloodbankid'];
        $bloodbankLid= $bloodbankrow['bloodbankLid'];
        $username = $bloodbankrow['bloodbankname'];
        $useremail = $bloodbankrow['bloodbankemail'];
        $usernumber = $bloodbankrow['bloodbanknumber'];
        $bloodbankmanager = $bloodbankrow['bloodbankmanager'];
        $userprofile = $bloodbankrow['bloodbankprofile'];
      }
}else{
    header("location:../../index");
}
?>