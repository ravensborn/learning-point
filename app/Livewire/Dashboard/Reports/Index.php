<?php

namespace App\Livewire\Dashboard\Reports;

use App\Models\Employee;
use App\Models\Family;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    public array $cards;
    public array $sessionCards;

    public function loadCards(): void
    {
        $this->cards = [
            [
                'title' => 'System Users',
                'data' => User::count(),
            ],
            [
                'title' => 'Students',
                'data' => Student::count(),
            ],
            [
                'title' => 'Teachers',
                'data' => Teacher::count(),
            ],
            [
                'title' => 'Employees',
                'data' => Employee::count(),
            ],
            [
                'title' => 'Schools',
                'data' => Subject::count(),
            ],
            [
                'title' => 'Subjects',
                'data' => Subject::count(),
            ],
            [
                'title' => 'Families',
                'data' => Family::count(),
            ]
        ];
    }
    public function loadSessionCards(): void
    {
        $this->sessionCards = [
            [
                'title' => 'Total',
                'data' => Session::count(),
            ],
        ];

        foreach (Session::STATUSES as $key => $status) {
            $this->sessionCards[] = [
                'title' => $status,
                'data' => Session::where('status', $key)->count(),
            ];
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.reports.index');
    }
}
