<div class="modal fade" id="subcategoryAddModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sub Category Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="addsubCategory" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">SubCategory Name</label>
                <input type="text" class="form-control" value="{{ old('name') }}" required id="exampleInputname" name="name" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">

              <label for="exampleInputPassword1"    class="form-label">Category Name</label>
              <select class="form-select form-select-sm" value="{{ old('category_id') }}" required name="category_id" aria-label=".form-select-sm example">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}">{{$category->title}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" required   class="form-label">Image</label>
                <input type="file" class="form-control" required name="file" id="exampleInputPassword1">
              </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
