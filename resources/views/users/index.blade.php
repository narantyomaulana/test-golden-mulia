<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
              {{-- <a class="navbar-brand" href="{{ route('products.index') }}">Products</a> --}}
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                      </li>
                  </ul>
              </div>
              </div>
          </nav>
      <div class="main-wrapper">
        <div class="main-content">
          <div class="container">
            <div class="card mt-5">
              <div class="card-header">
                <h3>List Users</h3>
              </div>
              <div class="card-body">
                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <p>
                  <a class="btn btn-primary" href="{{ route('users.create') }}">New Users</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                        <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                          <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-secondary btn-sm">edit</a>
                          <a href="#" class="btn btn-sm btn-danger" onclick="
                            event.preventDefault();
                            if (confirm('Do you want to remove this?')) {
                              document.getElementById('delete-row-{{ $user->id }}').submit();
                            }">
                            delete
                          </a>
                          <form id="delete-row-{{ $user->id }}" action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
                              <input type="hidden" name="_method" value="DELETE">
                              @csrf
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6">
                            No record found!
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
