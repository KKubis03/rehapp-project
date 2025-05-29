@extends ("main")
@section ("content")
    <div class="container">
        <h2 class="mb-2 text-primary">New Patient</h2>
        <form method="POST" action="/patients/create">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control w-50" placeholder="Enter the name" name="FirstName"
                    value="{{ old('FirstName') }}">
                @error('FirstName')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Surname</label>
                <input type="text" class="form-control w-50" placeholder="Enter the surname" name="LastName"
                    value="{{ old('LastName') }}">
                @error('LastName')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Date of birth</label>
                <input type="date" class="form-control w-50" placeholder="Enter the date of birth" name="BirthDate"
                    value="{{ old('BirthDate') }}">
                @error('BirthDate')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control w-50" placeholder="Enter the email address" name="Email"
                    value="{{ old('Email') }}">
                @error('Email')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Phone number</label>
                <input type="text" class="form-control w-50" placeholder="Enter the phone number" name="PhoneNumber"
                    value="{{ old('PhoneNumber') }}">
                @error('PhoneNumber')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <a type="button" class="btn btn-secondary" href="/patients">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection