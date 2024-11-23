<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> {{$titlepage}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS (CDN) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    </head>
    <body>
        <div>
            <a href="/books">back</a>
        </div>

        <form action="/edit_book" method="post">
            @csrf
            <input type="hidden" name="edit_done" value="yes">
            <input type="hidden" name="book_id" value="{{$book->id}}">
            <div>
                Book Title:
                <input type="text" name="book_title" id="book_title" value="{{ $book->book_title }}" required>
            </div>
            <div>
                Author Name:
                <input type="text" name="author_name" id="author_name" value="{{ $book->author }}" required>
            </div>
            <div>
                <p>Select Categories:</p>
                @foreach ($Categories as $category)
                    <div>
                        <input 
                            type="checkbox" 
                            name="categories[]" 
                            id="category_{{ $category['id'] }}" 
                            value="{{ $category['id'] }}" 
                            @if($book->categories->contains($category->id)) checked @endif>
                        <label for="category_{{ $category['id'] }}">{{ $category->category }}</label>
                    </div>
                @endforeach
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>        

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
