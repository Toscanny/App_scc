<?php 
// Include the database config file 
include_once '../includes/connects.php'; 
 
if(!empty($_POST["instructor_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT DISTINCT tbl_subject.sbj_id, tbl_subject.sbj_desc
              FROM tbl_grades 
              INNER JOIN tbl_subject
              ON tbl_grades.sbj_id = tbl_subject.sbj_id
              WHERE tbl_grades.ins_id = ".$_POST['instructor_id'].""; 
    $result = $db->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Subject</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['sbj_id'].'">'.$row['sbj_desc'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Subject not available</option>'; 
    } 
}elseif(!empty($_POST["subject_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT DISTINCT tbl_yr.yr_id, tbl_yr.yr_desc
              FROM tbl_grades
              INNER JOIN tbl_yr
              ON tbl_grades.yr_id = tbl_yr.yr_id
              WHERE tbl_grades.sbj_id = ".$_POST['subject_id'].""; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select year</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['yr_id'].'">'.$row['yr_desc'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Year not available</option>'; 
    } 
} elseif(!empty($_POST["year_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT DISTINCT tbl_section.sec_id, tbl_section.sec_desc
              FROM tbl_grades
              INNER JOIN tbl_section
              ON tbl_grades.sec_id = tbl_section.sec_id
              WHERE tbl_grades.yr_id = ".$_POST['year_id'].""; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Section</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['sec_id'].'">'.$row['sec_desc'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Section not available</option>'; 
    } 
}
?>