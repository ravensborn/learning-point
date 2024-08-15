<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Models\Session;
use App\Models\Student;
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
    public string $sessionType = 'all';

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


    public string $sort_default_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-numbers" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 6h9" /><path d="M11 12h9" /><path d="M12 18h8" /><path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" /><path d="M6 10v-6l-2 2" /></svg>';
    public string $sort_asc_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-ascending" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l7 0" /><path d="M4 12l7 0" /><path d="M4 18l9 0" /><path d="M15 9l3 -3l3 3" /><path d="M18 6l0 12" /></svg>';
    public string $sort_desc_icon = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-sort-descending" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 6l9 0" /><path d="M4 12l7 0" /><path d="M4 18l7 0" /><path d="M15 15l3 3l3 -3" /><path d="M18 6l0 12" /></svg>';

    public array $sortedColumns = [
        'id' => 'desc',
    ];

    public function getHeaderSortIcon($column): string
    {
        $direction = $this->sortedColumns[$column];

        switch ($direction) {
            case 'default':
                return $this->sort_default_icon;
            case 'asc':
                return $this->sort_asc_icon;
            case 'desc':
                return $this->sort_desc_icon;

        }
    }

    public function sortByColumn($column): void
    {
        $direction = $this->sortedColumns[$column];

        if ($direction == 'default') {
            $this->sortedColumns[$column] = 'asc';
        }

        if ($direction == 'asc') {
            $this->sortedColumns[$column] = 'desc';
        }

        if ($direction == 'desc') {
            $this->sortedColumns[$column] = 'default';
        }

    }

    public array $statisticsCards;

    public function calculateStatistics(): void
    {

        $this->statisticsCards[] = [
            'name' => 'Total',
            'total' => Session::count(),
            'today' => Session::whereDate('created_at', Carbon::today())->count(),
            'class' => 'bg-primary text-white',
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

    public function setStatus($sessionId, $status): void
    {
        if (in_array($status, array_keys(Session::STATUSES))) {
            $session = Session::findOrFail($sessionId);

            $session->update([
                'status' => $status
            ]);
        }
    }


    #[Layout('layouts.app')]
    public function render()
    {
        $sessions = Session::query();

        if (count($this->sortedColumns) > 0) {
            foreach ($this->sortedColumns as $column => $direction) {
                if ($direction != 'default') {
                    $sessions->orderBy($column, $direction);
                }
            }
        }

        if ($this->search) {

            $this->resetPage();

            $sessions->whereHas('teacher', function ($query) {
                $query->where('name', 'LIKE', '%' . trim($this->search) . '%');
            })->orWhereHas('subject', function ($query) {
                $query->where('name', 'LIKE', '%' . trim($this->search) . '%');
            })->orWhereHas('attendees', function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->search) . "%' ");
                });
            });
        }

        if ($this->sessionType == Session::TYPE_THEORETICAL || $this->sessionType == Session::TYPE_PRACTICAL) {
            $sessions->where('type', $this->sessionType);
        }

        if (array_key_exists($this->selectedStatus, Session::STATUSES)) {
            $sessions->where('status', $this->selectedStatus);
        }

        if ($this->showToday) {
            $sessions->whereDate('created_at', Carbon::today());
        }

        $sessions = $sessions->paginate($this->perPage);

        return view('livewire.dashboard.sessions.index', [
            'sessions' => $sessions
        ]);
    }

    public $peekSession = null;

    public function openShowSessionDetailsModal($id): void
    {
        $this->peekSession = Session::findOrFail($id);
        $this->dispatch('toggle-modal-show-session');
    }

    public function closeShowSessionModal(): void
    {
        $this->peekSession = null;
        $this->dispatch('close-all-modals');
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
