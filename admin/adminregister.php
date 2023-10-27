<?php
 include "includes/header.php";
 include "includes/topbar.php";
 

 if(isset($_POST['adminregister'])){
   $adminname =$_POST['adminname'];
   $adminemail =$_POST['adminemail'];
   $adminpassword =$_POST['adminpassword'];
   $admincpassword =$_POST['admincpassword'];

   if(empty($adminname)&& empty($adminemail)&& empty($adminpassword)&& empty($admincpassword)){
       $_SESSION['error'] = "Please filled the data";
   }else{
       if(empty($adminname)){
           $_SESSION['errorusername'] ="please enter the adminname";
       }else{
        if(empty($adminemail)){
            $_SESSION['erroruseremail'] ="please enter the adminemail";
        }else{
            if(empty($adminpassword)){
                $_SESSION['erroruserpassword'] ="please enter the adminpassword";
            }else{
                if(empty($admincpassword)){
                    $_SESSION['errorusercpassword'] ="please enter the admin confirm password";
                }else{
                   if($adminpassword == $admincpassword){
                    $passwordHash=password_hash($adminpassword, PASSWORD_DEFAULT);
                    $querycheckuser=mysqli_query($dlink,"SELECT  * FROM adminregister WHERE adminemail='$adminemail'");
                    if(mysqli_num_rows($querycheckuser)){
                        $_SESSION['error'] ="this user alredy exist";
                    }else{
                        $queryinsertdata=mysqli_query($dlink,"INSERT INTO adminregister (adminname,adminemail,adminpassword) VALUES('$adminname','$adminemail','$passwordHash')");
                        if($queryinsertdata){
                          echo "<script>window.location.href='adminregister'</script>";
                        }
                    }
                   }else{
                        $_SESSION['error'] ="password and confirm password is not match";
                   }
                }
            }
        }
       }
   }
 }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="d-flex justify-content-end px-3">

</div>
<div class="card border-0 shadow-lg m-3">
            <div class="card-body">
                <!-- Nested Row within Card Body -->
                        <div class="p-2">
                            <div class="text-center">
                                <h1 class="text-uppercase text-gray-900 mb-4 fw-bolder">Register Admin</h1>
                                <hr class="mx-5">
                                <?php
                                if(isset($_SESSION['error'])){
                                    echo "<script>
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                          toast.addEventListener('mouseenter', Swal.stopTimer)
                                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                      })
                                      
                                      Toast.fire({
                                        icon: 'warning',
                                        title: '$_SESSION[error]'
                                      })
                                </script>";
                                    unset($_SESSION['error']);
                                }
                                ?>
                                
                            </div>
                            <form class="user mx-5" method="post">
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="adminname" placeholder="Enter Admin Name">
                                        <?php if(isset($_SESSION['errorusername'])){echo '<span class="text-danger mx-3 text-xm">'.$_SESSION['errorusername'].'</span>';unset($_SESSION['errorusername']);} ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="adminemail" id="exampleInputEmail"
                                        placeholder="Enter Admin Email Address">
                                        <?php if(isset($_SESSION['erroruseremail'])){ echo '<span class="text-danger mx-3 text-xm">'.$_SESSION['erroruseremail'].'</span>'; unset($_SESSION['erroruseremail']);} ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="adminpassword" placeholder="Enter Admin Password">
                                        <?php if(isset($_SESSION['erroruserpassword'])){ echo '<span class="text-danger mx-3 text-xm">'.$_SESSION['erroruserpassword'].'</span>'; unset($_SESSION['erroruserpassword']);} ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="admincpassword" placeholder="Enter Admin Repeat Password">
                                        <?php if(isset($_SESSION['errorusercpassword'])){ echo '<span class="text-danger mx-3 text-xm">'.$_SESSION['errorusercpassword'].'</span>'; unset($_SESSION['errorusercpassword']);} ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="adminregister">Register Account</button>
                                <hr>
                            </form>
                        </div>

        </div>


<?php
include "includes/footer.php";
?>