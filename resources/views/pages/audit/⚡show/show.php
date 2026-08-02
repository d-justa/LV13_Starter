<?php

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

new class extends Component
{
    public Activity $activity;

    public function mount(Activity $activity)
    {
        $this->activity = $activity;
    }
};