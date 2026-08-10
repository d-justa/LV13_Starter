<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public $user;

    public $perPage = 10;
    public $status = "all";
    public $search = '';

    public function mount()
    {
        $this->user = Auth::user();
    }

    #[Computed()]
    public function notifications()
    {
        $query = $this->getBaseQuery();

        return $query->take($this->perPage)->get();
    }

    #[Computed()]
    public function totalCount()
    {
        $query = $this->getBaseQuery();

         return $query->count();
    }

    private function getBaseQuery()
    {
        $query = $this->user->notifications()->latest();

        if ($this->status === "read") {
            $query->whereNotNull('read_at');
        }

        if ($this->status === "unread") {
            $query->whereNull('read_at');
        }

        // Search in title & message (JSON column)
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('data->title', 'like', '%' . $this->search . '%')
                    ->orWhere('data->description', 'like', '%' . $this->search . '%');
            });
        }

        return $query;
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function markAsRead($id)
    {
        $this->user->notifications()->findOrFail($id)->markAsRead();
    }
};