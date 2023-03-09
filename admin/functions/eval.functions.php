<?php

if (isset($_POST["submit"])){
        session_start();
        $_SESSION['instructor']=$_POST["ins_id"];
        header("location:../eval.solo.php?error=success");
}else{
    header("location:../instructor-table.php?error=nofile");
    exit;
}


?>