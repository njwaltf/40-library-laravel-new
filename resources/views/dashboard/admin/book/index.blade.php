@extends('layouts.app')
<style>
    /* Dropdown container */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown button */
    .dropdown .dropdown-button {
        background-color: #6777ef;
        color: #fff;
        padding: 7.5px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    /* Dropdown button hover effect */
    .dropdown .dropdown-button:hover {
        background-color: #5566cc;
    }

    /* Dropdown content */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        z-index: 1;
        padding: 10px 0;
        animation: fadeInDown 0.5s ease;
    }

    /* Dropdown content links */
    .dropdown-content a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s ease;
    }

    /* Dropdown content link hover effect */
    .dropdown-content a:hover {
        background-color: #f2f2f2;
    }

    /* Show dropdown content when hovering over dropdown container */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Animation for dropdown content */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Buku</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Success and error messages -->
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if (session()->has('successEdit'))
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('successEdit') }}
                        </div>
                    </div>
                @endif

                @if (session()->has('successDelete'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('successDelete') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="float-right">
                            <a href="/books-management/create" class="btn btn-primary">Tambah Buku <i
                                    class="fas fa-plus"></i></a>
                            <!-- The dropdown content -->
                            <div class="dropdown">
                                <!-- Dropdown button -->
                                <button class="dropdown-button">Export Data <i class="ti ti-file-text"></i></button>
                                <!-- Dropdown content -->
                                <div class="dropdown-content" id="myDropdown">
                                    <a href="{{ url('pdf/export-book/') }}">PDF</a>
                                    <a href="{{ url('excel/export-book/') }}">Excel</a>
                                    {{-- <a href="#">Something else here</a> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Search and filter form -->
                        <div class="float-left mb-3">
                            <form method="GET">
                                <div class="input-group">
                                    <select class="form-control selectric mx-2" name="category">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request()->get('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" placeholder="Cari buku ..."
                                        name="search_keyword" value="{{ request()->get('search_keyword') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Judul Buku</th>
                                        {{-- <th scope="col">Penerbit</th> --}}
                                        {{-- <th scope="col">Penulis</th> --}}
                                        <th scope="col">Stok</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($books as $book)
                                        <tr>
                                            <th scope="row">{{ $book->id }}</th>
                                            <td>{{ $book->title }}</td>
                                            {{-- <td>{{ $book->publisher }}</td> --}}
                                            {{-- <td>{{ $book->writer }}</td> --}}
                                            <td>
                                                @if ($book->stock < 1)
                                                    <strong style="color: red;">Habis</strong>
                                                @else
                                                    {{ $book->stock }}
                                                @endif
                                            </td>
                                            <td>{{ $book->category->name }}</td>
                                            <td>
                                                <a href="/books-management/{{ $book->id }}/"
                                                    class="btn btn-info m-1">Detail <i class="fas fa-arrow-right"></i></a>
                                                <a href="/books-management/{{ $book->id }}/edit"
                                                    class="btn btn-warning m-1">Ubah <i class="fas fa-edit"></i></a>
                                                <form action="/books-management/{{ $book->id }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger m-1" type="submit"
                                                        onclick="return confirm('Apakah kamu yakin ingin menghapus buku ini?')">Hapus
                                                        <i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{ $books->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
