@extends ("main")
@section ("content")
    <div class="container">
        <h1 class="m-3 text-primary">Physiotherapist Profile</h1>
        <div class="btn-group m-3" role="group" aria-label="Basic mixed styles example">
            <form method="POST" action="/physiotherapists/delete/{{ $model->Id }}">
                <a type="button" class="btn btn-outline-secondary" href="/physiotherapists"><i
                        class="bi bi-arrow-left me-2"></i>Back</a>
                <a type="button" class="btn btn-outline-primary" href="/physiotherapists/edit/{{ $model->Id }}"><i
                        class="bi bi-pencil me-2"></i>Edit</a>
                @csrf
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash me-2"></i>Delete
                </button>
            </form>
        </div>
        <h3 class="m-4">
            <em>
                <span class="">{{$model->TitleName}}</span>
                {{$model->FirstName}} {{$model->LastName}}
            </em>
        </h3>
        <h4 class="m-4">
            <span class="text-primary me-3"><i class="bi bi-envelope"></i></span>
            {{$model->Email}}
        </h4>
        <h4 class="m-4">
            <span class="text-primary me-3"><i class="bi bi-telephone"></i></span>
            {{$model->PhoneNumber}}
        </h4>
        <h3 class="m-4 text-primary">Services:</h3>
        @foreach ($model->services as $service)
            <h4 class="ms-3">
                <li>{{ $service->ServiceName }}</li>
            </h4>
        @endforeach
    </div>
@endsection