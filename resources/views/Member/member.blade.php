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
                <th>Name</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        
        @foreach ($Members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->address }}</td>
                <td>
                    <form action="/edit_member" method="post">
                        @csrf
                        <input type="hidden" name="member_id" value={{$member->id}}>
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </form>
                </td>
                <td>
                    <form action="/delete_member" method="post">
                        @csrf
                        <input type="hidden" name="member_id" value={{$member->id}}>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table>
        <br>
        <table class="table">
            <th>
                <div>
                    <a href="/borrow"><button type="submit">Create borrow books</button> </a>
                </div>
            </th>
            <th>
                <div>
                    <a href="/manage_borrow"><button type="submit">Manage borrow books</button> </a>
                </div>
            </th>
        </table>
        
        <div>
            <a href="/">back</a>
        </div>

        
        <form action="/create_member" method="post">
            @csrf
            <div>
                Member name:
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                Address:
                <input type="text" name="address" id="address" required>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
