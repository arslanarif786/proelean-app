<div class="modal fade" id="categoryupdateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="updateCategory" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <input type="hidden" class="form-control" required id="category_id" name="id" aria-describedby="emailHelp">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" required id="cat_name" name="title" aria-describedby="emailHelp">
            </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" required   class="form-label">Image</label>
                <input type="file" class="form-control"  name="file" id="exampleInputPassword1">
              </div>

              <div class="mb-3">
                <label for="exampleFormControlTextarea1"  class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
<script>
    function updateCategory(id) {

fetch('updateCategory?' + new URLSearchParams({
        category_id: id,
    }))
    .then(response => response.json())
    .then(response => {
        console.log(response);
        document.getElementById("cat_name").value =response[0].title;
        document.getElementById("description").value =response[0].description;
        document.getElementById("category_id").value =response[0].id;

    });
$('#categoryupdateModel').modal('show');

}
</script>
