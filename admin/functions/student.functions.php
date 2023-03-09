<?php
include_once("../../includes/connect.php");
$connect = mysqli_connect("localhost", "root", "", "mike");

    
   if (isset($_POST["Import"])){

    if ($_FILES['file']['name'] == "")
    {
    header('Location:../student-table.php?error=Nofile');
    exit();
    }else{


        if($_FILES['file']['name'])
{
$filename = explode(".", $_FILES['file']['name']);
if($filename[1] == 'csv'){

    $handle = fopen($_FILES['file']['tmp_name'], "r");

    while($data = fgetcsv($handle))//handling csv file 
    
    {
      $item1 = mysqli_real_escape_string($connect, utf8_encode($data[0]));
      $item2 = mysqli_real_escape_string($connect, utf8_encode($data[1]));
      $item3 = mysqli_real_escape_string($connect, utf8_encode($data[2]));
      $item4 = mysqli_real_escape_string($connect, utf8_encode($data[3]));
      $item5 = mysqli_real_escape_string($connect, utf8_encode($data[4]));
      $item6 = mysqli_real_escape_string($connect, utf8_encode($data[5]));
      $item7 = password_hash(mysqli_real_escape_string($connect, utf8_encode($data[6])), PASSWORD_DEFAULT);
      $item8 = mysqli_real_escape_string($connect, utf8_encode($data[7]));

        $statement=$conn->prepare("SELECT * FROM tbl_yr WHERE yr_desc = '$item8'");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

          if(!empty($result)){
            $yr_ids = $result["yr_id"];

          }else{

              $ins_id = "";
          }
      

      $query = "INSERT INTO tbl_students (s_id, s_name, s_bdate, s_gender, s_address, s_status, s_pass, yr_id) 
      VALUES('$item1','$item2','$item3','$item4','$item5', '$item6', '$item7', '$yr_ids')
      ON DUPLICATE KEY UPDATE s_name='$item2', s_bdate='$item3', s_gender='$item4', s_address='$item5', s_status='$item6', s_pass='$item7', yr_id='$yr_ids'";

      mysqli_query($connect, $query);
}

}

fclose($handle);
header("location:../student-table.php?error=Uploaded");
     exit;

}


    // $filename=$_FILES["file"]["tmp_name"];    
    //  if($_FILES["file"]["size"] > 0)
    //  {
    //     $file = fopen($filename, "r");
    //       while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
    //        {
    //          $sql = "INSERT INTO tbl_user (user_id,firstName,lastName,email,password) 
    //                VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')
    //                ON DUPLICATE KEY UPDATE 
    //                    firstName='".$getData[1]."', lastName='".$getData[2]."', email='".$getData[3]."', password='".$getData[4]."'";
    //                $result = mysqli_query($connect, $sql);
    //     if(!isset($result))
    //     {
    //       echo "<script type=\"text/javascript\">
    //           alert(\"Invalid File:Please Upload CSV File.\");
    //           window.location = \"upload.php\"
    //           </script>";    
    //     }
    //     else {
    //         echo "<script type=\"text/javascript\">
    //         alert(\"CSV File has been successfully Imported.\");
    //         window.location = \"upload.php\"
    //       </script>";
    //     }
    //        }
      
    //        fclose($file);  
    //  }
    }
  } 


 ?>











