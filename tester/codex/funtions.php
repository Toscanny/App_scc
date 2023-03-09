<?php

include("dbConfig.php");
include_once ("connection.php");


if(isset($_POST["submit"])){

    $day = $_POST["day"];
    $st = $_POST["time_st"];
    $en = $_POST["time_et"];
    $sbj = $_POST["sbj"];

  
        //include our connection
        
        $database = new Connection();
        $dbs = $database->open();
  

        $sql = "SELECT * FROM tbl_sched WHERE day = '$day' AND  ('$st' BETWEEN start AND end
                                            OR '$en' BETWEEN start AND end
                                            OR '$st' >= start AND '$en' <= end)";

        $stmt = $dbs->query($sql);
        $result = $stmt->fetchAll();

        if(empty($result)){
            
            $query = "INSERT INTO tbl_sched (day, start, end, subject)VALUES('$day', '$st', '$en', '$sbj')";
            $result = $db->query($query); 
            
            header("location: time.php?error=success");
        }else{
            echo "Conflict Exists";
        }





}else{
    header("location: time.php?error=unsuccess");
}


?>