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
            <a href="/member">back</a>
        </div>

        <div>
            <label for="member_id">Select Member:</label>
            <select name="member_id" id="member_id" required>
                <option value="">-- Select a Member --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div id="borrowed_books_section">
            <h4>Books Borrowed by This Member:</h4>
            <ul id="borrowed_books_list">
                <li>No member selected.</li>
            </ul>
        </div>
        
        <script>
            document.getElementById('member_id').addEventListener('change', function () {
                const memberId = this.value;
                const borrowedBooksList = document.getElementById('borrowed_books_list');
        
                if (!memberId) {
                    borrowedBooksList.innerHTML = '<li>No member selected.</li>';
                    return;
                }
        
                // Fetch borrowed books for the selected member
                fetch(`/member/${memberId}/borrowed-books`)
                    .then(response => response.json())
                    .then(data => {
                        borrowedBooksList.innerHTML = ''; // Clear the list
        
                        if (data.length === 0) {
                            borrowedBooksList.innerHTML = '<li>No active borrowed books.</li>';
                        } else {
                            data.forEach(borrow => {
                                const listItem = document.createElement('li');
                                listItem.innerHTML = `
                                    ${borrow.book.book_title} 
                                    (Borrowed on: ${borrow.tanggal_pinjam})
                                    ${!borrow.tanggal_kembali ? `
                                        <form action="/mark_book_returned" method="post" style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="borrow_id" value="${borrow.id}">
                                            <button type="submit" class="btn btn-primary">Mark as Returned</button>
                                        </form>
                                    ` : '(Already Returned)'}
                                `;
                                borrowedBooksList.appendChild(listItem);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching borrowed books:', error);
                        borrowedBooksList.innerHTML = '<li>Error fetching borrowed books.</li>';
                    });
            });
        </script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
