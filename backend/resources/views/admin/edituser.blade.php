<div class="modal fade" id="userupdateModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        @if ($errors->any())

                <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="updateUser">
            @csrf
        <div class="modal-body">
            <input type="hidden" name="user_id" id="user_id">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                <input type="text" class="form-control" required id="full_name" name="name" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">User Name</label>
                <input type="text" class="form-control" required id="username" name="username" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" required id="email" name="email" aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Adress</label>
                <input type="text" class="form-control" required id="address" name="address" aria-describedby="emailHelp">
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  <script>
  function updateUser(id) {

    fetch('updateUser?' + new URLSearchParams({
        user_id: id,
        }))
        .then(response => response.json())
        .then(response => {
            console.log(response);
            document.getElementById("full_name").value =response[0].name;
            document.getElementById("username").value =response[0].username;
            document.getElementById("email").value =response[0].email;
            document.getElementById("address").value =response[0].address;
            document.getElementById("user_id").value =response[0].id;

        });
    $('#userupdateModel').modal('show');

    }
    </script>
