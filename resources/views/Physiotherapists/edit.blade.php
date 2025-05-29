@extends ("main")
@section ("content")
    <div class="container">
        <h2 class="mb-2 text-primary">Edit Physiotherapist</h2>
        <form method="POST" action="/physiotherapists/edit/{{ $model->Id}}">
            @csrf
            <div class="mb-3">
                <div class="row mb-2">
                    <div class="col-auto">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control " placeholder="Enter the name" name="FirstName"
                            value="{{ $model->FirstName }}">
                        @error('FirstName')
                            <div class="text-danger small ms-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <label class="form-label">Surname</label>
                        <input type="text" class="form-control" placeholder="Enter the surname" name="LastName"
                            value="{{ $model->LastName }}">
                        @error('LastName')
                            <div class="text-danger small ms-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-auto">
                        <label class="form-label">Email</label>
                        <input type="text" class="form-control " placeholder="Enter the email" name="Email"
                            value="{{ $model->Email }}">
                        @error('Email')
                            <div class="text-danger small ms-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" placeholder="Enter the phone number" name="PhoneNumber"
                            value="{{ $model->PhoneNumber }}">
                        @error('PhoneNumber')
                            <div class="text-danger small ms-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-auto">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" placeholder="Enter the title" name="Title"
                            value="{{ $model->TitleName }}">
                        @error('Title')
                            <div class="text-danger small ms-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <h3>Services</h3>
                    @foreach ($services as $item)
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $item->Id }}"
                                id="service-{{ $item->Id }}" @if($model->services->contains('Id', $item->Id)) checked @endif>
                            <label class="form-check-label" for="service-{{ $item->Id }}">
                                {{ $item->ServiceName }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <a type="button" class="btn btn-secondary" href="/physiotherapists/details/{{$model->Id}}">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection