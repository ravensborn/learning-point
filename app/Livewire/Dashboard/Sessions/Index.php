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

    public string $selectedStatus = 'all';

    public bool $showToday = false;

    public function toggleTodayFilter(): void
    {
        $this->showToday = !$this->showToday;
    }

    public function selectStatus($status): void
    {
        if (array_key_exists($status, Session::STATUSES) || $status == 'all') {
            $this->selectedStatus = $status;
        }

    }

    public function mount()
    {

    }

    public array $statisticsCards;

    public function calculateStatistics(): void
    {

        $this->statisticsCards[] = [
            'name' => 'Total',
            'total' => Session::count(),
            'today' => Session::whereDate('created_at', Carbon::today())->count(),
            'class' => 'bg-primary',
            'filter_key' => 'all',
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
                'class' => Session::STATUS_COLOR_CLASSES[$key],
                'filter_key' => $key,
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

        if (array_key_exists($this->selectedStatus, Session::STATUSES)) {
            $sessions->where('status', $this->selectedStatus);
        }

        if($this->showToday) {
            $sessions->whereDate('created_at', Carbon::today());
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
