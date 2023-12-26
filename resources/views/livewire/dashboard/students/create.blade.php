<div>

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        <a href="{{ route('dashboard.students.index') }}">Manage Students</a>
                        &nbsp;
                        /
                        &nbsp;
                        Create Student
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

            @if($step !== 'welcome')
                <div class="row row-deck row-cards">
                    <div class="col">
                        <ul class="steps steps-blue steps-counter my-4">
                            <li class="step-item @if($step === 'basic-details') active @endif">Basic Details</li>
                            <li class="step-item @if($step === 'profile-picture') active @endif">Profile Picture</li>
                            <li class="step-item @if($step === 'school-information') active @endif">School Information
                            </li>
                            <li class="step-item @if($step === 'contacts') active @endif">Contacts</li>
                            <li class="step-item @if($step === 'finish') active @endif">Finish</li>
                        </ul>
                    </div>
                </div>
            @endif

            @if($step == 'welcome')
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="text-center mt-5">
                            <img src="{{ asset('theme/static/illustrations/undraw_book_reading_oc7a.svg') }}"
                                 style="width: 200px; height: auto;"
                                 alt="Completed Registration Image">

                            <h1 class="mt-5">Student Register Wizard</h1>

                            <p class="text-secondary text-justify">
                                The student register wizard is a streamlines the process of
                                adding new students to the system and ensures that all necessary details are
                                captured accurately. The user-friendly interface simplifies the data entry
                                process, enhancing the efficiency of student
                                management tasks. As an integral part of our website's administrative
                                capabilities, this student register form plays a pivotal role in maintaining an
                                organized and comprehensive student database, empowering us to provide effective
                                support and resources to our students and faculty.
                            </p>

                            <button
                                wire:click.prevent="setStep('basic-details')"
                                style="width: 200px;"
                                class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                                Start Process
                            </button>
                        </div>
                    </div>
                </div>
                {{--                <div class="row row-deck row-cards">--}}
                {{--                    <div class="col">--}}
                {{--                        <div class="container container py-4">--}}
                {{--                            <div class="card card-md">--}}
                {{--                                <div class="card-body text-center py-4 p-sm-5">--}}
                {{--                                    <img src="{{ asset('theme/static/illustrations/undraw_book_reading_oc7a.svg') }}"--}}
                {{--                                         style="width: 200px; height: auto;"--}}
                {{--                                         class="mb-n2" alt="">--}}
                {{--                                    <h1 class="mt-5">Student Register Wizard</h1>--}}
                {{--                                </div>--}}
                {{--                                <div class="hr-text hr-text-center hr-text-spaceless">Description</div>--}}
                {{--                                <div class="card-body text-center py-4 p-sm-5">--}}
                {{--                                                    <p class="text-secondary text-justify">--}}
                {{--                                                        The student register wizard is a streamlines the process of--}}
                {{--                                                        adding new students to the system and ensures that all necessary details are--}}
                {{--                                                        captured accurately. The user-friendly interface simplifies the data entry--}}
                {{--                                                        process, enhancing the efficiency of student--}}
                {{--                                                        management tasks. As an integral part of our website's administrative--}}
                {{--                                                        capabilities, this student register form plays a pivotal role in maintaining an--}}
                {{--                                                        organized and comprehensive student database, empowering us to provide effective--}}
                {{--                                                        support and resources to our students and faculty.--}}
                {{--                                                    </p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="row align-items-center mt-3">--}}
                {{--                                <div class="col-4">--}}

                {{--                                </div>--}}
                {{--                                <div class="col">--}}
                {{--                                    <div class="btn-list justify-content-end">--}}
                {{--                                        <a href="{{ route('dashboard.students.index') }}"--}}
                {{--                                           class="btn btn-link link-secondary">--}}
                {{--                                            Back to students--}}
                {{--                                        </a>--}}
                {{--                                        <a wire:click.prevent="setStep('basic-details')" href="#"--}}
                {{--                                           class="btn btn-primary" style="width: 150px;">--}}
                {{--                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">--}}
                {{--                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>--}}
                {{--                                                <path d="M9 6l6 6l-6 6"></path>--}}
                {{--                                            </svg>--}}
                {{--                                            Start--}}
                {{--                                        </a>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            @elseif($step == 'basic-details')
                <div class="row row-deck row-cards">
                    <div class="col">
                        <form class="card">
                            <div class="card-header">
                                <h3 class="card-title">Basic Profile Details</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="text-secondary">
                                            Please complete the student's account information below. Fields marked with
                                            a
                                            red asterisk (*) are required. <br> After filling in the necessary details,
                                            click
                                            'Next' to proceed to the next stage.
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="first_name" class="col-3 col-form-label required">Full Name</label>
                                    <div class="col">
                                        <input type="text"
                                               wire:model="studentForm.first_name"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.first_name')])
                                               id="first_name" aria-describedby="firstName"
                                               placeholder="First name">
                                        @error('studentForm.first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="middle_name" class="d-none"></label>
                                        <input type="text"
                                               wire:model="studentForm.middle_name"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.middle_name')])
                                               id="middle_name"
                                               aria-describedby="middleName" placeholder="Middle name">
                                        @error('studentForm.middle_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="last_name" class="d-none"></label>
                                        <input type="text"
                                               wire:model="studentForm.last_name"
                                               @class(['form-control' => true, 'is-invalid' => $errors->has('studentForm.last_name')])
                                               id="last_name" aria-describedby="lastName" placeholder="Last name">
                                        @error('studentForm.last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
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
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="birthday" class="col-3 col-form-label">Birthday</label>
                                    <div class="col">
                                        <input type="date"
                                               wire:model="studentForm.birthday"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.birthday')])
                                               id="birthday" aria-describedby="birthday"
                                               placeholder="Birthday">
                                        @error('studentForm.birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-hint">This field is optional.</small>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="blood_type" class="col-3 col-form-label">Blood Type</label>
                                    <div class="col">
                                        <select id="blood_type"
                                                @class(['form-select' => true,'is-invalid' => $errors->has('studentForm.blood_type')])
                                                wire:model="studentForm.blood_type">
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
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentForm.blood_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="primary_phone_number" class="col-3 col-form-label">Phone
                                        Numbers</label>
                                    <div class="col">
                                        <input type="tel"
                                               wire:model="studentForm.primary_phone_number"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.primary_phone_number')])
                                               id="primary_phone_number" aria-describedby="primaryPhoneNumber"
                                               placeholder="+964 750 1234567">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentForm.primary_phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="secondary_phone_number" class="d-none"></label>
                                        <input type="tel"
                                               wire:model="studentForm.secondary_phone_number"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.secondary_phone_number')])
                                               id="secondary_phone_number" aria-describedby="secondaryPhoneNumber"
                                               placeholder="+964 750 1234567">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentForm.secondary_phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-3 col-form-label">E-Mail Address</label>
                                    <div class="col">
                                        <input type="email"
                                               wire:model="studentForm.email"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.email')])
                                               id="email" aria-describedby="emailAddress"
                                               placeholder="name@example.com">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentForm.email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-3 col-form-label">
                                        <label for="city_id" class="required form-label d-inline">City</label>
                                        /
                                        <label for="address" class="required">Address</label>
                                    </div>

                                    <div class="col">
                                        <label for="city_id" class="d-none"></label>
                                        <select id="city_id"
                                                wire:model="studentForm.city_id"
                                                @class(['form-select' => true,'is-invalid' => $errors->has('studentForm.city_id')])
                                                aria-describedby="cityId">
                                            @foreach($availableCities as $city)
                                                <option value="{{ $city->id }}"> {{ $city->name }} </option>
                                            @endforeach
                                        </select>
                                        @error('studentForm.city_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="address" class="d-none"></label>
                                        <input type="text"
                                               wire:model="studentForm.address"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.address')])
                                               id="address" aria-describedby="address"
                                               placeholder="Dream City, Erbil, KRI">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentForm.address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row row-deck row-cards mt-3">
                    <div class="col">
                        <form class="card">
                            <div class="card-header">
                                <h3 class="card-title">Family Management</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="text-secondary">
                                            Please assign the student to a family, you can use the search box below to
                                            search for a family by its name, or member details.
                                            <br>
                                            You can also select `create a new family` to immediately create a new family
                                            for the student naming it after them.
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <p>Available Options</p>
                                    <div class="form-selectgroup">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" wire:model.change="studentFamilyMode" name="family_mode"
                                                   value="existing-family" class="form-selectgroup-input" checked="">
                                            <span class="form-selectgroup-label">
                                                    Existing Family
                                                </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" wire:model.change="studentFamilyMode" name="family_mode"
                                                   value="create-new" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                    Create New Family
                                                </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" wire:model.change="studentFamilyMode" name="family_mode"
                                                   value="without-family" class="form-selectgroup-input">
                                            <span class="form-selectgroup-label">
                                                    Without Family
                                                </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row row-cards mt-3">
                                    @if($studentFamilyMode == 'existing-family')

                                        <div class="mt-3 row">
                                            <div class="col-6">
                                                <label for="family_id" class="form-label required">Select Family</label>
                                                <select wire:model.change="studentForm.family_id" class="form-control"
                                                        @class(['form-control' => true,'is-invalid' => $errors->has('studentForm.first_name')])
                                                        id="family_id">
                                                    <option wire:key="0" value="0">-- Select an option --</option>
                                                    @foreach($availableFamilies as $family)
                                                        <option wire:key="{{ $family->id }}"
                                                                value="{{ $family->id }}">{{ $family->number }} - {{ ucfirst($family->name) }}</option>
                                                    @endforeach
                                                </select>
                                                @error('family_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label for="search_family_query" class="form-label">Search Family</label>
                                                <input type="text"
                                                       id="search_family_query"
                                                       class="form-control"
                                                       wire:model.live="familySearchQuery">
                                            </div>
                                        </div>

                                    @endif
                                    @if($studentFamilyMode == 'create-new')
                                        @if($studentForm->first_name && $studentForm->last_name)
                                            <p>
                                                A new family will be created
                                                <span
                                                    class="text-info">{{ $studentForm->first_name . ' '  . $studentForm->middle_name . "'s family" }}</span>.
                                            </p>
                                        @else
                                            <p>
                                                A new family will be created using students first and last name.
                                            </p>
                                        @endif
                                    @endif
                                    @if($studentFamilyMode == 'without-family')
                                        <p>
                                            The student will not be assigned to any family.
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="row align-items-center mt-3">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                            <a wire:click.prevent="storeStudent" href="#"
                               class="btn btn-primary" style="width: 150px;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($step == 'profile-picture')
                <div class="row row-deck row-cards">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Upload Profile Picture</h3>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center" wire:loading.remove
                                     wire:target="studentForm.avatar">
                                    <div class="col-12">
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
                                    <div class="col-3 col-md-1">
                                            <span class="avatar avatar-xl"
                                                  style="background-origin: content-box; padding: 10px; background-image: url('{{ $this->studentForm->model->avatar_url }}')">
                                           </span>
                                    </div>
                                    <div class="col-2 col-md-7">
                                        <input type="file" class="form-control-file" wire:model="studentForm.avatar">
                                        @error('studentForm.avatar')
                                        <div>
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                        @enderror
                                    </div>
                                    @if($this->studentForm->model->hasAvatar())
                                        <div class="col text-end">
                                            <button class="btn btn-ghost-danger" wire:click="resetProfilePicture">
                                                Delete Profile Picture
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-auto" wire:loading.delay.longer wire:target="studentForm.avatar">
                                    Uploading photo, please wait.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                            <a href="#"
                               wire:click.prevent="setStep('school-information')"
                               class="btn btn-link link-secondary">
                                Skip
                            </a>
                            <a wire:click.prevent="setStep('school-information')" href="#"
                               class="btn btn-primary" style="width: 150px;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($step == 'school-information')
                <div class="row row-deck row-cards">
                    <div class="col">
                        <form class="card">
                            <div class="card-header">
                                <h3 class="card-title">School Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="text-secondary">
                                            Please complete the student's school information below. Fields marked with a
                                            red asterisk (*) are required. <br> After filling in the necessary details,
                                            click
                                            'Next' to proceed to the next stage.
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="selected_school_id" class="col-3 col-form-label required">
                                        Select School
                                    </label>
                                    <div class="col">
                                        <select id="selected_school_id"
                                                @class(['form-select' => true,'is-invalid' => $errors->has('school_id')])
                                                wire:model.live="studentForm.school_id">
                                            <option value="0">-- Select an option --</option>
                                            @foreach($availableSchools as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('school_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="selected_grade_id" class="col-3 col-form-label required">
                                        Select Grade
                                    </label>
                                    <div class="col">
                                        <select id="selected_grade_id"
                                                @class(['form-select' => true,'is-invalid' => $errors->has('grade_id')])
                                                wire:model.live="studentForm.grade_id">
                                            <option value="0">-- Select an option --</option>
                                            @foreach($availableGrades as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('grade_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="academic_stream" class="col-3 col-form-label required">Academic
                                        Stream</label>
                                    <div class="col">
                                        <select id="academic_stream"
                                                @class(['form-select' => true,'is-invalid' => $errors->has('academic_stream')])
                                                wire:model.live="studentForm.academic_stream">
                                            <option value="">-- Select an option --</option>
                                            @foreach($availableAcademicStreams as $key => $item)
                                                <option value="{{ $key}}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @error('academic_stream')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label for="credentials" class="col-3 col-form-label required">Credentials</label>
                                    <div class="col-md-5 col">
                                        <input type="text"
                                               wire:model="studentForm.school_username"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('school_username')])
                                               id="credentials" aria-describedby="username"
                                               placeholder="Username / E-Mail">
                                        @error('school_username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col">
                                        <input type="text"
                                               wire:model="studentForm.school_password"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('school_password')])
                                               id="credentials" aria-describedby="password" placeholder="Password">
                                        @error('school_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                            <a href="#"
                               wire:click.prevent="setStep('contacts')"
                               class="btn btn-link link-secondary">
                                Skip
                            </a>
                            <a wire:click.prevent="storeStudentSchool" href="#"
                               class="btn btn-primary" style="width: 150px;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($step == 'contacts')
                <div class="row row-deck row-cards">
                    <div class="col">
                        <form class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student Contacts</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="text-secondary">
                                            Please complete the student's contact information below. Fields marked with
                                            a
                                            red asterisk (*) are required. <br> After filling in the necessary details,
                                            click
                                            'Next' to proceed to the next stage.
                                        </p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-3 col-form-label required">Full name</label>
                                    <div class="col">
                                        <input type="text"
                                               wire:model="studentContactForm.name"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentContactForm.name')])
                                               id="name" aria-describedby="contactName"
                                               placeholder="Full name">
                                        @error('studentContactForm.name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="relation" class="col-3 col-form-label required">Relation</label>
                                    <div class="col">
                                        <select id="relation"
                                                @class(['form-select' => true,'is-invalid' => $errors->has('studentContactForm.relation')])
                                                wire:model="studentContactForm.relation">
                                            <option value="">-- Select an option --</option>
                                            @foreach(\App\Models\StudentContact::AVAILABLE_RELATIONS as $key => $name)
                                                <option value="{{ $key }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @error('studentContactForm.relation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="primary_phone_number" class="col-3 col-form-label required">Phone
                                        Numbers</label>
                                    <div class="col">
                                        <input type="tel"
                                               wire:model="studentContactForm.primary_phone_number"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentContactForm.primary_phone_number')])
                                               id="primary_phone_number" aria-describedby="primaryPhoneNumber"
                                               placeholder="+964 750 1234567">
                                        @error('studentContactForm.primary_phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="secondary_phone_number" class="d-none"></label>
                                        <input type="tel"
                                               wire:model="studentContactForm.secondary_phone_number"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentContactForm.secondary_phone_number')])
                                               id="secondary_phone_number"
                                               aria-describedby="secondaryPhoneNumber"
                                               placeholder="+964 750 1234567">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentContactForm.secondary_phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-3 col-form-label">E-Mail Address</label>
                                    <div class="col">
                                        <input type="email"
                                               wire:model="studentContactForm.email"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentContactForm.email')])
                                               id="email" aria-describedby="emailAddress"
                                               placeholder="name@example.com">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentContactForm.email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="address" class="col-3 col-form-label">Address</label>
                                    <div class="col">
                                        <label for="address" class="d-none"></label>
                                        <input type="text"
                                               wire:model="studentContactForm.address"
                                               @class(['form-control' => true,'is-invalid' => $errors->has('studentContactForm.address')])
                                               id="address" aria-describedby="address"
                                               placeholder="Dream City, Erbil, KRI">
                                        <small class="form-hint">This field is optional.</small>
                                        @error('studentContactForm.address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-3"></div>
                                    <div class="col text-end">
                                        <button class="btn btn-primary" wire:click.prevent="storeStudentContact">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-plus" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg>
                                            Add Contact
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row row-cards mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Saved Contacts</h3>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @forelse($studentContacts as $index => $contact)
                                        <div class="student-create-contact-list-item col-3" wire:key="{{ $index }}">
                                            <div class="row g-3 align-items-center">
                                                <a href="#" class="col-auto">
                                                    <span class="avatar"
                                                          style="background-origin: content-box; padding: 3px; background-image: url('{{ asset('images/user-alt.png') }}')">
                                                        <span class="badge bg-info"></span>
                                                    </span>
                                                </a>
                                                <div class="col text-truncate">
                                                    <span
                                                        class="text-reset d-block text-truncate">
                                                        {{ $contact->name }}
                                                    </span>
                                                    <div class="text-secondary text-truncate mt-n1">
                                                        {{ $contact->primary_phone_number }}
                                                    </div>
                                                    @if($contact->secondary_phone_number)
                                                        <div class="text-secondary text-truncate mt-n1">
                                                            {{ $contact->secondary_phone_number }}
                                                        </div>
                                                    @endif
                                                    <small class="text-danger cursor-pointer"
                                                           wire:click.prevent="deleteStudentContact({{ $contact->id }})">
                                                        Remove contact
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            You do not have any saved contacts.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mt-3">
                    <div class="col">
                        <div class="btn-list d-flex justify-content-end">
                            <a href="#"
                               wire:click.prevent="setStep('finish')"
                               class="btn btn-link link-secondary">
                                Skip
                            </a>
                            <a wire:click.prevent="setStep('finish')" href="#"
                               class="btn btn-primary" style="width: 150px;">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 6l6 6l-6 6"></path>
                                </svg>
                                Next
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($step == 'finish')
                <div class="row">
                    <div class="col">
                        <div class="text-center mt-5">
                            <img src="{{ asset('theme/static/illustrations/undraw_well_done_re_3hpo.svg') }}"
                                 style="width: 200px; height: auto;"
                                 alt="Completed Registration Image">

                            <h1 class="mt-5">Completed Student Registration</h1>
                            <p>
                                You can now access and manage the student's information through student profile page.
                            </p>
                            <hr>
                            <a href="{{ route('dashboard.students.show', $this->studentForm->model->id) }}"
                               class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                     stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                </svg>
                                Student Profile
                            </a>
                            <a class="btn btn-primary" href="{{ route('dashboard.students.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                     width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Register New Student
                            </a>
                        </div>
                    </div>
                </div>

            @endif


        </div>
    </div>


</div>
