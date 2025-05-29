@extends ("main")

@section ("content")
    @if (session('success'))
        <div class="alert alert-success w-50 mx-auto my-3">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid p-2">
        <form>
            <div class="d-flex flex-row ps-5 pt-1 pe-5">
                <input placeholder="Name of the service" class="form-control w-25" name="search" id="search"
                    value="{{ $search }}">
                @if(request()->has('search') && request('search') != '')
                    <a href="/services"
                        class="btn btn-outline-secondary d-flex align-items-center justify-content-center ms-1"><i
                            class="bi bi-x-circle"></i></a>
                @endif
                <button class="btn btn-outline-primary ms-1" type="submit"><i class="bi bi-search m-2"></i></button>
                <a class="ms-auto btn btn-primary" name="new" href="/services/create">
                    <i class="bi bi-plus-lg"></i>
                    New
                </a>
            </div>
        </form>
        <div class="flex-column ps-5 pt-1 pe-5 p">
            @foreach ($models as $item)
                <x-accordion :id="$item->Id" :title="$item->ServiceName" :description="$item->Description"
                    :shortDescription="$item->ShortDescription" />
            @endforeach
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