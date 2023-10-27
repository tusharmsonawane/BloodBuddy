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
    $donarprofile = $_FILES['newprofile']['name'];
     if(empty($donarprofile)){
        $_SESSION['donarprofileerror'] ="please choose the image";
     }else{
        $queryprofiledonar =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donaremail='$useremail'");
        if(mysqli_num_rows($queryprofiledonar)){
              $queryprofiledonarphoto=mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarprofile='$donarprofile' AND donaremail='$useremail'");
              if(mysqli_num_rows($queryprofiledonarphoto)){
                   $_SESSION['donarprofileerror'] ='This Profile Already Exist';
              }else{
                $queryupdateprofile=mysqli_query($dlink,"UPDATE donarregister SET donarprofile='$donarprofile' WHERE donaremail='$useremail'");
                if($queryupdateprofile){
                move_uploaded_file($_FILES["newprofile"]["tmp_name"], "asset/donarprofile/".$_FILES["newprofile"]["name"]);
                $_SESSION['donarprofilesuccess'] ="Updated Successfuly";
                }
              }
        }else{
            $_SESSION['donarprofileerror'] ="Something Wents To Wrong";
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
     #profile .card-body .alert{
        padding:10px 0px 0px 10px !important;
     }
</style>


           <div class="card h-100" id="profile">
                 <div class="card-header text-center p-1">
                     <a href="profile?userprofile"><img src="asset/donarprofile/<?php echo $userprofile; ?>" alt="" height="120px" width="120px" class="rounded-circle"></a>
                     <p class=" fs-3 text-uppercase"><?php echo $username; ?></p>
                     <div class=""><?php echo $profileupdate;?></div>
                 </div>
                 <div class="card-body p-0 my-0 overflow-scroll">
                    <div class="position-relative">
                    <div class="alert">Personal Information:</div>
                    <div class="px-4 my-0">
                        <table class="table border-0 border-light text-capitalize">
                             <thead>
                                 <tr>
                                    <td class="col-md-3  fs-5">Name </td>
                                    <td class="col-md-1" >:</td>
                                    <td class="col-md-8" ><?php echo $username; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">email</td>
                                    <td class="col-md-1">:</td>
                                    <td class="text-lowercase"><?php echo $useremail; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">gender</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $usergender; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">birth date</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $userdob; ?></td>
                                 </tr>
                                 <tr>
                                 <?php
                                    if($userbloodgroup =="AP"){
                                        $donarbloodgroup = "A+";
                                    }else{
                                        if($userbloodgroup =="BP"){
                                            $donarbloodgroup = "B+";
                                        }else{
                                            if($userbloodgroup =="ABP"){
                                                $donarbloodgroup = "AB+";
                                            }else{
                                                if($userbloodgroup =="OP"){
                                                    $donarbloodgroup = "O+";
                                                }else{
                                                    if($userbloodgroup =="AM"){
                                                        $donarbloodgroup = "A-";
                                                    }else{
                                                        if($userbloodgroup =="BM"){
                                                            $donarbloodgroup = "B-";
                                                        }else{
                                                            if($userbloodgroup =="ABM"){
                                                                $donarbloodgroup = "AB-";
                                                            }else{
                                                                if($userbloodgroup =="OM"){
                                                                    $donarbloodgroup = "O-";
                                                                }else{
                                                                    $donarbloodgroup="";
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                        ?>
                                    <td class="col-md-3  fs-5">blood group</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $donarbloodgroup; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">mobile number</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $usernumber; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">address</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $useraddress; ?></td>
                                 </tr>
                                 <tr>
                                    <td class="col-md-3  fs-5">occupasion</td>
                                    <td class="col-md-1" >:</td>
                                    <td><?php echo $useroccupation; ?></td>
                                 </tr>
                             </thead>
                        </table>

                    </div>
                    </div>
                 </div>
            </div>
        </div>
        
        <?php
                if(isset($_SESSION['donarprofilesuccess'])){
                    echo '<script>
                    swal({
                        title: "'.$_SESSION['donarprofilesuccess'].'",
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
                    unset($_SESSION['donarprofilesuccess']);
                    }

                    if(isset($_SESSION['donarprofileerror'])){
                        echo '<script>
                        swal({
                            title: "'.$_SESSION['donarprofileerror'].'",
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
                        unset($_SESSION['donarprofileerror']);
                        }
                ?>
<?php
include "includes/footer.php";
?>