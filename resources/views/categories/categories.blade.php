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
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Categories</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        
        @foreach ($Categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category }}</td>
                <td>
                    <form action="/edit_category" method="post">
                        @csrf
                        <input type="hidden" name="category_id" value={{$category->id}}>
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="/delete_category" method="post">
                        @csrf
                        <input type="hidden" name="category_id" value={{$category->id}}>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>

        <div>
            <a href="/">back</a>
        </div>

            <form action="/create_category" method="post">
                @csrf
                <div>
                    Category:
                    <input type="text" name="category" id="category" required>
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
