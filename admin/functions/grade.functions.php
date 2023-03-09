<?php
include_once("../../includes/connect.php");
$connect = mysqli_connect("localhost", "root", "", "mike");

    
   if (isset($_POST["Import"])){

    if ($_FILES['file']['name'] == "")
    {
      header('location:../../upload/upload.grade.php?error=Nofile');
    exit();
    }else{

      $syid = $_POST["sy"];
      $semid = $_POST["sem"];
      $sbjid = $_POST["subject"];
      $section = $_POST["sec"];
      $yrlvl = $_POST["year"];
      $inst = $_POST["ins"];
      //$semid = $_POST["sem"];
      // $sbjid = $_POST["subject"];



if($_FILES['file']['name'])
{
$filename = explode(".", $_FILES['file']['name']);
if($filename[1] == 'csv'){

    $handle = fopen($_FILES['file']['tmp_name'], "r");

    while($data = fgetcsv($handle))//handling csv file 
   
          {
            $item1 = mysqli_real_escape_string($connect, utf8_encode($data[0]));
            $item2 = mysqli_real_escape_string($connect, utf8_encode($sbjid));
            $item3 = mysqli_real_escape_string($connect, utf8_encode($syid));
            $item4 = mysqli_real_escape_string($connect, utf8_encode($semid));
            $secid = mysqli_real_escape_string($connect, utf8_encode($section));
            $yr = mysqli_real_escape_string($connect, utf8_encode($yrlvl));
            $ins = mysqli_real_escape_string($connect, utf8_encode($inst));
            $item5 = mysqli_real_escape_string($connect, utf8_encode($data[1]));
            $item6 = mysqli_real_escape_string($connect, utf8_encode($data[2]));
            $item7 = mysqli_real_escape_string($connect, utf8_encode($data[3]));
            $item8 = mysqli_real_escape_string($connect, utf8_encode($data[4]));

            $statement=$conn->prepare("SELECT * FROM tbl_grades WHERE s_id = '$item1' AND sbj_id = '$item2' AND sec_id = '$secid'");
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

          

            if(!empty($result)){
              $query = "UPDATE tbl_grades SET ins_id = '$ins', prelim = '$item5', midterm = '$item6', prefinal = '$item7', final = '$item8' WHERE s_id = '$item1' AND sbj_id = '$item2' AND sec_id = '$secid'";
              
            }else{
              $query = "INSERT INTO tbl_grades (s_id, sbj_id, sy_id, sem_id, sec_id, yr_id, ins_id, prelim, midterm, prefinal, final) 
              VALUES('$item1', '$item2', '$item3','$item4','$secid', '$yr', '$ins', '$item5','$item6','$item7','$item8')";
              
            }

            try{
              mysqli_query($connect, $query);
           }
           catch(Exception $e)
           {
            continue;
           }
           

            
          }
      
       

  }

    fclose($handle);
    header("location:../grade-table.php?error=Uploaded");
    exit;

  }

}
} 


 ?>











