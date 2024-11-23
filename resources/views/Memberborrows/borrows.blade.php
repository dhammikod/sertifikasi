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
        {{-- <table class="table">
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
                    <form action="/delete_book" method="post">
                        @csrf
                        <input type="hidden" name="member_id" value={{$member->id}}>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </table> --}}

        <div>
            <a href="/member">back</a>
        </div>

        
        <<form action="/create_borrows" method="post">
            @csrf
            <div>
                <label for="member_id">Select Member:</label>
                <select name="member_id" id="member_id" required>
                    <option value="">-- Select a Member --</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <p>Select Books:</p>
                @foreach ($books as $book)
                    <div>
                        <input 
                            type="checkbox" 
                            name="books[]" 
                            id="book_{{ $book->id }}" 
                            value="{{ $book->id }}">
                        <label for="book_{{ $book->id }}">{{ $book->book_title }}</label>
                    </div>
                @endforeach
            </div>
            
            <div>
                <button type="submit">Record Borrow</button>
            </div>
        </form>        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
