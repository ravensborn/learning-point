<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Create Session
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

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Session Details</h3>
                    </div>
                    <div class="card-body">

                        <div class="mb-3 row" wire:ignore.self>
                            <label for="teacher_id" class="col-sm-2 col-form-label required">Subject</label>
                            <div class="col-sm-10">
                                <select id="teacher_id" class="form-control" wire:model.live="sessionForm.subject_id">
                                    <option value="" wire:key="subject-group-main">-- Select subject --</option>
                                    @foreach($availableSubjects as $indexGroup => $subjectGroup)
                                        <optgroup label="{{ $subjectGroup->name }}"
                                                  wire:key="subject-group-{{ $indexGroup }}">
                                            @foreach($subjectGroup->subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                        wire:key="subject-{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('sessionForm.subject_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="type" class="col-sm-2 col-form-label required">Type</label>
                            <div class="col-sm-10">
                                <select id="type" class="form-control" wire:model="sessionForm.type">
                                    <option value="">-- Select type --</option>
                                    @foreach($availableTypes as $type => $name)
                                        <option value="{{ $type }}" wire:key="{{ 'type-' . $type }}">
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sessionForm.type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">

                            <label for="time-in" class="col-sm-2 col-form-label required">Time in</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="time-in" wire:model.live="sessionForm.time_in">
                                @error('sessionForm.time_in')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="mb-3 row">
                            <label for="time-out" class="col-sm-2 col-form-label required">Time out</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="time-out" wire:model="sessionForm.time_out">
                                @error('sessionForm.time_out')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label for="note" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <textarea id="note" class="form-control" wire:model="sessionForm.note"></textarea>
                                @error('sessionForm.note')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row row-deck row-cards mt-3">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search Students</h3>
                    </div>

                    <div class="card-body">

                        <div class="mb-3 row">
                            <label for="studentSearchQuery" class="col-sm-2 col-form-label">Search Query</label>
                            <div class="col-sm-10">
                                <input wire:model.live="studentSearchQuery" type="text" id="studentSearchQuery"
                                       class="form-control">
                                @error('sessionForm.students')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 d-flex flex-row">
                            @foreach($foundStudents as $student)
                                <div
                                    wire:key="student-{{$student->id}}"
                                    style="user-select: none"
                                    @class(['border border-secondary me-2 mt-2 p-2 rounded' => true, 'border-success' => $students->contains('id', '=', $student->id)]) wire:click="addStudent({{ $student->id }})">

                                    @if($students->contains('id', '=', $student->id))
                                        <span class="text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l5 5l10 -10"/></svg>
                                        </span>
                                    @endif

                                    {{ $student->full_name }}
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>
            <div class="row row-deck row-cards mt-3">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Students</h3>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student</th>
                                    <th>Attending</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->full_name }}</td>
                                        <td>
                                            <label class="form-check form-switch mb-0">
                                                <input wire:change="toggleStudentAttending({{ $student->id }})"
                                                       @if(!in_array($student->id, $nonAttendingStudentIds)) checked="" @endif
                                                       class="form-check-input"
                                                       type="checkbox">
                                                <span class="form-check-label"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                    wire:click="removeStudent({{ $student->id }})">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="3">No students at this time.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <div class="row row-deck row-cards mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-primary" style="width: 300px;"
                            wire:click="store" wire:target="store" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12l5 5l10 -10" /><path d="M2 12l5 5m5 -5l5 -5" /></svg>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
