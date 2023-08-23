<div class="table-responsive">
    <div class="d-flex justify-content-between">

        <button class="my-auto btn btn-danger mb-3 text-center" data-bs-toggle="modal"
            data-bs-target="#currencyAddModel"><i class="mdi mdi-plus-circle me-2 "></i> Add Currency</button>

        @if (session()->has('message'))
            <div class="alert alert-primary">{{ session()->get('message') }}</div>
        @endif


        <div class="input-group mb-3" style="max-width:250px">
            <span class="input-group-text" id="basic-addon1"><i class="uil-search"></i></span>
            <input id="searchInput"  type="text" class="form-control" placeholder="Search..."
                aria-label="Username" aria-describedby="basic-addon1">
        </div>

    </div>
    <table class="table table-centered table-borderless table-hover w-100 dt-responsive nowrap"
        id="products-datatable_old">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Short Name</th>
                <th>Symbol</th>
                <th style="width: 75px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($currencies as $currency)
                <tr class="bodytrow">
                    <td> {{ $currency->name }}</td>
                    <td> {{ $currency->s_name }}</td>
                    <td> {{ $currency->currency }}</td>
                    <td>
                        <a onclick="updateCurrency({{ $currency->id }})" class="action-icon"> <i
                            class="mdi mdi-square-edit-outline"></i></a>
                        <a href="deleteCurrency?currency_id={{CustomEncrypt($currency->id)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('admin.addcurrency')
@include('admin.editcurrency')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
@if (count($errors) > 0)

$(document).ready(function(){

 $('#currencyAddModel').modal('show');

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
