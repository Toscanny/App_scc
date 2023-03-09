<?php
include_once '../templates/header.php';
include_once '../includes/connect.php';
include_once '../includes/connection.php';
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Grade Table</h1>
                        <a href="../upload/upload.student.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Upload Data</a>
                    </div>

                    <!-- Page Heading -->
                
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Student Id</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Student Id</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        //include our connection
                                    
                                        $database = new Connection();
                                        $db = $database->open();
                                        try{	
                                            $sql = 'SELECT * FROM tbl_students
                                                    INNER JOIN tbl_course
                                                    ON tbl_students.course_id = tbl_course.course_id';
                                            foreach ($db->query($sql) as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row["s_id"]?></td>
                                                    <td><?php echo $row["s_name"]?></td>
                                                    <td><?php echo $row["s_gender"]?></td>
                                                    <td>
                                                    <a href="#edit_<?php echo $row['s_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal">Edit</a>
                                                        
                                                        
                                                        
                                                        

                                                        <form action="enrollment-details.php" method="post" style="float: left">

                                                        <input type="hidden" name="dept" value="<?php echo $row["course_id"]?>">
                                                        <input type="hidden" name="sid" value="<?php echo $row["s_id"]?>">
                                                    
                                                        <button type="submit" name="submit" class="btn btn-danger btn-sm" style="margin: 0 11px 0 0;" value="<?php echo $row["s_id"]?>">Enroll</button>
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
                <!-- /.container-fluid -->s

<?php
include_once("../modals/edit-student.modal.php");
include_once '../templates/footer.php';
?>
