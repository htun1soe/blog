@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 800px">
        <h1 class="h3">New Article</h1>
        @if($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="post">
            @csrf
            <input type="text" name="title" placeholder="Title" class="form-control mb-2">
            <textarea name="body" class="form-control mb-2" placeholder="Body"></textarea>
            <select name="category_id" class="form-select mb-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary" type="submit">Add Article</button>
          </form>

    </div>
@endsection