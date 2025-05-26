@extends ("main")

@section ("content")
    @foreach ($models as $item)
        <label> {{ $item->ServiceName }}
            <div>
                {{ $item->ShortDescription}}
            </div>
            <div>
                {{ $item->Description}}
            </div>
    @endforeach
@endsection