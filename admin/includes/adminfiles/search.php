<?php
if(isset($_POST['search'])){
require_once "dbconfig.php";

$s_id = $_POST['search'];

if(empty($s_id)){
    $output ="<script>location.reload()</script>";
}else{
$querysearch =mysqli_query($dlink,"SELECT * FROM userregister WHERE username LIKE '%{$s_id}%'");
$output ="";
if(mysqli_num_rows($querysearch) >0){
    $querysearch1 =mysqli_query($dlink,"SELECT * FROM donarregister WHERE donarname LIKE '%{$s_id}%'");
    if(mysqli_num_rows($querysearch1)){
        while($row =mysqli_fetch_assoc($querysearch1)) {
            $output .= "<a class='dropdown-item d-flex align-items-center border p-2' href='donar.php?registration'>
                                <div class='mr-2'>
                                <div class='icon-circle bg-primary mx-2'>
                                    <img src='../donar/asset/donarprofile/{$row['donarprofile']}' class='rounded-pill' height='50px' width='50px'>
                                </div>
                            </div>
                            <div>
                                <span class='font-weight-bold text-uppercase'>{$row['donarname']}</span>
                                <div class='small text-gray-500'>Donar</div>
                            </div>
                        </a>
            ";
        }
    }else{
        $querysearch1 =mysqli_query($dlink,"SELECT * FROM hospitalregister WHERE hospitalname LIKE '%{$s_id}%'");
        if(mysqli_num_rows($querysearch1)){
            while($row =mysqli_fetch_assoc($querysearch1)) {
                $output .= "<a class='dropdown-item d-flex align-items-center border p-2' href='hospital.php?registration'>
                                    <div class='mr-2'>
                                    <div class='icon-circle bg-primary mx-2'>
                                    <img src='../hospital/asset/hospitalprofile/{$row['hospitalprofile']}' class='rounded-pill' height='40px' width='40px'>
                                    </div>
                                </div>
                                <div>
                                    <span class='font-weight-bold text-uppercase'>{$row['hospitalname']}</span>
                                    <div class='small text-gray-500'>Hospital</div>
                                </div>
                            </a>
                ";
            }
        }else{
            $querysearch1 =mysqli_query($dlink,"SELECT * FROM bloodbankregister WHERE bloodbankname LIKE '%{$s_id}%'");
            if(mysqli_num_rows($querysearch1)){
                while($row =mysqli_fetch_assoc($querysearch1)) {
                    $output .= "<a class='dropdown-item d-flex align-items-center border p-2' href='bloodbank.php?registration'>
                                        <div class='mr-2'>
                                        <div class='icon-circle bg-primary mx-2'>
                                        <img src='../bloodbank/asset/bloodbankprofile/{$row['bloodbankprofile']}' class='rounded-pill' height='40px' width='40px'>
                                        </div>
                                    </div>
                                    <div>
                                        <span class='font-weight-bold text-uppercase'>{$row['bloodbankname']}</span>
                                        <div class='small text-gray-500'>BloodBank</div>
                                    </div>
                                </a>
                    ";
                }
            }else{
                $output .="no";
            }
        }
    }
}else{
    $output .="user are not found";
}
}
echo $output;
}else{
    echo "<script>window.location.href='../../index'</script>";
}
?>