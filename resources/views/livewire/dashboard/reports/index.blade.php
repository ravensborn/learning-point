<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Overview
                    </h2>
                </div>

            </div>
        </div>
    </div>


    <div class="page-body">
        <div class="container-xl">

            <hr>
            <h4>General</h4>
            <div wire:loading wire:target="loadCards">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="row" wire:init="loadCards">
                @foreach($cards as $card)
                    <div class="col-md-3 col-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body  d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-clipboard-data"></i>
                                    {{ $card['title'] }}
                                </div>
                                <div>
                                    {{ $card['data'] }}
                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach
            </div>



        </div>
    </div>


</div>
