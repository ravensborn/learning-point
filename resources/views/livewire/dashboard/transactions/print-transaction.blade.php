<div>
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h3>
                           Print Transaction
                        </h3>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"/>
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"/>
                                <path
                                    d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"/>
                            </svg>
                            Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-start">
                                <div>
                                    <p class="h2">Learning Point</p>
                                    <address>
                                        <span class="fw-bold">E-Mail:</span> info@learning-point.krd
                                        <br>
                                        <span
                                            class="fw-bold">Phone No.:</span> +964 750 421 3511
                                        <br>
                                        <span
                                            class="fw-bold">Address:</span> KRI, Erbil, Dream City
                                    </address>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div>
                                    <p class="h2">{{ $name }}</p>
                                    <address>
                                        <span class="fw-bold">E-Mail:</span> {{ $email ?? '' }}
                                        <br>
                                        <span class="fw-bold">Phone No.:</span> {{ $phone ?? '' }}
                                        <br>
                                        <span class="fw-bold">Address:</span> {{ $address ?? '' }}
                                    </address>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <img src="{{ asset('images/logo.png') }}"
                                     class="mb-2"
                                     style="width: 42px; height: auto;"
                                     alt="Invoice Logo">
                                <p class="fw-bold mb-0">{{ $transaction->number }}</p>
                                <div>{{ $transaction->created_at->format('Y-m-d / h:i A') }}</div>
                            </div>

                        </div>
                        <table class="table table-transparent table-responsive">
                            <thead>
                            <tr>
                                <th>Series</th>
                                <th class="text-center" style="width: 1%">Action</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center" style="width: 1%">Current Wallet</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>
                                    <p class="strong mb-1">{{ $transaction->number }}</p>
                                </td>
                                <td>{{ $transaction->type_name }}</td>
                                <td class="{{ $transaction->type_color_class }} text-center">
                                    {{ $transaction->type_prefix_character }}
                                    ${{ number_format($transaction->amount, 2) }}
                                </td>
                                <td @class(['text-danger' => ($wallet < 0), 'text-center' => true])>${{ number_format($wallet, 2) }}</td>
                            </tr>

                        </table>
                        <p class="text-muted text-center mt-5">Thank you. If you have any questions or need assistance, feel free to reach out to the learning point's support desk. Happy learning!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
