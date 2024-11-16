@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 800px">
        <div class="card mb-2 border-primary">
            <div class="card-body">
                <h3 class="h4">{{ $article->title }}</h3>
                <div class="text-muted mb-3">
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <div class="mb-3">
                    {{ $article->body }}
                </div>
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-sm btn-outline-danger">Delete</a>
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-sm btn-outline-dark">Edit</a>
            </div>
        </div>
    </div>
@endsection