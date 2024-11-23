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
        {{-- table --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Members</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->address }}</td>
                                <td>
                                    <form action="/edit_member" method="post">
                                        @csrf
                                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/delete_member" method="post">
                                        @csrf
                                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-4 d-flex justify-content-between">
            <a href="/borrow" class="btn btn-success">Create Borrow Books</a>
            <a href="/manage_borrow" class="btn btn-info">Manage Borrow Books</a>
        </div>

        <div class="mb-4">
            <a href="/" class="btn btn-secondary">Back</a>
        </div>

        {{-- form --}}
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Add New Member</h4>
            </div>
            <div class="card-body">
                <form action="/create_member" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Member Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
