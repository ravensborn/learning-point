<div>
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Dashboard
                    </div>
                    <h2 class="page-title">
                        System Settings
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Session Settings
                        </div>
                        <div class="card-body">

                            @if($sessionSaveMessage)
                                <div class="mb-3">
                                    <div class="alert alert-success">
                                        {{ $sessionSaveMessage }}
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="sessionSettingsCancellationChargeLimit" class="form-label">Session
                                    Cancellation Charge Limit</label>
                                <input type="text"
                                       id="sessionSettingsCancellationChargeLimit"
                                       wire:model.live="sessionSettingsCancellationChargeLimit"
                                       class="form-control" placeholder="50">
                                @error('sessionSettingsCancellationChargeLimit')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
