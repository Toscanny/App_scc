<?php

if(isset($_POST['sid'])){
    $sid = $_POST['sid'];
    $deptid = $_POST['dept'];
}else{
    header("location: student-table.php?error=notfound");
}

include_once '../templates/header.php';

include "../includes/connect.php";
include "../includes/connection.php";

var_dump($_POST);

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                </div>

                    <form action="functions/add-enrollee.inc.php" method="post">
                    <!-- <form action="functions/add-sched.inc.php" method="post"> -->

                        <div class="modal-body">

                            <?php
                                include "../includes/connect.php";
                                $sql="SELECT * FROM tbl_students WHERE s_id = '$sid'"; 
                                echo "<label for='exampleFormControlInput1' class='form-label'>Student</label>";
                                echo "<select name=stid value='' class='form-control' required>Student</option>";
                                foreach ($conn->query($sql) as $row){
                                echo "<option value=$row[s_id]>$row[s_name]</option>";
                                }echo "</select>";
                            ?>
                            <br/>
                            <?php
                                $sql="SELECT * FROM tbl_sy"; 
                                echo "<label for='exampleFormControlInput1' class='form-label'>School Year</label>";
                                echo "<select name=syid value='' class='form-control' required>School Year</option>"; 
                                echo "<option value=''>Select</option>"; 
                                foreach ($conn->query($sql) as $row){
                                echo "<option value=$row[sy_id]>$row[sy_desc]</option>"; 
                                }echo "</select>";
                            ?>
                            <br/>
                            <?php
                                include "../includes/connect.php";
                                $sql="SELECT * FROM tbl_sem"; 
                                echo "<label for='exampleFormControlInput1' class='form-label'>Semester</label>";
                                echo "<select name=semid value='' class='form-control' required>Semester</option>";
                                echo "<option value=''>Select</option>";
                                foreach ($conn->query($sql) as $row){
                                echo "<option value=$row[sem_id]>$row[sem_desc]</option>"; 
                                }echo "</select>";
                            ?>
                            <br/>
                            
                            <?php
                                include "../includes/connect.php";
                                $sql="SELECT * FROM tbl_course WHERE course_id = '$deptid'"; 
                                echo "<label for='exampleFormControlInput1' class='form-label'>Department</label>";
                                echo "<select name=deptid value='' class='form-control' required>Department</option>";
                                foreach ($conn->query($sql) as $row){
                                echo "<option value=$row[course_id]>$row[course_code]</option>"; 
                                }echo "</select>";
                            ?>
                            <br/>
                            <?php
                                include "../includes/connect.php";
                                $sql="SELECT * FROM tbl_yr"; 
                                echo "<label for='exampleFormControlInput1' class='form-label'>Year</label>";
                                echo "<select name=yearid value='' class='form-control' required>Year</option>";
                                echo "<option value=''>Select</option>";
                                foreach ($conn->query($sql) as $row){
                                echo "<option value=$row[yr_id]>$row[yr_desc]</option>"; 
                                }echo "</select>";
                            ?>
                            <br/>
                            <?php
                                include "../includes/connect.php";
                                $sql="SELECT * FROM tbl_section"; 
                                echo "<label for='exampleFormControlInput1' class='form-label'>Section</label>";
                                echo "<select name=secid value='' class='form-control' required>Section</option>";
                                echo "<option value=''>Select</option>";
                                foreach ($conn->query($sql) as $row){
                                echo "<option value=$row[sec_id]>$row[sec_desc]</option>"; 
                                }echo "</select>";
                            ?>
                            <br/>


                        </div>
                        <div class="modal-footer">
                        <a href="../admin/sched-table.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-primary" name ="enroll">Import </button>
                        </div>
                    </form>
            </div>
        </div>
    


    </div>

    <!-- /.container-fluid -->



<?php
include_once '../templates/footer.php';
?>