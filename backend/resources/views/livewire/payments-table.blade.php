<div class="table-responsive">
    <div class="d-flex justify-content-between">

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
                <th>Trxt_Id</th>
                <th>Seller</th>
                <th>Buyer</th>
                <th>Order No</th>
                <th>Type</th>
                <th>Currency</th>
                <th>Amount</th>
                <th>Brand</th>
                <th>Card</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td> {{$payment->txn_id }}</td>
                    <td> {{$payment->seller->name }}</td>
                    <td> {{$payment->buyer->name }}</td>
                    <td> {{$payment->orderNo }}</td>
                    <td> {{$payment->type }}</td>
                    <td> {{$payment->currency }}</td>
                    <td> {{$payment->amount }}</td>
                    <td> {{$payment->brand }}</td>
                    <td> {{$payment->last4 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$payments->links() }}
</div>

