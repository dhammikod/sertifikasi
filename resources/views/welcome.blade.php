<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$titlepage}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    </head>
    <body>
       
        <p>
            welcome to program library,
            Here you can see books, categories and also borrow books
        </p>
        <div>
            <a href="/books">Books</a>
        </div>
        <div>
            <a href="/categories">Categories</a>
        </div>
        <div>
            <a href="/member">User Data</a>
        </div>
    </body>
</html>
