<div class="table-responsive">
    <div class="d-flex justify-content-between">

        <button class="my-auto btn btn-danger mb-3 text-center" data-bs-toggle="modal" data-bs-target="#userAddModel"><i
                class="mdi mdi-plus-circle me-2 "></i> Add User</button>
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
                <th>User Name</th>
                <th>Email</th>
                <th>Balance</th>
                <th>User Type</th>
                <th>Adress</th>
                <th style="width: 75px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="table-user">
                        <img src="{{$user->image ?: 'assets/admin/images/users/avatar-4.jpg' }}" alt="table-user"
                            class="me-2 rounded-circle">
                        <a href="javascript:void(0);" class="text-body fw-semibold"> {{ $user->name }}</a>
                    </td>
                    <td> {{ $user->username }}</td>
                    <td> {{ $user->email }}  </td>
                    <td> {{ $user->availabe_balance }} </td>
                    <td>{{ $user->isFreelancer ? 'Seller' : 'Buyer' }} </td>
                    <td>{{ $user->address}} </td>

                    <td>
                        <a onclick="updateUser({{ $user->id }})" class="action-icon"> <i
                            class="mdi mdi-square-edit-outline"></i></a>
                        <a href="deleteUser?user_id={{CustomEncrypt($user->id)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
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
</script>
