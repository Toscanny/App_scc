<?php

include_once("../../includes/connection.php");

//heLLO UNIVERSE

if(isset($_POST["enroll"])){

    $stid = $_POST["stid"];
    $syid = $_POST["syid"];
    $semid = $_POST["semid"];
    $deptid = $_POST["deptid"];
    $yearid = $_POST["yearid"];
    $secid = $_POST["secid"];

    $database = new Connection();
    $dbs = $database->open();
    $sql = "SELECT * FROM tbl_enrollees WHERE s_id = '$stid' AND sy_id = '$syid' AND sem_id = '$semid'";
    $stmt = $dbs->query($sql);
    $result = $stmt->fetchAll();
    if(empty($result)){
        try {
            $database = new Connection();
            $dbs = $database->open();
            $sql = "INSERT INTO `tbl_enrollees`(`sy_id`, `sem_id`, `s_id`, `course_id`, `yr_id`, `sec_id`) VALUES ('$syid','$semid','$stid','$deptid','$yearid', '$secid')";
            $dbs->exec($sql);
            echo "New record created successfully";
        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        
        $conn = null;
        
        
        session_start();
        $_SESSION['s_id']=$stid;
        $_SESSION['sec_id']=$secid;
        $_SESSION['yr_id']=$yearid;
        $_SESSION['dept_id']=$deptid;

        header("location:../blank.php?error=success");
    }else{
        session_start();
        $_SESSION['s_id']=$stid;
        $_SESSION['sec_id']=$secid;
        $_SESSION['yr_id']=$yearid;
        $_SESSION['dept_id']=$deptid;


        header("location:../blank.php?error=success");
    }
    
    
    }else{

        header("location:../student-table.php?error=nofile");
    }

?>