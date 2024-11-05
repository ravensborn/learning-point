<?php

namespace App\Livewire\Teachers\Dashboard;

use App\Mail\TeacherLoginCode;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{

    public bool $codeSent = false;
    public string $email = '';
    public string $loginCode = '';
    public string $generatedCode = '';
    public int $attempts = 0;
    public $codeSentDate;
    public bool $invalidPage = false;
    public bool $somethingWentWrong = false;

    public function sendCode(): void
    {
        if ($this->isPageValid()) {

            $this->email = trim($this->email);

            $this->validate([
                'email' => ['required', 'string', 'email', 'max:60', 'exists:teachers,email']
            ]);

            if (!$this->generatedCode) {
                $this->generateCode();
            }

            if ($this->sendCodeToEmail($this->email)) {
                $this->resetValidation();
                $this->codeSent = true;
            };
        }

    }

    public function sendCodeToEmail($email): true
    {
        //Mail::to($email)->send(new TeacherLoginCode($this->generatedCode));
        $this->codeSentDate = now();
        return true;
    }

    public function validateLogin(): void
    {

        if ($this->isPageValid()) {

            $this->validate([
                'loginCode' => ['required', 'string', 'max:60']
            ]);

            if ($this->loginCode == $this->generatedCode) {

                $teacher = Teacher::where('email', $this->email)->first();

                if ($teacher) {
                    Auth::guard('teacher')
                        ->login($teacher, true);
                    $this->redirectRoute('teacher.dashboard.home');
                } else {
                    $this->somethingWentWrong = true;
                }

            } else {
                $this->attempts++;
                $this->addError('loginCode', 'Invalid login code provided, allowed number of tries: ' . $this->attempts . ' / 5.');
            }

        }
    }

    private function generateCode(): void
    {
        $this->generatedCode = rand(10000, 99999);
    }

    private function isPageValid(): bool
    {
        return !($this->attempts >= 5 || now()->diffInMinutes($this->codeSentDate) > 5);
    }

    public function mount(): void
    {

        //DELETE THIS LINE
//        Auth::guard('teacher')
//            ->login(Teacher::first(), true);

        if(\auth()->guard('teacher')->check()) {
            $this->redirectRoute('teacher.dashboard.home');
        }
        $this->codeSentDate = now();

    }

    #[Layout('layouts.teachers-auth')]
    public function render()
    {
        if (!$this->isPageValid()) {
            $this->invalidPage = true;
        }

        return view('livewire.teachers.dashboard.login');
    }
}
