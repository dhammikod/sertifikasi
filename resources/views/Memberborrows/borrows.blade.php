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
        <div class="mb-3">
            <a href="/member" class="btn btn-secondary">&larr; Back</a>
        </div>

        {{-- form --}}
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Record Borrow</h4>
            </div>
            <div class="card-body">
                <form action="/create_borrows" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Select Member</label>
                        <select name="member_id" id="member_id" class="form-select" required>
                            <option value="">-- Select a Member --</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Select Books</label>
                        <div class="form-check">
                            @foreach ($books as $book)
                                <div>
                                    <input 
                                        type="checkbox" 
                                        name="books[]" 
                                        id="book_{{ $book->id }}" 
                                        value="{{ $book->id }}" 
                                        class="form-check-input">
                                    <label for="book_{{ $book->id }}" class="form-check-label">{{ $book->book_title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Record Borrow</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
