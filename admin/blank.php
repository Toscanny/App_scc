<?php


session_start();

var_dump($_SESSION);


include_once '../templates/header.php';

include "../includes/connect.php";
include "../includes/connection.php";




?>


<style>
.table td, .table th {
    padding: 0 0 0 8px !important;
    vertical-align: middle !important;
    border-top: 1px solid #e3e6f0 !important;
}

.btn-sm {
    padding: 0 5px !important;
    font-size: 11px !important;
    line-height: 1.5 !important;
    border-radius: 0.2rem !important;
    vertical-align: middle !important;
}

table.dataTable>thead .sorting:before, table.dataTable>thead .sorting:after, table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_asc:after, table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_desc:after, table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_asc_disabled:after, table.dataTable>thead .sorting_desc_disabled:before, table.dataTable>thead .sorting_desc_disabled:after{
    bottom: -0.1em !important;
}
</style>

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Day</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Section</th>
                    <th>Year</th>
                    <th>Department</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //include our connection
                

                    
                    if(isset($_SESSION['s_id'])){

                        
                        $sec = $_SESSION['sec_id'];
                        $sid = $_SESSION['s_id'];
                        $year = $_SESSION['yr_id'];
                        $dept = $_SESSION['dept_id'];

                    }else{
                        $sid=0;
                    }
        
                    



                    $database = new Connection();
                    $db = $database->open();
                    try{	
                        if($sec == 6){

                        $sql = "SELECT * FROM tbl_sched
                                INNER JOIN tbl_subject
                                ON tbl_sched.sbj_id = tbl_subject.sbj_id
                                INNER JOIN tbl_section
                                ON tbl_sched.sec_id = tbl_section.sec_id
                                INNER JOIN tbl_day
                                ON tbl_sched.day_id = tbl_day.day_id
                                INNER JOIN tbl_yr
                                ON tbl_sched.yr_id = tbl_yr.yr_id
                                INNER JOIN tbl_course
                                ON tbl_sched.course_id = tbl_course.course_id";
                        }else{
                        $sql = "SELECT * FROM tbl_sched
                                INNER JOIN tbl_subject
                                ON tbl_sched.sbj_id = tbl_subject.sbj_id
                                INNER JOIN tbl_section
                                ON tbl_sched.sec_id = tbl_section.sec_id
                                INNER JOIN tbl_day
                                ON tbl_sched.day_id = tbl_day.day_id
                                INNER JOIN tbl_yr
                                ON tbl_sched.yr_id = tbl_yr.yr_id
                                INNER JOIN tbl_course
                                ON tbl_sched.course_id = tbl_course.course_id
                                WHERE tbl_yr.yr_id = '$year' AND tbl_section.sec_id = '$sec'
                                AND tbl_course.course_id = '$dept'";      
                        }
                        foreach ($db->query($sql) as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row["sbj_code"]?></td>
                                <td><?php echo $row["sbj_desc"]?></td>
                                <td><?php echo $row["day_desc"]?></td>
                                <td><?php echo date('h:i A', strtotime($row['start_time']))?></td>
                                <td><?php echo date('h:i A', strtotime($row['end_time']))?></td>
                                <td><?php echo $row["sec_desc"]?></td>
                                <td><?php echo $row["yr_desc"]?></td>
                                <td><?php echo $row["course_code"]?></td>
                                <td>
                       

                                    <form action="functions/sub-add.inc.php" method="post" style="float: left">
                                
                                    <button type="submit" name="submit" class="btn btn-success btn-sm" style="margin: 3px 11px -12px 0;" value="<?php echo $sid?>"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
                                    </form>
                                    <!-- <a href="#edit_< ?php echo $row['s_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editStudentModal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <a href="#delete_< ?php echo $row['s_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Delete</a> -->
                                </td>
                                <?php include('../modals/edit-student.modal.php'); ?>
                                <!-- < ?php include('../modals/user_edit_delete_modal.php'); ?> -->
                            </tr>
                            <?php 
                        }
                    }
                    catch(PDOException $e){
                        echo "There is some problem in connection: " . $e->getMessage();
                    }

                    //close connection
                    $database->close();

                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Day</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Section</th>
                    <th>Action</th>
                    </tr>
                </thead>
               
                <tbody>
                <?php
                    //include our connection

                    // if(isset($_SESSION['s_id'])){

                        
                    //     $sec = $_SESSION['sec_id'];
                    //     $sid = $_SESSION['s_id'];
                    //     $year = $_SESSION['yr_id'];
                    //     $dept = $_SESSION['dept_id'];

                    // }else{
                    //     $sid=0;
                    // }
        
                
                    // if(isset($_POST['submit'])){
                    //     $sid = $_POST['submit'];
                    // }else{
                    //     $sid=0;
                    // }
        
                    



                    $database = new Connection();
                    $db = $database->open();
                    try{	
                        $sql = "SELECT * FROM tbl_stsub
                        INNER JOIN tbl_students
                        ON tbl_enrollees.s_id = tbl_students.s_id
                        INNER JOIN tbl_section
                        ON tbl_enrollees.sec_id = tbl_section.sec_id";
                        foreach ($db->query($sql) as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row["sbj_code"]?></td>
                                <td><?php echo $row["sbj_desc"]?></td>
                                <td><?php echo $row["day_desc"]?></td>
                                <td><?php echo date('h:i A', strtotime($row['start_time']))?></td>
                                <td><?php echo date('h:i A', strtotime($row['end_time']))?></td>
                                <td><?php echo $row["sec_desc"]?></td>
                                <td>
                       

                                    <form action="functions/sub-add.inc.php" method="post" style="float: left">
                                    <button type="submit" name="submit" class="btn btn-success btn-sm" style="margin: 0 11px 0 0;" value="<?php echo $row["s_id"]?>"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
                                    </form>
                                    <!-- <a href="#edit_< ?php echo $row['s_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editStudentModal"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <a href="#delete_< ?php echo $row['s_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Delete</a> -->
                                </td>
                                <?php include('../modals/edit-student.modal.php'); ?>
                                <!-- < ?php include('../modals/user_edit_delete_modal.php'); ?> -->
                            </tr>
                            <?php 
                        }
                    }
                    catch(PDOException $e){
                        echo "There is some problem in connection: " . $e->getMessage();
                    }

                    //close connection
                    $database->close();

                ?>
                    
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>


    


    </div>

    <!-- /.container-fluid -->



<?php
include_once '../templates/footer.php';
?>