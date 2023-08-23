<div class="table-responsive">
    <div class="d-flex justify-content-between">
                @if (session()->has('message'))
                <div class="alert alert-primary">{{ session()->get('message') }}</div>
                @endif

        <div class="input-group mb-3" style="max-width:250px">
            <span class="input-group-text" id="basic-addon1"><i class="uil-search"></i></span>
            <input wire:model.debounce.500ms="searchQuery" type="text" class="form-control" placeholder="Search..."
                aria-label="Username" aria-describedby="basic-addon1">
        </div>

    </div>
    <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap"
        id="products-datatable_old">
        <thead class="table-light">
            <tr>

                <th>Name</th>
                <th>Status</th>
                <th>Balance</th>
                <th>Amount</th>
                <th style="width: 75px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdrawalrequests as $withdrawalrequest)
                <tr>
                    <td> {{ $withdrawalrequest->username }}</td>
                    <td> {{ $withdrawalrequest->status }}  </td>
                    <td> {{ $withdrawalrequest->availabe_balance }} </td>
                    <td>{{ $withdrawalrequest->amount }} </td>
                    <td>
                        <button type="button" class="btn btn-primary">Approved</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $withdrawalrequests->links() }}
</div>
@include('admin.adduser')
@include('admin.edituser')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
@if (count($errors) > 0)

$(document).ready(function(){

 $('#userAddModel').modal('show');

});
@endif

function updateUser(id) {

fetch('updateUser?' + new URLSearchParams({
    user_id: id,
    }))
    .then(response => response.json())
    .then(response => {
        console.log(response);
        document.getElementById("name").value =response[0].name;
        document.getElementById("username").value =response[0].username;
        document.getElementById("email").value =response[0].email;
        document.getElementById("address").value =response[0].address;
        document.getElementById("user_id").value =response[0].id;

    });
$('#userupdateModel').modal('show');

}
</script>
