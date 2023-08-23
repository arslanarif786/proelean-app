<div class="modal fade" id="languageupdateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Language</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="updatelanguage" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" required id="language_id" name="id" aria-describedby="emailHelp">
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Language Name</label>
                <input type="text" class="form-control" required id="l_name" name="name" aria-describedby="emailHelp">
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
      function updateLanguage(id) {

fetch('updatelanguage?' + new URLSearchParams({
        language_id: id,
    }))
    .then(response => response.json())
    .then(response => {
        console.log(response);
        document.getElementById("l_name").value =response[0].language;
        document.getElementById("language_id").value =response[0].id;

    });
$('#languageupdateModel').modal('show');

}
  </script>
