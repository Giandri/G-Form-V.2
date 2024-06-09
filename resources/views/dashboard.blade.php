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
                                data-bs-toggle="dropdown" aria-expanded="false">Halo Ngab, {{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('account.logout') }}"><i
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
            <div class="col-md d-flex justify-content-end">
                <a href="{{ route('account.index') }}" class="btn btn-dark">Tabel List</a>
            </div>
        </div>
        <div class="card border-0 shadow my-3">
            <div class="card-header bg-dark text-light">
                <h3 class="h5 pt-2">Form</h3>
            </div>
            <div>
                <h3 class="text-center mt-4 h5">Buat Artikel</h3>
            </div>
            <form enctype="multipart/form-data" action="{{ route('account.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="ms-2 form-label h5">Judul Artikel</label>
                        <input value="{{ old('name') }}" type="text"
                            class="@error('name') is-invalid @enderror form-control form-control-lg"
                            placeholder="article name" name="name">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="ms-2 form-label h5">Tag</label>
                        <input value="{{ old('tag') }}" type="text"
                            class="@error('tag') is-invalid @enderror form-control form-control-lg" placeholder="tag"
                            name="tag">
                        @error('tag')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="ms-2 form-label h5">Deskripsi</label>
                        <textarea name="description" placeholder="description" class="form-control" cols="30"
                            rows="2">{{ old('description') }} </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="ms-2 form-label h5">Gambar</label>
                        <input type="file" class=" form-control form-control-lg" name="image">
                    </div>
                    <div class="mb-3 d-grid">
                        <button class="btn btn-lg btn-dark">Create</button>
                    </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>