<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Edit Session / {{ $session->number }}
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
{{--            <div class="row row-deck row-cards">--}}
{{--                <span class="text-warning">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-triangle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 1.67c.955 0 1.845 .467 2.39 1.247l.105 .16l8.114 13.548a2.914 2.914 0 0 1 -2.307 4.363l-.195 .008h-16.225a2.914 2.914 0 0 1 -2.582 -4.2l.099 -.185l8.11 -13.538a2.914 2.914 0 0 1 2.491 -1.403zm.01 13.33l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -7a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor" /></svg>--}}
{{--                    Updating will reset the charge list for students of this session.--}}
{{--                </span>--}}
{{--            </div>--}}
            <div class="row row-deck row-cards mt-3">

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Session Details</h3>
                        </div>
                        <div class="card-body">

                            <div class="mb-3 row">
                                <label for="teacher_id" class="col-sm-2 col-form-label required">Teacher</label>
                                <div class="col-sm-10">
                                    <select id="teacher_id" class="form-control" wire:model.live="sessionForm.teacher_id">
                                        <option value="">-- Select teacher --</option>
                                        @foreach($availableTeachers as $teacher)
                                            <option value="{{ $teacher->id }}" wire:key="{{ 'teacher-' . $teacher->id }}">
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sessionForm.teacher_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="subject_id" class="col-sm-2 col-form-label required">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" id="subject_id" class="form-control" disabled value="{{ $session->subject->name }}">
                                    {{--                                <select id="subject_id" class="form-control" wire:model.live="sessionForm.subject_id">--}}
                                    {{--                                    <option value="">-- Select subject --</option>--}}
                                    {{--                                    @foreach($availableSubjects as $indexGroup => $subjectGroup)--}}
                                    {{--                                        <optgroup label="{{ $subjectGroup->name }}"--}}
                                    {{--                                                  wire:key="subject-group-{{ $indexGroup }}">--}}
                                    {{--                                            @foreach($subjectGroup->subjects as $subject)--}}
                                    {{--                                                <option value="{{ $subject->id }}"--}}
                                    {{--                                                        wire:key="{{ $subject->id }}">--}}
                                    {{--                                                    {{ $subject->name }}--}}
                                    {{--                                                </option>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </optgroup>--}}
                                    {{--                                    @endforeach--}}
                                    {{--                                </select>--}}
                                    @error('sessionForm.subject_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="type" class="col-sm-2 col-form-label required">Type</label>
                                <div class="col-sm-10">
                                    <select id="type" class="form-control" wire:model.live="sessionForm.type">
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
                                <label for="note" class="col-sm-2 col-form-label">Approval Note</label>
                                <div class="col-sm-10">
                                    <textarea id="note" class="form-control" wire:model="sessionForm.approval_note"></textarea>
                                    @error('sessionForm.approval_note')
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

            </div>

            <div class="row row-deck row-cards mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <button class="btn btn-primary" style="width: 300px;"
                            wire:click="update" wire:target="update" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12l5 5l10 -10" /><path d="M2 12l5 5m5 -5l5 -5" /></svg>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
