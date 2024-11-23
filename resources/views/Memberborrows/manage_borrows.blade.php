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

        {{-- select member --}}
        <div class="mb-3">
            <label for="member_id" class="form-label">Select Member:</label>
            <select name="member_id" id="member_id" class="form-select" required>
                <option value="">-- Select a Member --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- select book --}}
        <div id="borrowed_books_section" class="mt-4">
            <h4>Books Borrowed by This Member:</h4>
            <ul id="borrowed_books_list" class="list-group">
                <li class="list-group-item">No member selected.</li>
            </ul>
        </div>
    </div>

    <script>
        document.getElementById('member_id').addEventListener('change', function () {
            const memberId = this.value;
            const borrowedBooksList = document.getElementById('borrowed_books_list');

            if (!memberId) {
                borrowedBooksList.innerHTML = '<li class="list-group-item">No member selected.</li>';
                return;
            }

            // Fetch from api endpoint
            fetch(`/member/${memberId}/borrowed-books`)
                .then(response => response.json())
                .then(data => {
                    borrowedBooksList.innerHTML = '';

                    if (data.length === 0) {
                        borrowedBooksList.innerHTML = '<li class="list-group-item">No active borrowed books.</li>';
                    } else {
                        data.forEach(borrow => {
                            const listItem = document.createElement('li');
                            listItem.classList.add('list-group-item');
                            listItem.innerHTML = `
                                ${borrow.book.book_title} 
                                (Borrowed on: ${borrow.tanggal_pinjam})
                                ${!borrow.tanggal_kembali ? `
                                    <form action="/mark_book_returned" method="post" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="borrow_id" value="${borrow.id}">
                                        <button type="submit" class="btn btn-primary btn-sm">Mark as Returned</button>
                                    </form>
                                ` : '(Already Returned)'}
                            `;
                            borrowedBooksList.appendChild(listItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching borrowed books:', error);
                    borrowedBooksList.innerHTML = '<li class="list-group-item">Error fetching borrowed books.</li>';
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
