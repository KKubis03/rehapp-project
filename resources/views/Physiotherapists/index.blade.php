@extends ("main")

@section ("content")
    <div class="container-fluid-lg p-2">
        <form>
            <div class="d-flex flex-row ps-5 pt-1 pe-5">
                <input placeholder="Surname" class="form-control w-25" name="search" value="{{ $search }}">
                @if(request()->has('search') && request('search') != '')
                    <a href="/physiotherapists"
                        class="btn btn-outline-secondary d-flex align-items-center justify-content-center ms-1"><i
                            class="bi bi-x-circle"></i></a>
                @endif
                <button class="btn btn-outline-primary ms-1" type="submit"><i class="bi bi-search m-2"></i></button>
                <a class="ms-auto btn btn-primary" name="new" href="/physiotherapists/create">
                    <i class="bi bi-plus-lg"></i>
                    New
                </a>
            </div>
        </form>
        <div class="d-flex flex-row flex-wrap ps-5 pt-1 pe-5 gap-3">
            @foreach ($models as $item)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->FirstName}} {{$item->LastName}}</h5>
                        <p class="card-text">{{ $item->TitleName}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="bi bi-envelope me-2 text-primary"></i>{{ $item->Email}}</li>
                        <li class="list-group-item"><i class="bi bi-telephone me-2 text-primary"></i>{{ $item->PhoneNumber}}
                        </li>
                    </ul>
                    <div class="card-body">
                        <a type="button" class="btn btn-primary fw-semibold" href="/physiotherapists/details/{{ $item->Id }}"><i
                                class="bi bi-info-lg me-2"></i>Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection