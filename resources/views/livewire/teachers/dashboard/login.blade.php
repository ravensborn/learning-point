<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if($somethingWentWrong)
                    <div class="alert alert-danger">
                        Something went wrong with trying to log you in, please reload the page and try again.
                    </div>

                @else
                    @if($invalidPage)
                        <div class="alert alert-danger">
                            You have reached the maximum allowed attempts to login, please click <a
                                href="{{ route('teacher.login') }}">here</a> to try again.
                        </div>

                    @else

                        <div class="card">

                            <div class="card-header">Teacher Login</div>

                            <div class="card-body">
                                @if(!$codeSent)
                                    <form wire:submit.prevent="sendCode">

                                        <p class="text-center">
                                            Please provide your email address to get the login code
                                        </p>
                                        <div class="row mb-3">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-end">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="text"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email"
                                                       wire:model="email"
                                                       autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <form wire:submit.prevent="validateLogin">

                                        <p class="text-center">
                                            Please provide the login code that was sent to your email address
                                        </p>
                                        <div class="row mb-3">
                                            <label for="loginCode"
                                                   class="col-md-4 col-form-label text-md-end">Login Code</label>

                                            <div class="col-md-6">
                                                <input id="loginCode" type="text"
                                                       class="form-control @error('loginCode') is-invalid @enderror"
                                                       name="loginCode"
                                                       wire:model="loginCode"
                                                       autocomplete="loginCode" autofocus>

                                                @error('loginCode')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-0">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Login
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>
            </div>

            @endif
            @endif


        </div>
    </div>
</div>
