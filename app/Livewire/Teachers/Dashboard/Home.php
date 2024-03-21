<?php

namespace App\Livewire\Teachers\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{

    #[Layout('layouts.teachers-dashboard')]
    public function render()
    {
        return view('livewire.teachers.dashboard.home');
    }
}
