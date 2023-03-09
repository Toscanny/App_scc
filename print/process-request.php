<?php
if(isset($_POST["country"])){
    // Capture selected country
    $country = $_POST["country"];
     
    // Define country and city array
   
     
    // Display city dropdown based on country name
    if($country !== 'Select'){

        include "../includes/connect.php"; // Database connection using PDO
        //$sql="SELECT name,id FROM student"; 

        
        $sql="SELECT DISTINCT sbj_desc
        FROM tbl_grades
        INNER JOIN tbl_subject
        ON tbl_grades.sbj_id=tbl_subject.sbj_id
        WHERE tbl_grades.ins_id = $country"; 
        echo "<label for='exampleFormControlInput1' class='form-label'>Subject</label>";
        /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
        echo "<select name=subject value='' class='form-control'>Subject</option>"; // list box select command
        foreach ($conn->query($sql) as $row){//Array or records stored in $row
        echo "<option value=$row[sbj_id]>$row[sbj_desc]</option>"; 
        /* Option values are added by looping through the array */ 
        }
        echo "</select>";// Closing of list box
                     
    } 
}
?>