<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $titlepage }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            font-size: 1.8em;
            margin: 0;
            color: #555;
        }
        main {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
            color: #666;
        }
        nav {
            margin-top: 20px;
        }
        nav a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>{{ $titlepage }}</h1>
    </header>

    <main>
        <p>Welcome to the library program. Here, you can explore books, browse categories, and manage borrowings.</p>

        <nav>
            <a href="/books">Books</a>
            <a href="/categories">Categories</a>
            <a href="/member">User Data</a>
        </nav>
    </main>
</body>
</html>
