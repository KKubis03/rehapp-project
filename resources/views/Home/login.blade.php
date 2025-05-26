@extends ("main")
@section ("content")
    @if (session('success'))
        <div class="alert alert-success w-50 mx-auto my-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="d-flex justify-content-center m-5">
        <h1>Welcome to <span class="text-primary">Rehapp</span></h1>
    </div>
    <div class="d-flex justify-content-center">
        <form method="POST" class="my-login-form" action="/login/authenticate">
            @csrf
            <p class="my-login-form-title">Sign in to your account</p>
            <div class="my-login-input-container">
                <input type="login" name="Login" placeholder="Enter login">
                @error('Login')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
                <span>
                </span>
            </div>
            <div class="my-login-input-container">
                <input type="password" name="Password" placeholder="Enter password">
                @error('Password')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="my-login-submit mt-2">
                Sign in
            </button>

            <p class="my-login-link mt-2">
                No account?
                <a href="/register">Sign up</a>
            </p>
        </form>
    </div>

@endsection