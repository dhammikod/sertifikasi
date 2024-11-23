<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $titlepage }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-4">
        {{-- Filter --}}
        <h1 class="mb-4">Book Management</h1>
        <form action="{{ url('/books') }}" method="GET" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label for="filter_category" class="form-label">Filter by Category:</label>
                    <select name="category" id="filter_category" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach ($Categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Apply Filters</button>
                </div>
            </div>
        </form>

        {{-- display book --}}
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Book Title</th>
                        <th>Categories</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->book_title }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($book->categories as $category)
                                        <li>{{ $category->category }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <form action="/edit_book" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form action="/delete_book" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <a href="/" class="btn btn-secondary">Back</a>
        </div>

        {{-- create book --}}
        <div class="card">
            <div class="card-header">
                <h5>Create a New Book</h5>
            </div>
            <div class="card-body">
                <form action="/create_book" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="book_title" class="form-label">Book Title:</label>
                        <input type="text" name="book_title" id="book_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="author_name" class="form-label">Author Name:</label>
                        <input type="text" name="author_name" id="author_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1">Select Categories:</p>
                        <div class="form-check">
                            @foreach ($Categories as $category)
                                <div>
                                    <input type="checkbox" name="categories[]" id="category_{{ $category['id'] }}" value="{{ $category['id'] }}" class="form-check-input">
                                    <label for="category_{{ $category['id'] }}" class="form-check-label">{{ $category['category'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
