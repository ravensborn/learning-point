<?php

namespace App\Livewire\Dashboard\Settings;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{

    public $settings;

    public string $sessionSaveMessage = '';
    public string $sessionSettingsCancellationChargeLimit;

    public function updatedSessionSettingsCancellationChargeLimit(): void
    {
        $this->validate([
            'sessionSettingsCancellationChargeLimit' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
        ]);

        $this->settings->update([
            'maximum_session_cancellation_charge_limit' => $this->sessionSettingsCancellationChargeLimit,
        ]);

        $this->sessionSaveMessage = 'Successfully saved session settings';
    }

    public function loadSettings(): void
    {
        $this->settings = Setting::find(1);

        $this->sessionSettingsCancellationChargeLimit = $this->settings->maximum_session_cancellation_charge_limit;
    }

    public function mount(): void
    {
        $this->loadSettings();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.settings.Index');
    }
}
