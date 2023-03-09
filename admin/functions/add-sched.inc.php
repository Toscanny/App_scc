<?php
include("../../includes/connect.php");
include("../../includes/connection.php");



if(isset($_POST["submit"])){

    $sy = $_POST["sy"];
    $sem = $_POST["sem"];
    $ins = $_POST["ins"];
    $sbj = $_POST["sbj"];
    $yr = $_POST["year"];
    $sec = $_POST["sec"];
    $day = $_POST["day"];
    $st = $_POST["stime"];
    $en = $_POST["etime"];
    $rom = $_POST["room"];
    $dept = $_POST["dept"];



    $database = new Connection();
        $dbs = $database->open();
  

        $sql = "SELECT * FROM tbl_sched WHERE room_id = '$room' AND day_id = '$day' AND  ('$st' BETWEEN start_time AND end_time
                OR '$en' BETWEEN start_time AND end_time OR '$st' >= end_time AND '$en' <= end_time)";

        $stmt = $dbs->query($sql);
        $result = $stmt->fetchAll();

        if(empty($result)){

            
            // try {
            //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                
               
              
              
            //     $conn->exec($sql);
            //     echo "New record created successfully";
            //   } catch(PDOException $e) {
            //     echo $sql . "<br>" . $e->getMessage();
            //   }
              
            //   $conn = null;
            
            header("location: ../sched-table.php?error=success");
        }else{
            header("location: ../sched-table.php?error=conflict");
        }


}else{

    header("location: ../admin/sched-table.php?error=unsuccess");

}
?>