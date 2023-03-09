<?php
include_once("../../includes/connect.php");
$connect = mysqli_connect("localhost", "root", "", "mike");

    
   if (isset($_POST["Import"])){

    if ($_FILES['file']['name'] == "")
    {
    header('Location:user-table.php?error=Nofile');
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

      $query = "INSERT into tbl_instructor (ins_name, ins_dept, ins_status) 
      values('$item1','$item2','$item3')";

      mysqli_query($connect, $query);
}

}

fclose($handle);
header("location:../instructor-table.php?error=Uploaded");
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











