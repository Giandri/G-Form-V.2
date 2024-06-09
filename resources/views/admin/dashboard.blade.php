<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>G-Form | Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://fonts.cdnfonts.com/css/unbounded" rel="stylesheet">
    <style>
        body {
            font-family: 'Unbounded', sans-serif;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
        <div class="container">
            <a class="navbar-brand" href="#">
                <strong><i class="fa-solid fa-newspaper"></i> G-Form V.2</strong>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">Halo Ngab, Admin</a>
                            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                            class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center mt-3">

        </div>
        @if(Session::has('success'))
        <div class="col-md mt-3">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>

        @endif
        <div class="card border-0 shadow my-5">
            <div class="card-header bg-dark text-light">
                <h3 class="h5 pt-2">Tabel</h3>
            </div>
            <div>
                <h3 class="text-center mt-4 h5">Tabel Artikel</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th></th>
                        <th>Name</th>
                        <th>Tag</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    @if($articles->isNotEmpty())
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            @if($article->image != "")
                            <img width="50" src="{{ asset('upload/articles/'.$article->image) }}" alt="">
                            @endif
                        </td>
                        <td>{{ $article->name }}</td>
                        <td>{{ $article->tag }}</td>
                        <td>{{ \Carbon\Carbon::parse($article->created_at)->format('d M, Y') }}</td>
                        <td>
                            <a href="#" class="btn btn-dark" data-bs-toggle="modal"
                                data-bs-target="#ModalEdit-{{ $article->id }}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" onclick="deleteForm({{ $article->id }})" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                            <form id="delete-form-{{ $article->id }}"
                                action="{{ route('account.destroy', $article->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @endif
                </table>
            </div>

        </div>
    </div>

    @include('modal.edit')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

<script>
    function deleteForm(id) {
        if(confirm('Yakin Bwang?')) {
            document.getElementById('delete-form-'+id).submit();
        }
    }
</script>