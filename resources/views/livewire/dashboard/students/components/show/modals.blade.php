<!--<editor-fold desc="Show Contact">-->
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
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->
<!--<editor-fold desc="Create Contact">-->
<div class="modal modal-blur fade" id="modal-create-contact" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="modal-create-contact-form" wire:submit="storeContact">
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
                <button class="btn btn-primary ms-auto" type="submit" form="modal-create-contact-form"
                        wire:loading.attr="disabled" wire:target="storeContact">
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="storeContact">
                            &nbsp; - Saving...
                        </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->
<!--<editor-fold desc="Edit Contact">-->
<div class="modal modal-blur fade" id="modal-edit-contact" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="modal-edit-contact-form" wire:submit="updateContact">
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
                <button
                    class="btn btn-primary ms-auto" type="submit" form="modal-edit-contact-form"
                    wire:loading.attr="disabled" wire:target="updateContact">
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="updateContact">&nbsp; - Saving...</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->

<!--<editor-fold desc="Edit School">-->
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
                                <label for="school_id" class="form-label required">Name</label>
                                <select id="school_id"
                                        @class(['form-select' => true,'is-invalid' => $errors->has('school_id')])
                                        wire:model.live="studentForm.school_id">
                                    <option value="">-- Select an option --</option>
                                    @foreach($availableSchools as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('school_id')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div>
                                <label for="grade_id" class="form-label required">Grade / Level</label>
                                <select id="grade_id"
                                        @class(['form-select' => true,'is-invalid' => $errors->has('grade_id')])
                                        wire:model.live="studentForm.grade_id">
                                    <option value="">-- Select an option --</option>
                                    @foreach($availableGrades as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div>
                                <label for="academic_stream" class="form-label required">Academic Stream</label>
                                <select id="academic_stream"
                                        @class(['form-select' => true, 'is-invalid' => $errors->has('academic_stream')])
                                        wire:model.live="studentForm.academic_stream">
                                    <option value="">-- Select an option --</option>
                                    @foreach($availableAcademicStreams as $stream => $name)
                                        <option value="{{ $stream }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('academic_stream')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-3">
                            <div>
                                <label for="username" class="form-label">Username</label>
                                <input type="text" wire:model="studentForm.school_username"
                                       @class(['form-control' => true, 'is-invalid' => $errors->has('school_username')])
                                       id="username"
                                       placeholder="Username / E-Mail">
                                @error('school_username')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-6 mb-3">
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="text" wire:model="studentForm.school_password"
                                       @class(['form-control' => true, 'is-invalid' => $errors->has('school_password')])
                                       id="password"
                                       placeholder="Password">
                                @error('school_password')
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
                        wire:loading.attr="disabled"
                        wire:target="updateSchool()">
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="updateSchool()">
                            &nbsp; - Saving...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->

<!--<editor-fold desc="Edit Student">-->
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
                                <label for="birthday" class="form-label">Birthday</label>
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
                                <label for="blood_type" class="form-label">Blood type</label>
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
                                <label for="primary_phone_number" class="form-label">Primary Phone
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
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="updateStudent">
                            &nbsp; - Saving...
                        </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->

<!--<editor-fold desc="Student Profile Picture">-->
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
                                            <!--<editor-fold desc="SVG ICON">-->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            <!--</editor-fold>-->
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
<!--</editor-fold>-->

<!--<editor-fold desc="Create Student Relation">-->
<div class="modal modal-blur fade" id="modal-create-student-relation" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="modal-create-student-relation-form" wire:submit="storeStudentRelation">
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <div>
                                <label for="name" class="form-label required">Search Student</label>
                                <input type="text" wire:model.live="studentRelationSearchQuery" class="form-control"
                                       id="name"
                                       placeholder="Search by name, phone number, or e-mail address.">
                                @error('studentRelationSearchQuery')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                                @error('studentRelationForm.related_id')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mt-3 d-flex flex-column gap-2 justify-content-start text-start">

                                @foreach($searchedStudentRelationsStudents as $student)

                                    @if($student->id == $selectedStudentRelationStudentId)
                                        <div class="badge border-success">
                                            <!--<editor-fold desc="SVG ICON">-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path
                                                    d="M5 12l5 5l10 -10"/>
                                            </svg>
                                            <!--</editor-fold>-->
                                            {{ $student->full_name }} - {{ $student->primary_phone_number }}
                                        </div>
                                    @else
                                        <div class="badge"
                                             wire:click.prevent="selectStudentRelationStudent({{ $student->id }})">
                                            {{ $student->full_name }} - {{ $student->primary_phone_number }}
                                        </div>
                                    @endif

                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div>
                                <label for="relation" class="form-label required">Relation</label>
                                <select class="form-control" id="relation" wire:model="studentRelationForm.name">
                                    <option value="">-- Select an option --</option>
                                    @foreach($availableStudentRelationTypes as $relation => $name)
                                        <option value="{{ $relation }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('studentRelationForm.name')
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
                <button class="btn btn-primary ms-auto" type="submit" form="modal-create-student-relation-form"
                        wire:loading.attr="disabled" wire:target="storeStudentRelation">
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="storeStudentRelation">
                            &nbsp; - Saving...
                        </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->
<!--<editor-fold desc="Edit Student Relation">-->
<div class="modal modal-blur fade" id="modal-edit-student-relation" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit student relation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="modal-edit-student-relation-form" wire:submit="updateStudentRelation">
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <div>
                                <label for="relation" class="form-label required">Relation</label>
                                <select class="form-control" id="relation" wire:model="studentRelationForm.name">
                                    <option value="">-- Select an option --</option>
                                    @foreach($availableStudentRelationTypes as $relation => $name)
                                        <option value="{{ $relation }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('studentRelationForm.name')
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
                <button
                    class="btn btn-primary ms-auto" type="submit" form="modal-edit-student-relation-form"
                    wire:loading.attr="disabled" wire:target="updateStudentRelation">
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="updateStudentRelation">&nbsp; - Saving...</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->

<!--<editor-fold desc="Upload document">-->
<div class="modal modal-blur fade" id="modal-upload-document" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="modal-update-form" wire:submit="saveDocument">
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <div>
                                <label for="document_name" class="form-label required">Name</label>
                                <input type="text" wire:model="document_name" class="form-control"
                                       id="document">
                                @error('document_name')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <label for="document" class="form-label required">Select file</label>
                                <input x-show="!uploading" type="file" wire:model.live="document" class="form-control"
                                       id="document">
                                <div x-show="uploading" class="my-2">
                                    <progress class="progress w-100" max="100" x-bind:value="progress"></progress>
                                </div>
                                <div class="form-hint mt-2">
                                    Allowed file types: jpg, png, and pdf.
                                </div>
                                <div class="form-hint">
                                    Maximum allowed size per file: 10MB.
                                </div>
                                @error('document')
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
                <button class="btn btn-primary ms-auto" type="submit" form="modal-update-form"
                        wire:loading.attr="disabled" wire:target="saveDocument">
                    <!--<editor-fold desc="SVG ICON">-->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10"/>
                    </svg>
                    <!--</editor-fold>-->
                    Save
                    <span wire:loading wire:target="saveDocument">
                            &nbsp; - Saving...
                        </span>
                </button>
            </div>
        </div>
    </div>
</div>
<!--</editor-fold>-->


<script>
    document.addEventListener('livewire:initialized', () => {

        //All
        @this.
        on('close-all-modals', (event) => {
            showContactModal.hide();
            createContactModal.hide();
            editContactModal.hide();
            editSchoolModal.hide();
            editStudentModal.hide();
            createStudentRelationModal.hide();
            editStudentRelationModal.hide();
            uploadDocumentModal.hide();
        });

        //Contacts
        const showContactModal = new bootstrap.Modal('#modal-show-contact');
        const createContactModal = new bootstrap.Modal('#modal-create-contact');
        const editContactModal = new bootstrap.Modal('#modal-edit-contact');

        @this.
        on('toggle-modal-show-contact', (event) => {
            showContactModal.toggle();
        });

        @this.
        on('toggle-modal-create-contact', (event) => {
            createContactModal.toggle();
        });

        document.getElementById('modal-create-contact').addEventListener('hidden.bs.modal', event => {
            @this.
            resetContactCreateModal();
        });

        @this.
        on('toggle-modal-edit-contact', (event) => {
            editContactModal.toggle();
        });

        document.getElementById('modal-edit-contact').addEventListener('hidden.bs.modal', event => {
            @this.
            resetContactEditModal();
        });


        //School
        const editSchoolModal = new bootstrap.Modal('#modal-edit-school');
        @this.
        on('toggle-modal-edit-school', (event) => {
            editSchoolModal.toggle();
        });

        document.getElementById('modal-edit-school').addEventListener('hidden.bs.modal', event => {
            @this.
            resetSchoolEditModal();
        });


        //Student Information
        const editStudentModal = new bootstrap.Modal('#modal-edit-student');
        @this.
        on('toggle-modal-edit-student', (event) => {
            editStudentModal.toggle();
        });
        document.getElementById('modal-edit-student').addEventListener('hidden.bs.modal', event => {
            @this.
            resetStudentEditModel();
        });

        //Profile Picture
        const showStudentAvatarModal = new bootstrap.Modal('#modal-show-student-avatar');

        @this.
        on('toggle-modal-show-student-avatar', (event) => {
            showStudentAvatarModal.toggle();
        });


        //Student Relations
        const createStudentRelationModal = new bootstrap.Modal('#modal-create-student-relation');
        const editStudentRelationModal = new bootstrap.Modal('#modal-edit-student-relation');

        @this.
        on('toggle-modal-create-student-relation', (event) => {
            createStudentRelationModal.toggle();
        });

        document.getElementById('modal-create-student-relation').addEventListener('hidden.bs.modal', event => {
            @this.
            resetStudentRelationCreateModal();
        });

        @this.
        on('toggle-modal-edit-student-relation', (event) => {
            editStudentRelationModal.toggle();
        });

        document.getElementById('modal-edit-student-relation').addEventListener('hidden.bs.modal', event => {
            @this.
            resetStudentRelationEditModal();
        });

        //Upload document
        const uploadDocumentModal = new bootstrap.Modal('#modal-upload-document');
        @this.
        on('toggle-modal-upload-document', (event) => {
            uploadDocumentModal.toggle();
        });

    });
</script>
