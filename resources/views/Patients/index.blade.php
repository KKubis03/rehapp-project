@extends ("main")
@section ("content")
    @if (session('success'))
        <div class="alert alert-success w-50 mx-auto my-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid-lg p-2">
        <form>
            <div class="d-flex flex-row ps-5 pt-1 pe-5">
                <input placeholder="Surname" class="form-control w-25" name="search" value="{{ $search }}">
                @if(request()->has('search') && request('search') != '')
                    <a href="/patients"
                        class="btn btn-outline-secondary d-flex align-items-center justify-content-center ms-1"><i
                            class="bi bi-x-circle"></i></a>
                @endif
                <button class="btn btn-outline-primary ms-1" type="submit"><i class="bi bi-search m-2"></i></button>
                <a class="ms-auto btn btn-primary" name="new" href="/patients/create">
                    <i class="bi bi-plus-lg"></i>
                    New
                </a>
            </div>
        </form>
        <div class="d-flex flex-row flex-wrap ps-5 pt-1 pe-5 gap-3">
            <div class="list-group w-100">
                @foreach ($models as $model)
                    <a href="/patients/edit/{{ $model->Id }}" class="list-group-item list-group-item-action">
                        <div class="row text-dark">
                            <div class="col fw-semibold">{{ $model->FirstName }}</div>
                            <div class="col fw-semibold">{{ $model->LastName }}</div>
                            <div class="col-auto"><i class="bi bi-calendar-date me-2"></i>{{ $model->BirthDate }}</div>
                            <div class="col"><i class="bi bi-envelope me-2"></i>{{ $model->Email }}</div>
                            <div class="col"><i class="bi bi-telephone me-2"></i>{{ $model->PhoneNumber }}</div>
                            <div class="col-auto">
                                <span class="badge text-bg-primary rounded-pill">{{ $model->Appointments }}12</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
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