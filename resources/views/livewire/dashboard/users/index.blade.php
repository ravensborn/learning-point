<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Users
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-create">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            New User
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Invoices</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-secondary">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="8" size="3"
                                               aria-label="Invoices count">
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-secondary">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                               aria-label="Search invoice">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox"
                                                           aria-label="Select all invoices"></th>
                                    <th class="w-1">No.
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 15l6 -6l6 6"></path>
                                        </svg>
                                    </th>
                                    <th>Invoice Subject</th>
                                    <th>Client</th>
                                    <th>VAT No.</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001401</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                                    <td>
                                        <span class="flag flag-xs flag-country-us me-2"></span>
                                        Carlson Limited
                                    </td>
                                    <td>
                                        87956621
                                    </td>
                                    <td>
                                        15 Dec 2017
                                    </td>
                                    <td>
                                        <span class="badge bg-success me-1"></span> Paid
                                    </td>
                                    <td>$887</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001402</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">UX Wireframes</a></td>
                                    <td>
                                        <span class="flag flag-xs flag-country-gb me-2"></span>
                                        Adobe
                                    </td>
                                    <td>
                                        87956421
                                    </td>
                                    <td>
                                        12 Apr 2017
                                    </td>
                                    <td>
                                        <span class="badge bg-warning me-1"></span> Pending
                                    </td>
                                    <td>$1200</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001403</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">New Dashboard</a></td>
                                    <td>
                                        <span class="flag flag-xs flag-country-de me-2"></span>
                                        Bluewolf
                                    </td>
                                    <td>
                                        87952621
                                    </td>
                                    <td>
                                        23 Oct 2017
                                    </td>
                                    <td>
                                        <span class="badge bg-warning me-1"></span> Pending
                                    </td>
                                    <td>$534</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001404</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Landing Page</a></td>
                                    <td>
                                        <span class="flag flag-xs flag-country-br me-2"></span>
                                        Salesforce
                                    </td>
                                    <td>
                                        87953421
                                    </td>
                                    <td>
                                        2 Sep 2017
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary me-1"></span> Due in 2 Weeks
                                    </td>
                                    <td>$1500</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001405</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Marketing Templates</a>
                                    </td>
                                    <td>
                                        <span class="flag flag-xs flag-country-pl me-2"></span>
                                        Printic
                                    </td>
                                    <td>
                                        87956621
                                    </td>
                                    <td>
                                        29 Jan 2018
                                    </td>
                                    <td>
                                        <span class="badge bg-danger me-1"></span> Paid Today
                                    </td>
                                    <td>$648</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001406</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Sales Presentation</a>
                                    </td>
                                    <td>
                                        <span class="flag flag-xs flag-country-br me-2"></span>
                                        Tabdaq
                                    </td>
                                    <td>
                                        87956621
                                    </td>
                                    <td>
                                        4 Feb 2018
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary me-1"></span> Due in 3 Weeks
                                    </td>
                                    <td>$300</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001407</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Logo &amp; Print</a>
                                    </td>
                                    <td>
                                        <span class="flag flag-xs flag-country-us me-2"></span>
                                        Apple
                                    </td>
                                    <td>
                                        87956621
                                    </td>
                                    <td>
                                        22 Mar 2018
                                    </td>
                                    <td>
                                        <span class="badge bg-success me-1"></span> Paid Today
                                    </td>
                                    <td>$2500</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                               aria-label="Select invoice"></td>
                                    <td><span class="text-secondary">001408</span></td>
                                    <td><a href="invoice.html" class="text-reset" tabindex="-1">Icons</a></td>
                                    <td>
                                        <span class="flag flag-xs flag-country-pl me-2"></span>
                                        Tookapic
                                    </td>
                                    <td>
                                        87956621
                                    </td>
                                    <td>
                                        13 May 2018
                                    </td>
                                    <td>
                                        <span class="badge bg-success me-1"></span> Paid Today
                                    </td>
                                    <td>$940</td>
                                    <td class="text-end">
                            <span class="dropdown">
                              <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                      data-bs-toggle="dropdown">Actions</button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">
                                  Action
                                </a>
                                <a class="dropdown-item" href="#">
                                  Another action
                                </a>
                              </div>
                            </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-secondary">Showing <span>1</span> to <span>8</span> of <span>16</span>
                                entries</p>
                            <ul class="pagination m-0 ms-auto">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M15 6l-6 6l6 6"></path>
                                        </svg>
                                        prev
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 6l6 6l-6 6"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="store">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" wire:model="form.name" class="form-control" id="name"
                                           placeholder="Your full name">
                                    @error('form.name')
                                    <div class="text-danger">
                                        123
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div>
                                    <label for="email" class="form-label">E-Mail Address</label>
                                    <input type="email" wire:model="form.email" class="form-control" id="email"
                                           placeholder="Your email address">
                                    @error('form.email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3 mb-md-0">
                                <div>
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" wire:model="form.password" class="form-control" id="password"
                                           placeholder="New password">
                                    @error('form.password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-3 mb-md-0">
                                <div>
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="text" wire:model="form.confirmPassword" class="form-control"
                                           id="confirm_password" placeholder="Confirm new password">
                                    @error('form.confirmPassword')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-create-form"
                            wire:loading.attr="disabled" wire:target="store">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Save
                        <span wire:loading wire:target="store">
                            &nbsp; - Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:initialized', () => {

            const createModal = new bootstrap.Modal('#modal-create');

            @this.
            on('modal-created', (event) => {

                createModal.toggle();
            });
        });
    </script>


</div>
