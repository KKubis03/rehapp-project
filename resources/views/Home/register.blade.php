@extends ("main")
@section ("content")
    <div class="d-flex justify-content-center m-5">
        <h1>Welcome to <span class="text-primary">Rehapp</span></h1>
    </div>
    <div class="d-flex justify-content-center">
        <form method="POST" class="my-login-form" action="/register/create">
            @csrf
            <p class="my-login-form-title">Create account</p>
            <div class="my-login-input-container">
                <input type="login" name="Login" value="{{ old('Login') }}" placeholder="Enter login">
                @error('Login')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-login-input-container">
                <input type="password" name="Password" placeholder="Enter password">
                @error('Password')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-login-input-container">
                <input type="password" name="ConfirmPassword" placeholder="Confirm password">
                @error('ConfirmPassword')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="my-login-submit mt-2">
                Sign up
            </button>

            <p class="my-login-link mt-2">
                Already have an account?
                <a href="/login">Sign in</a>
            </p>
        </form>
    </div>
@endsection