<?php
include "includes/header.php";
date_default_timezone_set('asia/kolkata');
if(isset($_GET['userprofile'])){
    $hospitalprofile='<form  method="post" enctype="multipart/form-data" class="uploadimg animate__animated animate__backInDown">
    <label class="text-uppercase">choose photo
    <input type="file" name="newprofile" id="">
    </label>
    <button type="submit" name="uploadprofile" class="border-0 fs-4 bg-none"><i class="fa-solid fa-upload"></i></button>
    </form>
    <a href="profile" class="text-decoration-none text-black position-absolute top-0 end-0 m-3 mx-4 fs-5"><i class="fa-solid fa-close"></i></a>';
}else{
    $hospitalprofile ='';
}

if(isset($_POST['uploadprofile'])){
    $hospitalprofile = $_FILES['newprofile']['name'];
     if(empty($hospitalprofile)){
        $_SESSION['hospitalprofileerror'] ="please select the image";
     }else{
        $queryprofiledonar =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalemail='$useremail'");
        if(mysqli_num_rows($queryprofiledonar)){
              $queryprofiledonarphoto=mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalprofile='$hospitalprofile' AND hospitalemail='$useremail'");
              if(mysqli_num_rows($queryprofiledonarphoto)){
                 $_SESSION['hospitalprofileerror'] ="This Profile Is Alredy Exist";
              }else{
                $queryupdateprofile=mysqli_query($dlink,"UPDATE hospitalregister SET hospitalprofile='$hospitalprofile' WHERE hospitalemail='$useremail'");
                if($queryupdateprofile){
                move_uploaded_file($_FILES["newprofile"]["tmp_name"], "asset/hospitalprofile/".$_FILES["newprofile"]["name"]);
                $_SESSION['hospitalprofilesuccess'] ="Updated Successfuly";
                }
              }
        }else{
            $_SESSION['hospitalprofileerror'] ="Somethig Went To Wrong";
        }
     }
}
?>
<style>
    .profileicon{
        display:none;
    }
    @media screen and (max-width: 700px){
        .profileicon{
            display:block;
        }
        .profiletitle{
            display:none;
        }
       
    }
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
                    <a href="?userprofile"><img src="asset/hospitalprofile/<?php echo $userprofile; ?>" alt="" height="120px" width="120px" class="rounded-circle"></a>
                     <p class="text-uppercase fs-3"><?php echo $username; ?></p>
                     <div><?php echo $hospitalprofile; ?></div>
                 </div>
                 <div class="card-body p-0 overflow-scroll">
                    <div class="position-relative">
                    <div class="alert">Personal Information:</div>
                    <div class="px-4 my-0">
                    <table class="table border-0 border-light text-capitalize ">
                             <thead>
                                 <tr>
                                    <td class="col-md-3  fs-5">Hospital Name</td>
                                    <td class="col-md-1" >:</td>
                                    <td class="col-md-8" ><?php echo $username; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">Hospital email</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $useremail; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">hospital Contact Number</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $usernumber; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">Hospital address</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $useraddress; ?></td>
                                 </tr>
                            </thead>
                    </table>
                   
                    </div>
                    </div>
                 </div>
            </div>
        </div>


<?php
include "includes/footer.php";
?>

<?php
           if(isset($_SESSION['hospitalprofilesuccess'])){
            echo '<script>
            swal({
                title: "'.$_SESSION['hospitalprofilesuccess'].'",
                icon: "success",
                button: "done",
              })
              .then((willDelete) => {
                if (willDelete) {
                    window.location.href="profile";
                } else {
                    window.location.href="profile";
                }
              });
            </script>';
            unset($_SESSION['hospitalprofilesuccess']);
           }
           if(isset($_SESSION['hospitalprofileerror'])){
            echo '<script>
            swal({
                title: "'.$_SESSION['hospitalprofileerror'].'",
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
            unset($_SESSION['hospitalprofileerror']);
           }
        ?>
