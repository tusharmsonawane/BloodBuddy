<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');
if(isset($_POST['updatestock'])){
     $bloodgroup =$_POST['bloodgroup'];
     $bloodquntity =$_POST['bloodquntity'];
    if($bloodgroup == 'none'){
        $_SESSION['updatestockerror'] ="PLEASE SELECT BLOOD GROUP";
    }else{
        if(empty($bloodquntity)){
            $_SESSION['updatestockerror'] ="PLEASE FILLED THE DATA";
            }else{
                $querybankcheck =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                if(mysqli_num_rows($querybankcheck)){
                      $queryfetchbloodbag =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE $bloodgroup OR $bloodgroup='0'");
                      if(mysqli_num_rows($queryfetchbloodbag)){
                        while($bloodbankrow=mysqli_fetch_assoc($queryfetchbloodbag)){
                            $bloodbag=$bloodbankrow[$bloodgroup];
                        }
                        $querystockregister=mysqli_query($dlink,"UPDATE bloodstock SET ".$bloodgroup."=($bloodbag + $bloodquntity) WHERE bloodbankid='$bloodbankid'");
                        if($querystockregister){
                          $_SESSION['updatestocksuccess'] ="You succesfuly updated blood bag";
                        }else{
                          $_SESSION['updatestockerror'] ="SOMETHING WENT WRONG";
                        }
                      }else{
                        $_SESSION['updatestockerror'] ="BLOOD GROUP NOT EXIST";
                      }                   
                }else{
                    $_SESSION['updatestockerror'] ="SOMETHING WENT WRONG";
                }
            }
    }
}


if(isset($_POST['insertstock'])){
    $bloodquntity1 =$_POST['bloodquntity_A+'];
    $bloodquntity2 =$_POST['bloodquntity_B+'];
    $bloodquntity3 =$_POST['bloodquntity_AB+'];
    $bloodquntity4 =$_POST['bloodquntity_O+'];
    $bloodquntity5 =$_POST['bloodquntity_O-'];
    $bloodquntity6 =$_POST['bloodquntity_AB-'];
    $bloodquntity7 =$_POST['bloodquntity_B-'];
    $bloodquntity8 =$_POST['bloodquntity_A-'];

        if(empty($bloodquntity1) && empty($bloodquntity2) && empty($bloodquntity3) && empty($bloodquntity4) && empty($bloodquntity5) && empty($bloodquntity6) &&empty($bloodquntity7) && empty($bloodquntity8)){
                $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK";
            }else{
                if(empty($bloodquntity1)){
                    $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF A+";
                }else{
                    if(empty($bloodquntity2)){
                        $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF B+";
                    }else{
                        if(empty($bloodquntity3)){
                            $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF AB+";
                        }else{
                            if(empty($bloodquntity4)){
                                $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF O+";
                            }else{
                                if(empty($bloodquntity5)){
                                    $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF A-";
                                }else{
                                    if(empty($bloodquntity6)){
                                        $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF B-";
                                    }else{
                                        if(empty($bloodquntity7)){
                                            $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF AB-";
                                        }else{
                                            if(empty($bloodquntity8)){
                                                $_SESSION['updatestockerror']="PLEASE FILLED THE STOCK OF O-";
                                            }else{
                                                $querybankcheck =mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankid='$bloodbankid'");
                                                if(mysqli_num_rows($querybankcheck)){
                                                    $_SESSION['updatestockerror']="SOMETHING WENT WRONG";
                                                }else{
                                                    $querystockregister=mysqli_query($dlink,"INSERT INTO bloodstock(bloodbankname,bloodbankemail,bloodbankid,AP,BP,ABP,OP,OM,ABM,BM,AM) VALUES('$username','$useremail','$bloodbankid','$bloodquntity1','$bloodquntity2','$bloodquntity3','$bloodquntity4','$bloodquntity5','$bloodquntity6','$bloodquntity7','$bloodquntity8')");
                                                        if($querystockregister){
                                                            $_SESSION['updatestocksuccess']="You successfuly submited your stock";
                                                        }else{
                                                            $_SESSION['updatestockerror']="YOUR STOCK IS NOT SUBMITTED ";
                                                        }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }


?>
<div class="container-fluid">
     <div class="card">
         <h1 class="text-uppercase text-black text-center p-2 mt-2 my-0">Blood Stock</h1>
         <p class="text-center my-0 text-uppercase fw-bolder text-warning">1 bag = 350 ML</p>
         <hr class="mx-2">
        
          <?php
            $querybloodstock=mysqli_query($dlink,"SELECT * FROM bloodstock WHERE bloodbankemail='$useremail'");
            if(mysqli_num_rows($querybloodstock)){
                        echo '<form method="post" class="m-3">
                        <select name="bloodgroup" id="" class="form-control" required>
                        <option value="none">Select Your Blood group:</option>
                        <option value="AP">A+</option>
                        <option value="BP">B+</option>
                        <option value="ABP">AB+</option>
                        <option value="OP">O+</option>
                        <option value="AM">A-</option>
                        <option value="BM">B-</option>
                        <option value="ABM">AB-</option>
                        <option value="OM">O-</option>
                        </select>

                <input type="number" name="bloodquntity" id="" class="form-control" placeholder="Blood Quntity">
                <button type="submit" class="btn btn-success text-uppercase w-100 mt-2" name="updatestock">Update</button>
                </form>';
            }else{
                 echo '
                 <form method="post" class="m-3" name="form1">
                 <input type="number" name="bloodquntity_A+" id="bloodAP" class="form-control" placeholder="Blood Quntity :A+">
                 <input type="number" name="bloodquntity_B+" id="bloodBP" class="form-control" placeholder="Blood Quntity :B+">
                 <input type="number" name="bloodquntity_AB+" id="bloodABP" class="form-control" placeholder="Blood Quntity :AB+">
                 <input type="number" name="bloodquntity_O+" id="bloodOP" class="form-control" placeholder="Blood Quntity :O+" >
                 <input type="number" name="bloodquntity_A-" id="bloodAM" class="form-control" placeholder="Blood Quntity :A-">
                 <input type="number" name="bloodquntity_B-" id="bloodBM" class="form-control" placeholder="Blood Quntity :B-">
                 <input type="number" name="bloodquntity_AB-" id="bloodABM" class="form-control" placeholder="Blood Quntity :AB-">
                 <input type="number" name="bloodquntity_O-" id="bloodOM" class="form-control" placeholder="Blood Quntity :O-">
                <button class="btn btn-success text-uppercase w-100 mt-2" type="submit" onclick="bloodstock()" name="insertstock">Insert</button>
                </form>';
            }
          ?>
         

        
     </div>
</div>


<?php
include "includes/footer.php";
?>

<?php
if(isset($_SESSION['updatestocksuccess'])){
    echo '<script>
    swal({
        title: "Success",
        text:"'.$_SESSION['updatestocksuccess'].'",
        icon: "success",
        button: "Done",
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href="updatestock";
        } else {
            window.location.href="updatestock";
        }
      });
    </script>';

    unset($_SESSION['updatestocksuccess']);
}


if(isset($_SESSION['updatestockerror'])){
      
    echo '<script>
    swal({
        title: "'.$_SESSION['updatestockerror'].'",
        icon: "warning",
        button: "Done",
      })
      .then((willDelete) => {
        if (willDelete) {
            window.location.href="updatestock";
        } else {
            window.location.href="updatestock";
        }
      });
    </script>';

    unset($_SESSION['updatestockerror']);
}
?>





