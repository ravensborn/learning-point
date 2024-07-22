<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PrintSession extends Component
{

    public $session;


    public function mount(Session $session): void
    {
        $this->session = $session;

    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.sessions.print-session');
    }

}
