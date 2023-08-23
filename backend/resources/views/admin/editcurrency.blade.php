<div class="modal fade" id="currencyupdateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Currency</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="updateCurrency" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" required id="id" name="id" aria-describedby="emailHelp">
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Currency Name</label>
                <input type="text" class="form-control" required id="cname" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Currency Short Name</label>
                <input type="text" class="form-control" required id="s_name" name="s_name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Currency Symbol</label>
                <input type="text" class="form-control" required id="symbol" name="symbol" aria-describedby="emailHelp">
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
      function updateCurrency(id) {

fetch('updateCurrency?' + new URLSearchParams({
        currency_id: id,
    }))
    .then(response => response.json())
    .then(response => {
        console.log(response);
        document.getElementById("symbol").value =response[0].currency;
        document.getElementById("cname").value =response[0].name;
        document.getElementById("s_name").value =response[0].s_name;
        document.getElementById("id").value =response[0].id;

    });
$('#currencyupdateModel').modal('show');

}
  </script>
