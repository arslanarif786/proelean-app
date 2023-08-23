<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public string $searchQuery= '';

    public function render()
    {
        $isFreelancer = request()->route()->uri == 'buyers' ? 0 : 1;
        $users=User::select('id','name','username','email','isFreelancer','availabe_balance','address', 'image')
            ->where('isFreelancer',$isFreelancer)
            ->when($this->searchQuery, fn ($q) =>
                $q->where('name','like', "%$this->searchQuery%")
            )->paginate(15);
        return view('livewire.user-table')->with(['users' => $users]);
    }
}
