<?php

namespace App\Livewire\Teachers\Dashboard\Sessions;

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

    public bool $showToday = false;

    public function toggleTodayFilter(): void
    {
        $this->showToday = !$this->showToday;
    }

    public function mount()
    {

    }

    #[Layout('layouts.teachers-dashboard')]
    public function render()
    {
        $sessions = Session::query()
            ->whereHas('teacher', function ($query) {
                $query->where('id', auth()->guard('teacher')->user()->id);
            })
            ->orderBy('id', 'desc');

        if ($this->search) {
            $search = trim($this->search);
            $this->resetPage();

            $sessions->whereHas('subject', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->orWhereHas('attendees', function ($query) use ($search) {
                $query->whereHas('student', function ($q) use ($search) {

                    $q->whereRaw("concat(trim(first_name), ' ', trim(middle_name), ' ', trim(last_name)) like ?", ["%{$search}%"]);
                });
            });
        }

        if ($this->showToday) {
            $sessions->whereDate('created_at', Carbon::today());
        }

        $sessions = $sessions->paginate($this->perPage);

        return view('livewire.teachers.dashboard.sessions.index', [
            'sessions' => $sessions
        ]);
    }

}
