<?php

namespace App\Http\Livewire\Admin\Publisher;

use App\Models\Publisher;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $publisher_id;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->publisher_id = NULL;
    }

    public function storePublisher()
    {
        $validatedData = $this->validate();
        Publisher::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Publisher Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editPublisher(int $publisher_id)
    {
        $this->publisher_id = $publisher_id;
        $publisher = Publisher::findOrFail($publisher_id);
        $this->name = $publisher->name;
        $this->slug = $publisher->slug;
        $this->status = $publisher->status;
    }

    public function updatePublisher()
    {
        $validatedData = $this->validate();
        Publisher::findOrFail($this->publisher_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Publisher Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deletePublisher($publisher_id)
    {
        $this->publisher_id = $publisher_id;
    }

    public function destroyPublisher()
    {
        Publisher::findOrFail($this->publisher_id)->delete();
        session()->flash('message', 'Publisher Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $publishers = Publisher::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.publisher.index', ['publishers' => $publishers])
                    ->extends('layouts.admin')
                    ->section('content');
    }
}
