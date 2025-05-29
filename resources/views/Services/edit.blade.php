@extends ("main")
@section ("content")
    <div class="container">
        <h2 class="mb-2 text-primary">Edit service</h2>
        <form method="POST" action="/services/edit/{{ $model->Id}}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Service Name</label>
                <input type="text" class="form-control w-50" placeholder="Enter the name of the service" name="ServiceName"
                    value="{{ $model->ServiceName }}">
                @error('ServiceName')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Short Description</label>
                <textarea class="form-control w-50" rows="2"
                    name="ShortDescription">{{ $model->ShortDescription }}</textarea>
                @error('ShortDescription')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control w-50" rows="5" name="Description">{{ $model->Description }}</textarea>
                @error('Description')
                    <div class="text-danger small ms-1">{{ $message }}</div>
                @enderror
            </div>
            <a type="button" class="btn btn-secondary" href="/services">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection