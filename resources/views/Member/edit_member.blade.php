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
            <a href="/">back</a>
        </div>
        
        <form action="/edit_member" method="post">
            @csrf
            <input type="hidden" name="edit_done" value="yes">
            <input type="hidden" name="member_id" value="{{$member->id}}">
            <div>
                Member name:
                <input type="text" name="name" id="name" value="{{$member->name}}" required>
            </div>
            <div>
                Address:
                <input type="text" name="address" id="address" value="{{$member->address}}" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
