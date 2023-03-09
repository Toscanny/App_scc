<?php
include_once '../templates/header.php';
include "../includes/connect.php";
include "../includes/connection.php";

?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add Schedule</h1>

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
                    </div>

                        <form action="functions/add-subject.inc.php" method="post">
                        <!-- <form action="functions/add-sched.inc.php" method="post"> -->

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Course Code</label>
                                    <input type="text" class="form-control"  name ="code" required>
                                </div>
                                <br/>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                                    <input type="text" class="form-control"  name ="desc" required>
                                </div>
                                <br/>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Lab-Units</label>
                                    <input type="number" class="form-control"  name ="lab" required>
                                </div>
                                <br/>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Lec-Units</label>
                                    <input type="text" class="form-control"  name ="lec" required>
                                </div>
                                <br/>

                            </div>
                            <div class="modal-footer">
                            <a href="../admin/subject-table.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
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
