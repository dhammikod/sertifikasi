<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titlepage }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="mb-4">
            <a href="/books" class="btn btn-secondary">Back</a>
        </div>

        {{-- Form --}}
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Edit Book</h4>
            </div>
            <div class="card-body">
                <form action="/edit_book" method="post">
                    @csrf
                    <input type="hidden" name="edit_done" value="yes">
                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <div class="mb-3">
                        <label for="book_title" class="form-label">Book Title</label>
                        <input 
                            type="text" 
                            name="book_title" 
                            id="book_title" 
                            class="form-control" 
                            value="{{ $book->book_title }}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="author_name" class="form-label">Author Name</label>
                        <input 
                            type="text" 
                            name="author_name" 
                            id="author_name" 
                            class="form-control" 
                            value="{{ $book->author }}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <p class="mb-2">Select Categories:</p>
                        @foreach ($Categories as $category)
                        <div class="form-check">
                            <input 
                                type="checkbox" 
                                name="categories[]" 
                                id="category_{{ $category['id'] }}" 
                                value="{{ $category['id'] }}" 
                                class="form-check-input" 
                                @if($book->categories->contains($category->id)) checked @endif>
                            <label for="category_{{ $category['id'] }}" class="form-check-label">
                                {{ $category['category'] }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
