@extends ("main")

@section ("content")
    @if (session('success'))
        <div class="alert alert-success w-50 mx-auto my-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <h2 class="mb-2 text-primary">Profile</h2>
        <h4 class="mb-2 text-primary">Change Login</h4>
        <form method="POST" action="/profile/edit/login/{{$user->Id}}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" class="form-control w-50" placeholder="" name="Login" value="{{ $user->Login }}">
                @error('Login')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form method="POST" action="/profile/edit/password/{{$user->Id}}">
            @csrf

            <h4 class="mb-2 text-primary">Change password</h4>
            <div class="mb-3">
                <label class="form-label">Old password</label>
                <input type="password" class="form-control w-50" placeholder="" name="OldPassword">
                @error('OldPassword')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">New password</label>
                <input type="password" class="form-control w-50" placeholder="" name="NewPassword">
                @error('NewPassword')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm password</label>
                <input type="password" class="form-control w-50" placeholder="" name="ConfirmPassword">
                @error('ConfirmPassword')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <a type="button" class="btn btn-secondary" href="/">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form method="POST" action="/profile/delete/{{$user->Id}}">
            @csrf
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash me-2"></i>Delete
            </button>
        </form>
    </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alertBox = document.querySelector('.alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }, 1000);
        }
    });
</script>