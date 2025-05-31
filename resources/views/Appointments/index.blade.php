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
                <input placeholder="asd" class="form-control w-25" name="search" value="{{ $search }}">
                @if(request()->has('search') && request('search') != '')
                    <a href="/appointments"
                        class="btn btn-outline-secondary d-flex align-items-center justify-content-center ms-1"><i
                            class="bi bi-x-circle"></i></a>
                @endif
                <button class="btn btn-outline-primary ms-1" type="submit"><i class="bi bi-search m-2"></i></button>
                <a class="ms-auto btn btn-primary" name="new" href="/appointments/create">
                    <i class="bi bi-plus-lg"></i>
                    New
                </a>
            </div>
        </form>
        <div class="d-flex flex-row flex-wrap ps-5 pt-1 pe-5 gap-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Patient</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Service</th>
                        <th scope="col">Physiotherapist</th>
                        <th scope="col-auto"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <th scope="row"></th>
                            <td>{{$model->Patient->FirstName}} {{$model->Patient->LastName}} </td>
                            <td>{{$model->AppointmentDate}}</td>
                            <td>{{ \Carbon\Carbon::parse($model->AppointmentTime)->format('H:i') }}</td>
                            <td>{{$model->Service->ServiceName}}</td>
                            <td>{{$model->Physiotherapist->FirstName}} {{$model->Physiotherapist->LastName}}</td>
                            <td>
                                <div class="d-flex flex-inline">
                                    <a href="/appointments/edit/{{$model->Id}}"><i class="bi bi-pencil me-2"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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