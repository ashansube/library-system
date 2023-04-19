<?php

namespace App\Http\Livewire\Frontend\Readlist;

use Livewire\Component;
use App\Models\Readlist;
use Illuminate\Support\Facades\Auth;

class ReadlistCount extends Component
{
    public $readlistCount;

    protected $listeners = ['ReadlistAddedUpdated' => 'checkReadlistCount'];

    public function checkReadlistCount()
    {
        if(Auth::check()){
            return $this->readlistCount = Readlist::where('user_id', auth()->user()->id)->count();
        }else{
            return $this->readlistCount = 0;
        }
    }

    public function render()
    {
        $this->readlistCount = $this->checkReadlistCount();
        return view('livewire.frontend.readlist.readlist-count', [
            'readlistCount' => $this->readlistCount
        ]);
    }
}
