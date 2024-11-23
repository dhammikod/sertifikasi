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
    {{-- filter form --}}
    <form action="{{ url('/books') }}" method="GET" class="mb-4">
        <div class="row g-3 align-items-center">            
            {{-- filter by category --}}
            <div class="col-auto">
                <label for="filter_category" class="col-form-label">Filter by Category:</label>
                <select name="category" id="filter_category" class="form-select">
                    <option value="">-- Select Category --</option>
                    @foreach ($Categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>

    <!-- Books Table -->
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Book Title</th>
            <th>Categories</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        @foreach ($Books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->book_title }}</td>
                <td>
                    <ul>
                        @foreach ($book->categories as $category)
                            <li>{{ $category->category }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <form action="/edit_book" method="post">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="/delete_book" method="post">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div>
        <a href="/">back</a>
    </div>

    <form action="/create_book" method="post">
        @csrf
        <div>
            Book Title:
            <input type="text" name="book_title" id="book_title" required>
        </div>
        <div>
            Author Name:
            <input type="text" name="author_name" id="author_name" required>
        </div>
        <div>
            <p>Select Categories:</p>
            @foreach ($Categories as $category)
                <div>
                    <input type="checkbox" name="categories[]" id="category_{{ $category['id'] }}" value="{{ $category['id'] }}">
                    <label for="category_{{ $category['id'] }}">{{ $category['category'] }}</label>
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
