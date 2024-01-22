<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Session;
use App\Traits\SessionModalFunctions;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, SessionModalFunctions;


    public int $perPage = 10;
    public string $search = '';

    public function mount() {

    }

    public array $statisticsCards;
    public function calculateStatistics(): void
    {

        $this->statisticsCards[] = [
            'name' => 'Total',
            'total' => Session::count(),
            'today' => Session::whereDate('created_at', Carbon::today())->count(),
            'class' => 'bg-primary',
        ];

      foreach (Session::STATUSES as $key => $name) {

          $total = Session::where('status', $key)->count();
          $today = Session::where('status', $key)
              ->whereDate('created_at', Carbon::today())
              ->count();

          $this->statisticsCards[] = [
              'name' => $name,
              'total' => $total,
              'today' => $today,
              'class' => Session::STATUS_COLOR_CLASSES[$key]
          ];
      }

    }


    #[Layout('layouts.app')]
    public function render()
    {
        $sessions = Session::query()->orderBy('created_at', 'desc');

        if ($this->search) {

            $this->resetPage();
            $sessions->whereHas('teacher', function ($query) {
                $query->where('name', 'LIKE', '%' . trim($this->search) . '%');
            })->orWhereHas('subject', function ($query) {
                $query->where('name', 'LIKE', '%' . trim($this->search) . '%');
            });
        }

        $sessions = $sessions->paginate($this->perPage);

        return view('livewire.dashboard.sessions.index', [
            'sessions' => $sessions
        ]);
    }


//    public function update(): void
//    {
//
//        $this->form->update();
//
//        $this->dispatch('toggle-modal-edit');
//    }
//
//    public function store(): void
//    {
//        $this->form->store();
//
//        $this->dispatch('toggle-modal-create');
//    }
}
