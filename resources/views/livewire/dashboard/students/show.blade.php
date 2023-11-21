<div>
    <div class="page-header">
        <div class="container">
            <div class="row">

                <div class="col-12 d-flex align-items-center">
                    <div class="avatar avatar-lg rounded cursor-pointer"
                         wire:click.prevent="showStudentAvatarModal()"
                         style="width: 48px; object-fit: contain; background-origin: content-box; padding: 5px; background-image: url('{{ $student->avatar_url }}');"></div>

                    <div class="ms-3">
                        <h1 class="fw-bold mb-0">{{ $student->full_name }}</h1>
                        <div class="list-inline list-inline-dots text-secondary">
                            <div class="list-inline-item">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path
                                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                </svg>
                                <a class="text-secondary"
                                   href="tel:{{ $student->primary_phone_number }}">{{ $student->primary_phone_number }}</a>
                            </div>
                            @if($student->secondary_phone_number)
                                <div class="list-inline-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                    </svg>
                                    <a class="text-secondary"
                                       href="tel:{{ $student->secondary_phone_number }}">{{ $student->secondary_phone_number }}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <div class="col">
                    <div class="card">
                        <div class="card-header" style="overflow: hidden;">
                            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-1" class="nav-link active" data-bs-toggle="tab"
                                       aria-selected="false" role="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon me-2" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"/>
                                            <path d="M12 9h.01"/>
                                            <path d="M11 12h1v4h1"/>
                                        </svg>
                                        Overview
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-2" class="nav-link" data-bs-toggle="tab"
                                       aria-selected="false" role="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon me-2" width="24"
                                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                             fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path
                                                d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"/>
                                            <path
                                                d="M4 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"/>
                                        </svg>
                                        Session History
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-3" class="nav-link" data-bs-toggle="tab"
                                       aria-selected="false" role="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M17 3l0 18"/>
                                            <path d="M10 18l-3 3l-3 -3"/>
                                            <path d="M7 21l0 -18"/>
                                            <path d="M20 6l-3 -3l-3 3"/>
                                        </svg>
                                        Transactions
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-4" class="nav-link" data-bs-toggle="tab"
                                       aria-selected="false" role="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
                                        </svg>
                                        Relations
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#tabs-5" class="nav-link" data-bs-toggle="tab"
                                       aria-selected="false" role="tab">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M15 3v4a1 1 0 0 0 1 1h4"/>
                                            <path
                                                d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z"/>
                                            <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2"/>
                                        </svg>
                                        Documents
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-1" role="tabpanel">
                                    <h4>Overview tab</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium amet animi
                                        commodi dolorem eligendi enim error fugiat fugit, itaque laborum, nemo, nesciunt
                                        odit quaerat recusandae tempore totam vel voluptatibus! Fuga.
                                    </p>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <h4>Sessions tab</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium amet animi
                                        commodi dolorem eligendi enim error fugiat fugit, itaque laborum, nemo, nesciunt
                                        odit quaerat recusandae tempore totam vel voluptatibus! Fuga.
                                    </p>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <h4>Transactions tab</h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium amet animi
                                        commodi dolorem eligendi enim error fugiat fugit, itaque laborum, nemo, nesciunt
                                        odit quaerat recusandae tempore totam vel voluptatibus! Fuga.
                                    </p>
                                </div>
                                <div class="tab-pane" id="tabs-4" role="tabpanel">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Relations</h4>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-pencil-plus text-secondary cursor-pointer"
                                                 width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                 stroke="currentColor" fill="none" stroke-linecap="round"
                                                 stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"></path>
                                                <path d="M13.5 6.5l4 4"></path>
                                                <path d="M16 19h6"></path>
                                                <path d="M19 16v6"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="list-group list-group-flush list-group-hoverable">
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto"><span class="badge bg-success"></span></div>
                                                    <div class="col-auto">
                                                        <a href="#">
                                                            <span class="avatar">YG</span>
                                                        </a>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-reset d-block">Eren Yeager</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            Brother
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-trash cursor-pointer text-secondary" width="24"
                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                 stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M4 7l16 0"/>
                                                                <path d="M10 11l0 6"/>
                                                                <path d="M14 11l0 6"/>
                                                                <path
                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto"><span class="badge bg-success"></span></div>
                                                    <div class="col-auto">
                                                        <a href="#">
                                                            <span class="avatar">MA</span>
                                                        </a>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-reset d-block">Mikasa Akerman</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            Sister
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-trash cursor-pointer text-secondary" width="24"
                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                 stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M4 7l16 0"/>
                                                                <path d="M10 11l0 6"/>
                                                                <path d="M14 11l0 6"/>
                                                                <path
                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-5" role="tabpanel">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Documents</h4>
                                        </div>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-upload text-secondary cursor-pointer" width="24"
                                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"/>
                                                <path d="M7 9l5 -5l5 5"/>
                                                <path d="M12 4l0 12"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="list-group list-group-flush list-group-hoverable">
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto"><span class="badge bg-success"></span></div>
                                                    <div class="col-auto">
                                                         <span class="avatar">
                                                                 <svg xmlns="http://www.w3.org/2000/svg"
                                                                      class="icon icon-tabler icon-tabler-file"
                                                                      width="24"
                                                                      height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                      stroke="currentColor" fill="none"
                                                                      stroke-linecap="round"
                                                                      stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                                                <path
                                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                                                        </svg>
                                                            </span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-reset d-block">National Id</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            PNG File
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-download cursor-pointer text-secondary"
                                                                 width="24" height="24" viewBox="0 0 24 24"
                                                                 stroke-width="2" stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"/>
                                                                <path d="M7 11l5 5l5 -5"/>
                                                                <path d="M12 4l0 12"/>
                                                            </svg>
                                                        </a>
                                                        <a href="#" class="list-group-item-actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-trash cursor-pointer text-secondary" width="24"
                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                 stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M4 7l16 0"/>
                                                                <path d="M10 11l0 6"/>
                                                                <path d="M14 11l0 6"/>
                                                                <path
                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col-auto"><span class="badge bg-success"></span></div>
                                                    <div class="col-auto">
                                                         <span class="avatar">
                                                                 <svg xmlns="http://www.w3.org/2000/svg"
                                                                      class="icon icon-tabler icon-tabler-file"
                                                                      width="24"
                                                                      height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                      stroke="currentColor" fill="none"
                                                                      stroke-linecap="round"
                                                                      stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                                                <path
                                                                    d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                                                        </svg>
                                                            </span>
                                                    </div>
                                                    <div class="col text-truncate">
                                                        <a href="#" class="text-reset d-block">Passport</a>
                                                        <div class="d-block text-secondary text-truncate mt-n1">
                                                            PDF File
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <a href="#" class="list-group-item-actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-download cursor-pointer text-secondary"
                                                                 width="24" height="24" viewBox="0 0 24 24"
                                                                 stroke-width="2" stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"/>
                                                                <path d="M7 11l5 5l5 -5"/>
                                                                <path d="M12 4l0 12"/>
                                                            </svg>
                                                        </a>
                                                        <a href="#" class="list-group-item-actions">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="icon icon-tabler icon-tabler-trash cursor-pointer text-secondary" width="24"
                                                                 height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                 stroke="currentColor" fill="none"
                                                                 stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                                <path d="M4 7l16 0"/>
                                                                <path d="M10 11l0 6"/>
                                                                <path d="M14 11l0 6"/>
                                                                <path
                                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <div class="card-title">Basic info</div>
                                        <div class="link-secondary cursor-pointer"
                                             wire:click.prevent="prepareStudentUpdate()">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                                <path d="M16 5l3 3"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon me-2 text-secondary" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path
                                                d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"/>
                                            <path d="M3 7l9 6l9 -6"/>
                                        </svg>
                                        E-Mail: <strong><a
                                                href="{{ $student->email }}">{{ $student->email }}</a></strong>
                                    </div>
                                    <div class="mb-2">
                                        @if($student->isFemale())
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 9m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"/>
                                                <path d="M12 14v7"/>
                                                <path d="M9 18h6"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M10 14m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"/>
                                                <path d="M19 5l-5.4 5.4"/>
                                                <path d="M19 5h-5"/>
                                                <path d="M19 5v5"/>
                                            </svg>
                                        @endif
                                        Gender: <strong>{{ ucwords($student->gender) }}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary"
                                             width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 20h18v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8z"></path>
                                            <path
                                                d="M3 14.803c.312 .135 .654 .204 1 .197a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1c.35 .007 .692 -.062 1 -.197"></path>
                                            <path d="M12 4l1.465 1.638a2 2 0 1 1 -3.015 .099l1.55 -1.737z"></path>
                                        </svg>
                                        Birth date: <strong>{{ $student->birthday->format('Y-m-d') }}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon me-2 text-secondary" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path
                                                d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366l-3.927 2.268l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366l-3.928 -2.269v4.536a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1 -1.732a1 1 0 0 1 .366 -1.366l3.927 -2.268l-3.927 -2.268a1 1 0 0 1 -.366 -1.366l1 -1.732a1 1 0 0 1 1.366 -.366l3.928 2.267v-4.535a1 1 0 0 1 1 -1h2z"/>
                                        </svg>
                                        Blood type: <strong>{{ $student->blood_type }}</strong>

                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-secondary"
                                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                             stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                            <path
                                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                        </svg>
                                        Lives in: <strong> {{ $student->full_address }}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon me-2 text-secondary" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/>
                                            <path d="M16 3l0 4"/>
                                            <path d="M8 3l0 4"/>
                                            <path d="M4 11l16 0"/>
                                            <path d="M8 15h2v2h-2z"/>
                                        </svg>
                                        Joined: <strong> {{ $student->created_at->format('Y-m-d') }}</strong>
                                    </div>
                                    <div class="mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon me-2 text-secondary" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path
                                                d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/>
                                            <path d="M16 3l0 4"/>
                                            <path d="M8 3l0 4"/>
                                            <path d="M4 11l16 0"/>
                                            <path d="M8 15h2v2h-2z"/>
                                        </svg>
                                        Created by: <strong> {{ $student->user->name }}</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="card-title">School Information</h2>
                                        <div class="link-secondary cursor-pointer"
                                             wire:click.prevent="prepareSchoolUpdate()">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                                <path d="M16 5l3 3"/>
                                            </svg>
                                        </div>
                                    </div>

                                    @if($student->school)
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                            </svg>
                                            Name: <strong>{{ $student->school->name }}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path
                                                    d="M17.8 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"/>
                                                <path
                                                    d="M6.2 19.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"/>
                                                <path
                                                    d="M12 9.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z"/>
                                            </svg>
                                            Grade: <strong>{{ $student->school->grade }}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 6l7 7l-4 4"/>
                                                <path
                                                    d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.586 -10.586a2 2 0 0 0 0 -2.829l-1.171 -1.171a2 2 0 0 0 -2.829 0l-10.586 10.586a2.828 2.828 0 0 0 0 4z"/>
                                                <path d="M4 20l1.768 -1.768"/>
                                            </svg>
                                            Academic stream:
                                            <strong>{{ $student->school->academic_stream_name }}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6"/>
                                                <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4"/>
                                            </svg>
                                            Website: <span>
                                            <a target="_blank" href="{{ $student->school->school_url }}">
                                                Visit Site
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path
                                                        d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"/>
                                                    <path d="M11 13l9 -9"/>
                                                    <path d="M15 4h5v5"/>
                                                </svg>
                                            </a>
                                        </span>
                                        </div>
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path
                                                    d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"/>
                                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/>
                                                <path d="M8 11v-4a4 4 0 1 1 8 0v4"/>
                                            </svg>
                                            Username: <strong>{{ $student->school->username }}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon me-2 text-secondary" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path
                                                    d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"/>
                                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/>
                                                <path d="M8 11v-4a4 4 0 1 1 8 0v4"/>
                                            </svg>
                                            Password:
                                            <span>
                                            @if($showStudentSchoolAccountPassword)
                                                    <span class="fst-italic">{{ $student->school->password }}</span>
                                                @else
                                                    <span>******</span>
                                                    <a href="#"
                                                       wire:click.prevent="toggleStudentSchoolAccountPassword()">
                                                   <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-lock-off" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"
                                                                                      fill="none"/><path
                                                           d="M15 11h2a2 2 0 0 1 2 2v2m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h4"/><path
                                                           d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/><path
                                                           d="M8 11v-3m.719 -3.289a4 4 0 0 1 7.281 2.289v4"/><path
                                                           d="M3 3l18 18"/></svg>
                                                </a>
                                                @endif
                                        </span>
                                        </div>
                                    @else
                                        Student doesn't have school information, please click <a
                                            wire:click.prevent="createSchoolEntry()" href="#">here</a> to add.
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="card-title">Contacts</h2>
                                        <div class="link-secondary cursor-pointer"
                                             wire:click.prevent="showContactCreateModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-pencil-plus" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4"/>
                                                <path d="M13.5 6.5l4 4"/>
                                                <path d="M16 19h6"/>
                                                <path d="M19 16v6"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-12">
                                            <p class="text-secondary mb-3">
                                                Contacts list, click on any to view and manage contact details or click
                                                on the new contact icon to add a new contact.
                                            </p>
                                        </div>
                                        @forelse($contacts as $contact)
                                            <div class="col-6" wire:key="{{ $contact->id }}">
                                                <a href="#" class="text-decoration-none"
                                                   wire:click.prevent="showContactModal({{ $contact->id }})">
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-auto">
                                                        <span class="avatar"
                                                              style="
                                                              box-shadow: unset;
                                                              background-color: unset;
                                                              background-image: url('{{ asset('images/user.png') }}');
                                                              ">
                                                        </span>
                                                        </div>
                                                        <div class="col text-truncate">
                                                        <span class="text-body d-block text-truncate">
                                                            {{ $contact->name }}
                                                        </span>
                                                            <div class="text-secondary text-truncate mt-n1">
                                                                {{ $contact->relation_name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <p>
                                                Contacts haven't been assigned to this student, click on the pen icon to
                                                create a new contact.
                                            </p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-show-contact" tabindex="-1" style="display: none;" aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h3>{{ $selectedContact?->name }}</h3>


                    <p>Available Details:</p>
                    <ul>
                        <li>
                            Relation:
                            <strong>
                                {{ $selectedContact?->relation_name }}
                            </strong>
                        </li>
                        <li>
                            Primary Phone Number:
                            <a href="tel:{{ $selectedContact?->primary_phone_number }}">
                                {{ $selectedContact?->primary_phone_number }}
                            </a>

                        </li>
                        @if($selectedContact?->secondary_phone_number)
                            <li>
                                Secondary Phone Number:
                                <a href="tel:{{ $selectedContact?->secondary_phone_number }}">
                                    {{ $selectedContact?->secondary_phone_number }}
                                </a>
                            </li>
                        @endif
                        <li>
                            E-Mail Address:
                            <a href="mailto:{{ $selectedContact?->email }}">{{ $selectedContact?->email }}</a>
                        </li>
                        <li>
                            Address:
                            <strong>{{ $selectedContact?->address }}</strong>
                        </li>
                    </ul>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto"
                            wire:click.prevent="deleteContact({{ $selectedContact?->id }})">
                        {{ $deleteContactButtonText }}
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-create-contact" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-create-form" wire:submit="storeContact">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="name" class="form-label required">Name</label>
                                    <input type="text" wire:model="studentContactForm.name" class="form-control"
                                           id="name"
                                           placeholder="Full name">
                                    @error('studentContactForm.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="relation" class="form-label required">Relation</label>
                                    <select class="form-control" id="relation" wire:model="studentContactForm.relation">
                                        <option value="">-- Select an option --</option>
                                        @foreach($availableRelations as $relation => $name)
                                            <option value="{{ $relation }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('studentContactForm.relation')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="primary_phone_number" class="form-label required">Primary Phone
                                        Number</label>
                                    <input type="tel" wire:model="studentContactForm.primary_phone_number"
                                           class="form-control" id="primary_phone_number"
                                           placeholder="+964 (750) 1234567">
                                    @error('studentContactForm.primary_phone_number')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="secondary_phone_number" class="form-label">Secondary Phone
                                        Number</label>
                                    <input type="tel" wire:model="studentContactForm.secondary_phone_number"
                                           class="form-control" id="secondary_phone_number"
                                           placeholder="+964 (750) 1234567">
                                    @error('studentContactForm.secondary_phone_number')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="email" class="form-label">E-Mail address</label>
                                    <input type="text" wire:model="studentContactForm.email" class="form-control"
                                           id="email"
                                           placeholder="name@example.com">
                                    @error('studentContactForm.email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" wire:model="studentContactForm.address" class="form-control"
                                           id="address"
                                           placeholder="Dream City, Erbil, KRI">
                                    @error('studentContactForm.address')
                                    <div class="text-danger mt-1">
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
                            wire:loading.attr="disabled" wire:target="storeContact">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Save
                        <span wire:loading wire:target="storeContact">
                            &nbsp; - Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-edit-school" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editing School Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-edit-school-form" wire:submit="updateSchool()">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="name" class="form-label required">Name</label>
                                    <input type="text" wire:model="studentSchoolForm.name" class="form-control"
                                           id="name"
                                           placeholder="Full name">
                                    @error('studentSchoolForm.name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="name" class="form-label required">Grade / Level</label>
                                    <input type="text" wire:model="studentSchoolForm.grade" class="form-control"
                                           id="name"
                                           placeholder="Example: 2">
                                    @error('studentSchoolForm.grade')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="academic_stream" class="form-label required">Academic Stream</label>
                                    <select class="form-control" id="academic_stream"
                                            wire:model="studentSchoolForm.academic_stream">
                                        <option value="">-- Select an option --</option>
                                        @foreach($availableAcademicStreams as $stream => $name)
                                            <option value="{{ $stream }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('studentSchoolForm.relation')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="school_url" class="form-label required">School URL</label>
                                    <input type="url" wire:model="studentSchoolForm.school_url" class="form-control"
                                           id="school_url"
                                           placeholder="https://example-school.com">
                                    @error('studentSchoolForm.school_url')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" wire:model="studentSchoolForm.username" class="form-control"
                                           id="username"
                                           placeholder="Username / E-Mail">
                                    @error('studentSchoolForm.username')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" wire:model="studentSchoolForm.password" class="form-control"
                                           id="password"
                                           placeholder="Password">
                                    @error('studentSchoolForm.password')
                                    <div class="text-danger mt-1">
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
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-edit-school-form"
                            wire:loading.attr="disabled" wire:target="updateSchool()">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10"/>
                        </svg>
                        Save
                        <span wire:loading wire:target="updateSchool()">
                            &nbsp; - Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-edit-student" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Basic Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="modal-edit-student-form" wire:submit="updateStudent">
                        <div class="row mb-3">
                            <div class="col-12 col-md-4 mb-3">
                                <div>
                                    <label for="first_name" class="form-label required">First name</label>
                                    <input type="text" wire:model="studentForm.first_name" class="form-control"
                                           id="first_name"
                                           placeholder="First name">
                                    @error('studentForm.first_name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <div>
                                    <label for="middle_name" class="form-label required">Middle name</label>
                                    <input type="text" wire:model="studentForm.middle_name" class="form-control"
                                           id="middle_name"
                                           placeholder="Middle name">
                                    @error('studentForm.middle_name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <div>
                                    <label for="last_name" class="form-label required">Last name</label>
                                    <input type="text" wire:model="studentForm.last_name" class="form-control"
                                           id="last_name"
                                           placeholder="Last name">
                                    @error('studentForm.last_name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="gender" class="col-3 col-form-label required">Gender</label>
                                <div class="col">
                                    <label class="form-check form-check-inline">
                                        <input value="male"
                                               id="gender"
                                               wire:model="studentForm.gender"
                                               @class(['form-check-input' => true, 'is-invalid' => $errors->has('gender')])
                                               type="radio" name="radios-inline">
                                        <span class="form-check-label">Male</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input value="female"
                                               id="gender"
                                               wire:model="studentForm.gender"
                                               @class(['form-check-input' => true, 'is-invalid' => $errors->has('gender')])
                                               type="radio"
                                               name="radios-inline">
                                        <span class="form-check-label">Female</span>
                                    </label>
                                    @error('studentForm.gender')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="birthday" class="form-label required">Birthday</label>
                                    <input type="date" wire:model="studentForm.birthday"
                                           class="form-control" id="birthday">
                                    @error('studentForm.birthday')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="blood_type" class="form-label required">Blood type</label>
                                    <select id="blood_type" wire:model="studentForm.blood_type" class="form-control">
                                        <option>-- Select an option --</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                    @error('studentForm.blood_type')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="primary_phone_number" class="form-label required">Primary Phone
                                        Number</label>
                                    <input type="text" wire:model="studentForm.primary_phone_number"
                                           class="form-control" id="primary_phone_number"
                                           placeholder="+964 (750) 1234567">
                                    @error('studentForm.primary_phone_number')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="secondary_phone_number" class="form-label">Secondary Phone
                                        Number</label>
                                    <input type="text" wire:model="studentForm.secondary_phone_number"
                                           class="form-control" id="secondary_phone_number"
                                           placeholder="+964 (750) 1234567">
                                    <small class="form-hint">This field is optional</small>
                                    @error('studentForm.secondary_phone_number')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="email" class="form-label">E-Mail address</label>
                                    <input type="text" wire:model="studentForm.email" class="form-control"
                                           id="email"
                                           placeholder="name@example.com">
                                    <small class="form-hint">This field is optional</small>
                                    @error('studentForm.email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="city_id" class="form-label required">City</label>
                                    <select id="city_id" wire:model="studentForm.city_id" class="form-control">
                                        @foreach($availableCities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('studentForm.city_id')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div>
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" wire:model="studentForm.address" class="form-control"
                                           id="address"
                                           placeholder="Dream City, Erbil, KRI">
                                    <small class="form-hint">This field is optional</small>
                                    @error('studentForm.address')
                                    <div class="text-danger mt-1">
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
                    <button class="btn btn-primary ms-auto" type="submit" form="modal-edit-student-form"
                            wire:loading.attr="disabled" wire:target="updateStudent">

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10"/>
                        </svg>
                        Save
                        <span wire:loading wire:target="updateStudent">
                            &nbsp; - Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-show-student-avatar" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-9">
                            @if($updateAvatarMode)
                                <div wire:loading.remove
                                     wire:target="studentForm.avatar">
                                    <div>
                                        <h4>Upload a new profile picture</h4>
                                        <p class="text-secondary">
                                            Select a profile picture for the student, please upload a photo that meets
                                            the following requirements:
                                        </p>
                                        <ul class="text-secondary">
                                            <li>Well-lit and high-resolution.</li>
                                            <li>Maximum allowed upload size: 5MB.</li>
                                            <li>Allowed formats: JPG and PNG.</li>
                                            <li>Square (1:1 ratio) pictures are preferred.</li>
                                        </ul>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between">
                                        <div>
                                            <input type="file" class="form-control-file"
                                                   wire:model="studentForm.avatar">
                                            @error('studentForm.avatar')
                                            <div>
                                                <small class="text-danger">{{ $message }}</small>
                                            </div>
                                            @enderror

                                        </div>
                                        <div>
                                            <button wire:click.prevent="saveStudentAvatar"
                                                    class="btn btn-primary btn-sm" style="width: 150px;">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="icon icon-tabler icon-tabler-chevron-right" width="24"
                                                     height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M9 6l6 6l-6 6"></path>
                                                </svg>
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto" wire:loading.delay.longer wire:target="studentForm.avatar">
                                    Uploading photo, please wait.
                                </div>
                            @else
                                <div>
                                    <div class="mb-1">Available Actions:</div>
                                    <ul>
                                        <li>
                                            <a class="link mb-1" href="{{ $student->avatar_url }}" download>
                                                Download image.
                                            </a>
                                        </li>
                                        <li>
                                            <a class="link mb-1" href="#" wire:click.prevent="toggleUpdateAvatarMode()">
                                                Upload a new profile picture.
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            @endif

                        </div>

                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <div>
                                @if($studentForm->avatar)
                                    @if($studentForm->avatar->isPreviewable())
                                        <img src="{{ $studentForm->avatar->temporaryUrl() }}"
                                             style="width: 100%; height: auto; object-fit: contain;"
                                             alt="Enlarged Avatar">
                                    @endif
                                @else
                                    <a href="{{ $student->avatar_url }}" target="_blank">
                                        <img src="{{ $student->avatar_url }}"
                                             style="width: 100%; height: auto; object-fit: contain;"
                                             alt="Enlarged Avatar">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Close
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {

            const showContactModal = new bootstrap.Modal('#modal-show-contact');
            const createContactModal = new bootstrap.Modal('#modal-create-contact');
            const editSchoolModal = new bootstrap.Modal('#modal-edit-school');
            const editStudentModal = new bootstrap.Modal('#modal-edit-student');
            const showStudentAvatarModal = new bootstrap.Modal('#modal-show-student-avatar');

            @this.
            on('close-all-modals', (event) => {
                showContactModal.hide();
                createContactModal.hide();
                editSchoolModal.hide();
                editStudentModal.hide();
            });

            @this.
            on('toggle-modal-show-contact', (event) => {
                showContactModal.toggle();
            });

            document.getElementById('modal-show-contact').addEventListener('hidden.bs.modal', event => {
                @this.
                resetShowContactModal();
            });

            @this.
            on('toggle-modal-create-contact', (event) => {
                createContactModal.toggle();
            });

            @this.
            on('toggle-modal-edit-school', (event) => {
                editSchoolModal.toggle();
            });


            document.getElementById('modal-edit-school').addEventListener('hidden.bs.modal', event => {
                @this.
                resetSchoolEditForm();
            });

            @this.
            on('toggle-modal-edit-student', (event) => {
                editStudentModal.toggle();
            });

            document.getElementById('modal-edit-student').addEventListener('hidden.bs.modal', event => {
                @this.
                resetStudentEditForm();
            });


            @this.
            on('toggle-modal-show-student-avatar', (event) => {
                showStudentAvatarModal.toggle();
            });
        });
    </script>

</div>
