<div class="table-responsive">
    <div class="d-flex justify-content-between">


        <button class="my-auto btn btn-danger mb-3 text-center" data-bs-toggle="modal"
            data-bs-target="#subcategoryAddModel"><i class="mdi mdi-plus-circle me-2 "></i> Add SubCategory</button>

        @if (session()->has('message'))
            <div class="alert alert-primary">{{ session()->get('message') }}</div>
        @endif

        <div class="input-group mb-3" style="max-width:250px">
            <span class="input-group-text" id="basic-addon1"><i class="uil-search"></i></span>
            <input id="searchInput"  type="text" class="form-control" placeholder="Search..."
                aria-label="Username" aria-describedby="basic-addon1">
        </div>

    </div>
    <table id="basic-datatable" class="table dt-responsive nowrap w-100">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Category Name</th>
                <th>Sub Category Name</th>
                <th style="width: 75px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sub_categories as $sub_category)
                <tr class="bodytrow">
                    <td class="table-user">
                        <img src="{{ $sub_category->image}}" alt="table-user"
                            class="me-2 rounded-circle">
                    </td>
                    <td class="table-user">
                        {{ $sub_category->category_name }}
                    </td>
                    <td> {{ $sub_category->title }}</td>
                    <td>
                        <a onclick="updatesubCategory({{$sub_category->ID }})" class="action-icon"> <i
                            class="mdi mdi-square-edit-outline"></i></a>
                        <a href="deleteSubCategory?id={{CustomEncrypt($sub_category->ID)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.addsubcategory')

@include('admin.editsubcategory')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
@if (count($errors) > 0)

$(document).ready(function(){

 $('#subcategoryAddModel').modal('show');

});
@endif



const searchInput = document.querySelector('#searchInput');
searchInput.addEventListener('input', () => {
    const searchQuery = searchInput.value.toLowerCase();

    const tableRows= document.querySelectorAll('.bodytrow');
    for(let i=0;i<tableRows.length;i++){

        const tds= tableRows[i].querySelectorAll('td');
        let textFound= false;
        for(let j=0;j<tds.length;j++){
            if(tds[j].innerText.toLowerCase().includes(searchQuery)){
                textFound=true;
            }
        }
        tableRows[i].style.display = textFound ? '' : 'none';
    }
});

</script>
