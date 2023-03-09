<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="modal/function/add.php" method="post">

      <div class="modal-body">

      <div class="mb-3">
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
    </div>

    <div class="mb-3">
     <label for="exampleFormControlInput1" class="form-label">discount</label>
    <input type="number" class="form-control"  name="discount">
    </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name ="submit">Save </button>
      </div>
      </div>
      
    </form>
    
  </div>
</div>
