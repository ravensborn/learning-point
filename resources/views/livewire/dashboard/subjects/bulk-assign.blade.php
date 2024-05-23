<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Bulk Assign
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto">
                    <div class="btn-list">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">

                    @foreach($subjectGroups as $group)
                        <div class="col-3" wire:key="{{ $group->name }}">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $group->name }}</h3>
                                </div>
                                <div class="card-body">
                                    @foreach($group->subjects as $subject)
                                        @php
                                            $checked = in_array($subject->id, $selectedSubjectIds);
                                        @endphp
                                        <button
                                            @class(['btn btn-sm' => true, 'btn-ghost-azure' => !$checked, 'btn-primary' => $checked]) wire:key="{{ $subject->id }}"
                                            wire:click="selectSubject({{ $subject->id }})">
                                            @if($checked)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M5 12l5 5l10 -10"/>
                                                </svg>
                                            @endif
                                            {{ $subject->name }}
                                        </button>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    @endforeach



            </div>
        </div>
    </div>

</div>
