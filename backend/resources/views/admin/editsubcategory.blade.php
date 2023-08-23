<div class="modal fade" id="subcategoryupdateModel" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="updatesubCategory" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" required id="subcategory_id" name="id"
                    aria-describedby="emailHelp">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" required id="sub_name" name="name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Category Name</label>
                        <select class="form-select form-select-sm" id="category_id" required name="category_id"
                            aria-label=".form-select-sm example">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" required class="form-label">Image</label>
                        <input type="file" class="form-control" name="file" id="">
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

<script>
    function updatesubCategory(id) {
        fetch('updatesubCategory?' + new URLSearchParams({
                subcategory_id: id,
            }))
            .then(response => response.json())
            .then(response => {

                const categories=response.categories;
                const subcat= response.subcategory;
                console.log(response);
                document.querySelector('#sub_name').value = subcat.title;

                categories.forEach(category => {
                    $('#category_id').append(`<option value="${category.id}" ${category.id == subcat.category_id && 'selected'}>${category.title}</option>`);
                });
                document.querySelector('#subcategory_id').value = subcat.id;
            });
        $('#subcategoryupdateModel').modal('show');
    }
</script>
