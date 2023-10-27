<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');
if(isset($_GET['userprofile'])){
    $profileupdate ='<form  method="post" enctype="multipart/form-data" class="uploadimg animate__animated animate__backInDown">
                    <label class="text-uppercase">choose photo
                    <input type="file" name="newprofile" id="">
                    </label>
                    <button type="submit" name="uploadprofile" class="border-0 fs-4 bg-none"><i class="fa-solid fa-upload"></i></button>
                    </form>
                    <a href="profile" class="text-decoration-none text-black position-absolute top-0 end-0 m-3 mx-4 fs-5"><i class="fa-solid fa-close"></i></a>';

}else{
    $profileupdate='';
}

if(isset($_POST['uploadprofile'])){
    $bloodbankprofile = $_FILES['newprofile']['name'];
     if(empty($bloodbankprofile)){
        $_SESSION['bloodbankprofileerror'] ="Please Choose The Image";
     }else{
        $queryprofilebloodbank =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankemail='$useremail'");
        if(mysqli_num_rows($queryprofilebloodbank)){
              $queryprofilebloodbankphoto=mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankprofile='$bloodbankprofile' AND bloodbankemail='$useremail'");
              if(mysqli_num_rows($queryprofilebloodbankphoto)){
                   $_SESSION['bloodbankprofileerror'] ='This Profile Already Exist';
              }else{
                $queryupdateprofile=mysqli_query($dlink,"UPDATE bloodbankregister SET bloodbankprofile='$bloodbankprofile' WHERE bloodbankemail='$useremail'");
                if($queryupdateprofile){
                move_uploaded_file($_FILES["newprofile"]["tmp_name"], "asset/bloodbankprofile/".$_FILES["newprofile"]["name"]);
                $_SESSION['bloodbankprofileerror'] ="Successfuly Updated";
                }
              }
        }else{
            $_SESSION['bloodbankprofileerror'] ="Something Wents To Wrong";
        }
     }
}
?>
<style>
     input[type="file"]{
                display:none;
            }
     label{
        position:relative;
        height:40px;
        width:150px;
        border:1px solid #000;
        display:flex;
        justify-content:center;
        align-items:center;
        color:#000;
        border-radius:5px;
       
     }
     .uploadimg{
        display:flex;
        justify-content:center;
        position:relative;
        transition:all 1s ease-in-out;
     }
     .card .card-body::-webkit-scrollbar{
        width:0;
     }
     .card .card-body .alert{
        padding:10px 0px 0px 10px !important;
     }
</style>
            <div class="card mt-2 mx-2 p-2">
                 <div class="card-header text-center p-3">
                     <a href="profile?userprofile"><img src="asset/bloodbankprofile/<?php echo $userprofile; ?>" alt="" height="120px" width="120px" class="rounded-circle"></a>
                     <p class=" fs-3 text-uppercase"><?php echo $username; ?></p>
                     <div class=""><?php echo $profileupdate;?></div>
                    </div>
                 <div class="card-body p-0">
                     <div class="alert">Personal Information:</div>
                     <div class="px-4 my-0">
                     <table class="table border-0 border-light text-capitalize ">
                             <thead>
                                 <tr>
                                    <td class="col-md-3  fs-5">Name</td>
                                    <td class="col-md-1" >:</td>
                                    <td class="col-md-8" ><?php echo $username; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">Email</td>
                                    <td class="col-md-1" >:</td>
                                    <td class="text-lowercase"><?php echo $useremail; ?></td>
                                 </tr>
                                 <tr>
                                    <?php
                                    $querylid=mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankid='$bloodbankid'");
                                    if(mysqli_num_rows($querylid)){
                                        while($lidrow=mysqli_fetch_assoc($querylid)){
                                            $lid=$lidrow['bloodbankLid'];
                                        }
                                    }
                                    ?>
                                    <td class="col-md-3  fs-5">License No</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $lid; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">Manager Name</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $bloodbankmanager; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">Mobile Number </td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $usernumber; ?></td>
                                 </tr>
                            </thead>
                    </table>
                    </div>
                 </div>
            </div>
        </div>

        <?php
                if(isset($_SESSION['bloodbankprofilesuccess'])){
                echo '<script>
                swal({
                    title: "'.$_SESSION['bloodbankprofilesuccess'].'",
                    icon: "success",
                    button: "Done",
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location.href="profile";
                    } else {
                        window.location.href="profile";
                    }
                  });
                </script>';
                unset($_SESSION['bloodbankprofilesuccess']);
                }
                if(isset($_SESSION['bloodbankprofileerror'])){
                    echo '<script>
                    swal({
                        title: "'.$_SESSION['bloodbankprofileerror'].'",
                        icon: "warning",
                        button: "Done",
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                          window.location.href="profile";
                        } else {
                            window.location.href="profile";
                        }
                      });
                    </script>';
                    unset($_SESSION['bloodbankprofileerror']);
                    }
                ?>
<script>
     let errorbtn =document.querySelector(".errorbg");
     errorbtn.onclick = function () {
     location.reload();
 }
</script>
<?php
include "includes/footer.php";
?>