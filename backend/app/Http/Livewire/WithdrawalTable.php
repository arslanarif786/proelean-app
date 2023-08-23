<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\WithdrawalRequest;
use Livewire\Component;

class WithdrawalTable extends Component
{
    public string $searchQuery= '';

    public function render()
    {
        $withdrawalrequests=WithdrawalRequest::join('users','users.id','withdrawal_requests.user_id')->where('status','PENDING')->paginate(20);
        return view('livewire.withdrawal-table')->with(['withdrawalrequests' => $withdrawalrequests]);
    }
}
