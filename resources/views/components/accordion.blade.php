<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#{{ $id }}" aria-expanded="true" aria-controls="{{ $id }}">
                <strong>{{ $title }}</strong><span class="lead fs-6 ms-1"> - {{ $shortDescription }} </span>
            </button>
        </h2>
        <div id="{{ $id }}" class="accordion-collapse collapse">
            <div class="accordion-body">
                {{ $description }}
            </div>
            <div class="btn-group ms-3 mb-1" role="group" aria-label="Basic mixed styles example">
                <form method="POST" action="/services/delete/{{ $id }}">
                    <a href="/services/edit/{{ $id }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>