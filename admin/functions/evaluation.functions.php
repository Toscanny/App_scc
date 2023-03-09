<?php
include_once("../../includes/connect.php");
$connect = mysqli_connect("localhost", "root", "", "mike");

    
   if (isset($_POST["Import"])){

    if ($_FILES['file']['name'] == "")
    {
    header('location:../../upload/upload.evaluation.php?error=Nofile');
    exit();
    }else{

      $syid = $_POST["sy"];
      $semid = $_POST["sem"];
      // $sbjid = $_POST["subject"];
      //$semid = $_POST["sem"];
      // $sbjid = $_POST["subject"];



        if($_FILES['file']['name'])
{
$filename = explode(".", $_FILES['file']['name']);
if($filename[1] == 'csv'){

    $handle = fopen($_FILES['file']['tmp_name'], "r");

    while($data = fgetcsv($handle))//handling csv file 
    
    {
      
      $syids = mysqli_real_escape_string($connect, utf8_encode($syid));
      $semids = mysqli_real_escape_string($connect, utf8_encode($semid));
      $time = mysqli_real_escape_string($connect, utf8_encode($data[0]));
      $email = mysqli_real_escape_string($connect, utf8_encode($data[1]));
      $instructor = mysqli_real_escape_string($connect, utf8_encode($data[2]));

        $statement=$conn->prepare("SELECT * FROM tbl_instructor WHERE ins_name = '$instructor'");
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if(!empty($result)){
          $ins_id = $result["ins_id"];

        }else{

            $ins_id = "";
        }
        
      

      $q1 = mysqli_real_escape_string($connect, utf8_encode($data[3]));
      $q2 = mysqli_real_escape_string($connect, utf8_encode($data[4]));
      $q3 = mysqli_real_escape_string($connect, utf8_encode($data[5]));
      $q4 = mysqli_real_escape_string($connect, utf8_encode($data[6]));
      $q5 = mysqli_real_escape_string($connect, utf8_encode($data[7]));
      $q6 = mysqli_real_escape_string($connect, utf8_encode($data[8]));
      $q7 = mysqli_real_escape_string($connect, utf8_encode($data[9]));
      $q8 = mysqli_real_escape_string($connect, utf8_encode($data[10]));
      $q9 = mysqli_real_escape_string($connect, utf8_encode($data[11]));
      $q10 = mysqli_real_escape_string($connect, utf8_encode($data[12]));
      $q11 = mysqli_real_escape_string($connect, utf8_encode($data[13]));
      $q12 = mysqli_real_escape_string($connect, utf8_encode($data[14]));
      $q13 = mysqli_real_escape_string($connect, utf8_encode($data[15]));
      $q14 = mysqli_real_escape_string($connect, utf8_encode($data[16]));
      $q15 = mysqli_real_escape_string($connect, utf8_encode($data[17]));
      $q16 = mysqli_real_escape_string($connect, utf8_encode($data[18]));
      $q17 = mysqli_real_escape_string($connect, utf8_encode($data[19]));
      $q18 = mysqli_real_escape_string($connect, utf8_encode($data[20]));
      $q19 = mysqli_real_escape_string($connect, utf8_encode($data[21]));
      $q20 = mysqli_real_escape_string($connect, utf8_encode($data[22]));
      $q21 = mysqli_real_escape_string($connect, utf8_encode($data[23]));
      $q22 = mysqli_real_escape_string($connect, utf8_encode($data[24]));
      $q23 = mysqli_real_escape_string($connect, utf8_encode($data[25]));
      $q24 = mysqli_real_escape_string($connect, utf8_encode($data[26]));
      $q25 = mysqli_real_escape_string($connect, utf8_encode($data[27]));
      $q26 = mysqli_real_escape_string($connect, utf8_encode($data[28]));
      $q27 = mysqli_real_escape_string($connect, utf8_encode($data[29]));
      $q28 = mysqli_real_escape_string($connect, utf8_encode($data[30]));
      $q29 = mysqli_real_escape_string($connect, utf8_encode($data[31]));
      $q30 = mysqli_real_escape_string($connect, utf8_encode($data[32]));
      $q30 = mysqli_real_escape_string($connect, utf8_encode($data[32]));
      $comments = mysqli_real_escape_string($connect, utf8_encode($data[33]));
      $name = mysqli_real_escape_string($connect, utf8_encode($data[34]));
      $course = mysqli_real_escape_string($connect, utf8_encode($data[35]));


      $stmt_eval=$conn->prepare("SELECT * FROM tbl_evaluation WHERE eval_date = '$time' AND eval_email = '$email' AND eval_name = '$name'");
      $stmt_eval->execute();
      $eval_rst = $stmt_eval->fetch(PDO::FETCH_ASSOC);
      

      if(!empty($eval_rst)){
        $eval_id = $eval_rst["eval_id"];
        $query = "UPDATE tbl_evaluation SET yr_id='$syids', sem_id='$semids', ins_id='$ins_id', a1='$q1', a2='$q2', a3='$q3', a4='$q4', a5='$q5', a6='$q6', a7='$q7', a8='$q8', a9='$q9', a10='$q10', a11='$q11', a12='$q12', a13='$q13', a14='$q14', a15='$q15', a16='$q16', b17='$q17', b18='$q18', b19='$q19', b20='$q20', b21='$q21', b22='$q22', b23='$q23', b24='$q24', b25='$q25', b26='$q26', b27='$q27', b28='$q28', b29='$q29', b30='$q30', eval_email='$email', eval_comments='$comments', eval_name='$name', eval_course='$course', eval_date='$time' WHERE eval_id='$eval_id'";
      }else{
        $query = "INSERT INTO tbl_evaluation (yr_id, sem_id, ins_id, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, a13, a14, a15, a16, b17, b18, b19, b20, b21, b22, b23, b24, b25, b26, b27, b28, b29, b30, eval_email, eval_comments, eval_name, eval_course, eval_date) 
        VALUES('$syids', '$semids', '$ins_id','$q1','$q2','$q3','$q4','$q5','$q6','$q7','$q8','$q9','$q10','$q11','$q12','$q13','$q14','$q15','$q16','$q17','$q18','$q19','$q20','$q21','$q22','$q23','$q24','$q25','$q26','$q27','$q28','$q29','$q30', '$email', '$comments', '$name', '$course', '$time')";
      }
      mysqli_query($connect, $query);
}

}

fclose($handle);
header("location:../instructor-table.php?error=Uploaded");
     exit;

}

  }
  } 

 ?>











