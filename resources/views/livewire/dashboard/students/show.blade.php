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
                            @if($student->primary_phone_number)
                                <div class="list-inline-item">
                                    <!--<editor-fold desc="SVG ICON">-->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                    </svg>
                                    <!--</editor-fold>-->
                                    <a class="text-secondary"
                                       href="tel:{{ $student->primary_phone_number }}">{{ $student->primary_phone_number }}</a>
                                </div>
                            @endif
                            @if($student->secondary_phone_number)
                                <div class="list-inline-item">
                                    <!--<editor-fold desc="SVG ICON">-->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline"
                                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                         stroke="currentColor"
                                         fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"/>
                                    </svg>
                                    <!--</editor-fold>-->
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
            <div class="row g-3" wire:ignore.self>
                @include('livewire.dashboard.students.components.show.tabs-section')
                @include('livewire.dashboard.students.components.show.info-section')
            </div>
        </div>
    </div>

    @include('livewire.dashboard.students.components.show.modals')
</div>
