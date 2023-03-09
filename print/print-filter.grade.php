<?php
include_once '../templates/header.php';

var_dump($_POST);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


            <script>
            $(document).ready(function(){
                $('#instructor').on('change', function(){
                    var instructorID = $(this).val();
                    if(instructorID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'instructor_id='+instructorID,
                            success:function(html){
                                $('#subject').html(html);
                                $('#year').html('<option value="">Select subject first</option>'); 
                            }
                        }); 
                    }else{
                        $('#subject').html('<option value="">Select instructor first</option>');
                        $('#year').html('<option value="">Select subject first</option>'); 
                    }
                });
                
                $('#subject').on('change', function(){
                    var subjectID = $(this).val();
                    if(subjectID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'subject_id='+subjectID,
                            success:function(html){
                                $('#year').html(html);
                            }
                        }); 
                    }else{
                        $('#subject').html('<option value="">Select instructor first</option>'); 
                    }
                });

                $('#year').on('change', function(){
                    var yearID = $(this).val();
                    if(yearID){
                        $.ajax({
                            type:'POST',
                            url:'ajaxData.php',
                            data:'year_id='+yearID,
                            success:function(html){
                                $('#section').html(html);
                            }
                        }); 
                    }else{
                        $('#section').html('<option value="">Select year first</option>'); 
                    }
                });
            });
            </script>
    

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Grade Print Filter </h1>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                        <form action="../admin/grade.print.php" method="post">

                            <div class="modal-body">


                                <?php

                                    include "../includes/connect.php"; // Database connection using PDO
                                    //$sql="SELECT name,id FROM student"; 
                                    $sql="SELECT * FROM tbl_sy"; 
                                    echo "<label for='exampleFormControlInput1' class='form-label'>School Year</label>";
                                    /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
                                    echo "<select name=sy value='' class='form-control'>School Year</option>"; // list box select command
                                    foreach ($conn->query($sql) as $row){//Array or records stored in $row
                                    echo "<option value=$row[sy_id]>$row[sy_desc]</option>"; 
                                    /* Option values are added by looping through the array */ 
                                    }
                                    echo "</select>";// Closing of list box

                                ?>
                                <br/>

                                <?php

                                    include "../includes/connect.php"; // Database connection using PDO
                                    //$sql="SELECT name,id FROM student"; 
                                    $sql="SELECT * FROM tbl_sem"; 
                                    echo "<label for='exampleFormControlInput1' class='form-label'>Semester</label>";
                                    /* You can add order by clause to the sql statement if the names are to be displayed in alphabetical order */
                                    echo "<select name=sem value='' class='form-control'>Semester</option>"; // list box select command
                                    foreach ($conn->query($sql) as $row){//Array or records stored in $row
                                    echo "<option value=$row[sem_id]>$row[sem_desc]</option>"; 
                                    /* Option values are added by looping through the array */ 
                                    }
                                    echo "</select>";// Closing of list box

                                ?>
                                <br/>

                                <?php 
                                    // Include the database config file 
                                    include_once '../includes/connects.php'; 
                                    
                                    // Fetch all the country data 
                                    $query = "SELECT * FROM tbl_instructor"; 
                                    $result = $db->query($query); 
                                ?>
                                <!-- Country dropdown -->
                                <label for='exampleFormControlInput1' class='form-label'>Instructor</label>
                                <select id="instructor" name="ins" class='form-control'>
                                    <option value="">Select Instructor</option>
                                    <?php 
                                        if($result->num_rows > 0){ 
                                            while($row = $result->fetch_assoc()){  
                                                echo '<option value="'.$row['ins_id'].'">'.$row['ins_name'].'</option>'; 
                                            } 
                                        }else{ 
                                            echo '<option value="">Instructor not found</option>'; 
                                        } 
                                        ?>
                                </select>
                                <br/>
                                <label for='exampleFormControlInput1' class='form-label'>Subject</label>
                                <select id="subject" name="subject" class='form-control'>
                                    <option value="">Select instructor first</option>
                                </select>
                                <br/>
                                <label for='exampleFormControlInput1' class='form-label'>Year Level</label>
                                <select id="year" name="year" class='form-control'>
                                    <option value="">Select subject first</option>
                                </select>
                                <br/>
                                <label for='exampleFormControlInput1' class='form-label'>Section</label>
                                <select id="section" name="sec" class='form-control'>
                                    <option value="">Select year first</option>
                                </select>
                                <br/>


                                <div id='table-grade'>


                                </div>

                               
                                <br/>




                        
                                <!-- <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                    <input type="text" class="form-control"  name ="name" >
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">quantity</label>
                                    <input type="number" class="form-control" name="quantity" >
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Unit</label>
                                    <input type="text" class="form-control"  name="unit">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Price</label>
                                    <input type="number" class="form-control"  name ="price">
                                </div> -->

                            </div>
                            <div class="modal-footer">
                            <a href="../admin/grade-table.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                <button type="submit" class="btn btn-primary" name ="submit">Import </button>
                            </div>
                        </form>
                </div>
            </div>

    </div>
    <!-- /.container-fluid -->

<?php
include_once '../templates/footer.php';
?>
