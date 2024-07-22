<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Bulk Assign Subject Ratings
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
        @if($success)
            <div class="container-xl">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success">
                            Successfully assigned subject ratings.
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-xl mt-3">
            <div class="row row-deck row-cards">
                <div>
                    Select Subjects
                </div>
                @foreach($subjectGroups as $group)
                    <div class="col-12 col-md-3" wire:key="{{ $group->name }}">
                        <div class="card h-100">
                            <div class="card-header p-2">
                                <h3 class="card-title">{{ $group->name }}</h3>
                            </div>
                            <div class="card-body p-2">
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
        <div class="container-xl mt-3">
            <div class="row row-deck row-cards">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Rating List
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th># of Students</th>
                                    <th>Rate / Hour</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($ratings as $key => $item)
                                    <tr>
                                        <td>{{ $item['numberOfStudents'] }}</td>
                                        <td>{{ $item['rate'] }}</td>
                                        <td>
                                            <button class="btn btn-ghost-danger btn-sm"
                                                    wire:click="removeRating({{ $key }})">Remove
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-muted">
                                            No ratings at the moment.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Add Rating Form
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <div>
                                        <label for="number_of_students" class="form-label">Number of Students</label>
                                        <input type="text" wire:model="numberOfStudents" class="form-control"
                                               id="number_of_students" placeholder="1">
                                        @error('numberOfStudents')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <div>
                                        <label for="rate" class="form-label">Rate Per Hour ($)</label>
                                        <input type="text" wire:model="rate" class="form-control" id="rate"
                                               placeholder="2">
                                        @error('rate')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-ghost-azure" wire:click.prevent="addRate">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             data-darkreader-inline-stroke=""
                                             style="--darkreader-inline-stroke: currentColor;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"
                                                  data-darkreader-inline-stroke=""
                                                  style="--darkreader-inline-stroke: none;"></path>
                                            <path d="M12 5l0 14"></path>
                                            <path d="M5 12l14 0"></path>
                                        </svg>
                                        Add Rating
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-xl mt-3">
            <div class="row row-deck row-cards">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Overlapped Ratings
                        </div>
                        <div class="card-body">

                            @if(!empty($overlappedRatingSubjects))
                                <div class="text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 9v4"/>
                                        <path
                                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"/>
                                        <path d="M12 16h.01"/>
                                    </svg>
                                    One or more ratings for the following subjects have overlaps.
                                    Click on the subject name to open ratings page. Either delete the overlapped rating
                                    or remove the subject from bulk assignment.
                                    <button wire:click="refreshOverlaps" class="btn btn-sm btn-ghost-primary">Refresh
                                        overlaps
                                    </button>
                                </div>

                                <ul class="mt-3">
                                    @forelse($overlappedRatingSubjects as $subject)
                                        <li>
                                            <a href="{{ route('dashboard.subjects.rates.index', $subject['id']) }}"
                                               target="_blank">
                                                {{ $subject['group'] }} - {{ $subject['name'] }}
                                            </a>
                                        </li>
                                    @empty

                                    @endforelse
                                </ul>
                            @else
                                <div class="text-muted">
                                    No rating overlaps.
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Complete
                        </div>
                        <div class="card-body">
                            @if(!empty($overlappedRatingSubjects) || empty($selectedSubjectIds) || empty($this->ratings))
                                <div class="text-warning">
                                    Please select the correct settings before proceeding.
                                </div>
                            @else
                                <div class="text-info">
                                    Clicking on the button below will assign price rating for all the subjects.
                                    Please make sure of all the settings as these actions can't be reversed.
                                    <div class="mt-3">
                                        <button class="btn btn-primary" wire:click="assignRatings()">
                                            Assign Ratings
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
